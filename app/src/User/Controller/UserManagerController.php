<?php
declare(strict_types=1);

namespace App\User\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserManagerController extends AbstractController
{
    #[Route('/user-manager', name: 'user_manager')]
    public function userManager(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'UserManagerController',
        ]);
    }
}