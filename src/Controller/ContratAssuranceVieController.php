<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContratAssuranceVieController extends AbstractController
{
    #[Route('/contrat/assurance/vie', name: 'app_contrat_assurance_vie')]
    public function index(): Response
    {
        return $this->render('contrat_assurance_vie/index.html.twig', [
            'controller_name' => 'ContratAssuranceVieController',
        ]);
    }
}
