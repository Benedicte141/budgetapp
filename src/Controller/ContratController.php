<?php

namespace App\Controller;

use App\Entity\Contrat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContratType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContratController extends AbstractController
{
    #[Route('/contrat/lister', name: 'app_lister_contrat')]
    public function listerContrat(EntityManagerInterface $entityManager)
    {
        $contrats = $entityManager->getRepository(Contrat::class)->findAll();

        return $this->render('contrat/lister.html.twig', [
            'contrats' => $contrats,
        ]);
    }

    #[Route('/contrat/consulter/{idContrat}', name: 'app_consulter_contrat')]

    public function consulterContrat(Request $request, EntityManagerInterface $entityManager, $idContrat){
        //$comptes= $doctrine->getRepository(Compte::class)->findAll();
        $c = $entityManager->getRepository(Contrat::class)->find($idContrat);
        if (!$c) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour modifier vos informations.');
        }

        $form = $this->createForm(ContratType::class, $c);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $c = $form->getData();
            $entityManager->persist($c);
            $entityManager->flush();

            
            return $this->render('contrat/consulter.html.twig', [
                'modifyForm' => $form->createView(),
                'c' => $c

            ]);
        }

        return $this->render('contrat/consulter.html.twig', [
            'modifyForm' => $form->createView(),
            'c' => $c
        ]);

    }


    #[Route('/contrat/create', name: 'app_create_contrat')]
    public function createContrat(Request $request, EntityManagerInterface $entityManager): Response
    {
        $e = new Contrat();
        $form = $this->createForm(ContratType::class, $e);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $e = $form->getData();
            $entityManager->persist($e);
            $entityManager->flush();

            return $this->redirectToRoute('app_lister_contrat');
        }

        return $this->render('contrat/create.html.twig', [
            'creationForm' => $form,
        ]);
    }



    
    #[Route('/contrat/delete/{idContrat}', name: 'app_delete_contrat')]
    public function deleteCompte(Request $request, EntityManagerInterface $entityManager, $idContrat)
    {
        $c = $entityManager->getRepository(Contrat::class)->find($idContrat);
        if (!$c) {
            return $this->redirectToRoute('app_lister_contrat');
        }

        $entityManager->remove($c);
        $entityManager->flush();

        return $this->redirectToRoute('app_lister_contrat');
    }
}
