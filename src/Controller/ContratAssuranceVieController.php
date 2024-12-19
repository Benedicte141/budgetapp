<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\ContratAssuranceVie;
use App\Form\ContratAssuranceType;
use Symfony\Component\HttpFoundation\Request;
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

    
    #[Route('/contrat_assurance_vie/create', name: 'app_contrat_assurance_vie_create')]
    public function createContratAssuranceVie(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cav = new ContratAssuranceVie();
        $form = $this->createForm(ContratAssuranceType::class, $cav);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $cav = $form->getData();
            $entityManager->persist($cav);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contrat_assurance_vie/create_contrat_assurance_vie.html.twig', [
            'creationForm' => $form,
        ]);
    }
}
