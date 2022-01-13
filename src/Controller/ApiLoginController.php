<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiLoginController extends AbstractController
{
    #[Route('/user/login', name: 'login',methods: ['POST'])]
    public function login(ManagerRegistry $doctrine,Request $request): Response
    {
       $email = $request->get('email');
       $password = $request->get('password');


        return $this->json([
            'login' => $email,
            'password' =>  $password,

            'message' => 'loginSucess',
            'path' => 'src/Controller/ApiLoginController.php',
        ]);
    }
    #[Route('/user/create', name: 'create',methods: ['POST'])]
    public function create(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiLoginController.php',
        ]);
    }
}
