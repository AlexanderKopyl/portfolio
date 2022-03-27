<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", methods={"GET"}, name="users")
     */
    public function list(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'UserManagerController',
        ]);
    }
}