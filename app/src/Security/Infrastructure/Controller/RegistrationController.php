<?php

namespace App\Security\Infrastructure\Controller;

use App\Security\Application\Service\EmailVerifier;
use App\Security\Infrastructure\Form\RegistrationFormType;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\FirstName;
use App\User\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\UkrainianPhone;
use App\User\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use App\User\Application\Service\UserServiceInterface;
use App\User\Infrastructure\Factory\UserFactory;

class RegistrationController extends AbstractController
{
    /**
     * @var EmailVerifier
     */
    private EmailVerifier $emailVerifier;

    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    public function __construct(
        EmailVerifier $emailVerifier,
        UserServiceInterface $userService

    ) {
        $this->emailVerifier = $emailVerifier;
        $this->userService = $userService;
    }

    /**
     * @throws \App\User\Domain\ValueObject\Exception\InvalidEmailException
     */
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        /** @var \App\User\Infrastructure\Factory\UserFactory $userFactory */
        $userFactory = $this->getParameter('factory.user');
        $user = $userFactory->createUser();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $plainPassword = new Password($userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            ));

            $user->setPassword($plainPassword)
                ->setIsVerified(0)
                ->setPhone(new UkrainianPhone($form->get('phone')->getData()))
                ->setRoles(["ROLE_USER"])
                ->setFirstname(new FirstName($form->get('firstname')->getData()))
                ->setLastname(new LastName($form->get('lastname')->getData()))
                ->setEmail(new Email($form->get('email')->getData()));

            $this->userService->save($user);

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('supportportfolio@gmail.com', 'Portfolio Mail Bot'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('email/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $this->redirectToRoute('users');
        }

        return $this->render('register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $userRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}
