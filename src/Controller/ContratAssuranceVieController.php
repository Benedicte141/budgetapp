<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\ContratAssuranceVie;

use Doctrine\ORM\EntityManagerInterface;

class ContratAssuranceVieController extends AbstractController
{
    #[Route('/contrat_assurance_vie', name: 'app_contrat_assurance_vie')]
    public function index(): Response
    {
        return $this->render('contrat_assurance_vie/index.html.twig', [
            'controller_name' => 'ContratAssuranceVieController',
        ]);
    }

    #[Route('/contrat_assurance_vie/list', name: 'app_contrat_assurance_vie_list')]
    public function listerContratAssuranceVies(EntityManagerInterface $entityManager): Response
    {
        $contrats = $entityManager->getRepository(ContratAssuranceVie::class)->findAll();

		return $this->render('contrat_assurance_vie/list.html.twig', ['contrats' => $contrats]);
    }
}
