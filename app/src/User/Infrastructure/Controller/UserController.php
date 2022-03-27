<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Controller;

use App\User\Infrastructure\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    protected EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/users", methods={"GET"}, name="users")
     */
    public function list(): Response
    {
        $repository = $this->em->getRepository(User::class);
        dd($repository->findAll());
        return $this->render('index.html.twig', [
            'controller_name' => 'UserManagerController',
        ]);
    }
}