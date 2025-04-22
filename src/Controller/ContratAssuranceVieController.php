<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\ContratAssuranceVie;
use App\Form\ContratAssuranceVieType;
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

    #[Route('/contrat_assurance_vie/consulter/{idContratAssuranceVie}', name: 'app_consulter_contrat_assurance_vie')]

    public function consulterContratAssuranceVie(Request $request, EntityManagerInterface $entityManager, $idContratAssuranceVie){
        //$comptes= $doctrine->getRepository(Compte::class)->findAll();
        $c = $entityManager->getRepository(ContratAssuranceVie::class)->find($idContratAssuranceVie);
        if (!$c) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour modifier vos informations.');
        }

        $form = $this->createForm(ContratAssuranceVieType::class, $c);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $c = $form->getData();
            $entityManager->persist($c);
            $entityManager->flush();

            
            return $this->render('contrat_assurance_vie/consulter.html.twig', [
                'modifyForm' => $form->createView(),
                'c' => $c

            ]);
        }

        return $this->render('contrat_assurance_vie/consulter.html.twig', [
            'modifyForm' => $form->createView(),
            'c' => $c
        ]);

    }

    #[Route('/contrat_assurance_vie/list', name: 'app_contrat_assurance_vie_list')]
    public function listerContratAssuranceVies(EntityManagerInterface $entityManager): Response
    {
        $contrats = $entityManager->getRepository(ContratAssuranceVie::class)->findAll();

		return $this->render('contrat_assurance_vie/list.html.twig', ['contrats' => $contrats]);
    }

    
    #[Route('/contrat_assurance_vie/create', name: 'app_create_contrat_assurance_vie')]
    public function createContratAssuranceVie(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cav = new ContratAssuranceVie();
        $form = $this->createForm(ContratAssuranceVieType::class, $cav);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $cav = $form->getData();
            $entityManager->persist($cav);
            $entityManager->flush();

            return $this->redirectToRoute('app_contrat_assurance_vie_list');
        }
        
        return $this->render('contrat_assurance_vie/create_contrat_assurance_vie.html.twig', [
            'creationForm' => $form,
        ]);
    }


    #[Route('/contrat_assurance_vie/delete/{idContratAssuranceVie}', name: 'app_delete_contrat_assurance_vie')]
    public function deleteCompte(Request $request, EntityManagerInterface $entityManager, $idContratAssuranceVie)
    {
        $c = $entityManager->getRepository(ContratAssuranceVie::class)->find($idContratAssuranceVie);
        if (!$c) {
            return $this->redirectToRoute('app_contrat_assurance_vie_list');
        }

        $entityManager->remove($c);
        $entityManager->flush();

        return $this->redirectToRoute('app_contrat_assurance_vie_list');
    }
}
