<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BanqueController extends AbstractController
{
    #[Route('/banque', name: 'app_banque')]
    public function index(): Response
    {
        return $this->render('banque/index.html.twig', [
            'controller_name' => 'BanqueController',
        ]);
    }
}
