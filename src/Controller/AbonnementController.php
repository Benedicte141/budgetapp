<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Abonnement;
use App\Form\AbonnementType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbonnementController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement_liste')]

    public function listerAbonnements(EntityManagerInterface $entityManager){
        $abonnements = $entityManager->getRepository(Abonnement::class)->findAll();

        return $this->render('abonnement/lister.html.twig', [
            'abonnements' => $abonnements,]);
    }


    #[Route('/abonnement/consulter/{idAbonnement}', name: 'app_consulter_abonnement')]

    public function consulterAbonnement(Request $request, EntityManagerInterface $entityManager, $idAbonnement){
        //$comptes= $doctrine->getRepository(Compte::class)->findAll();
        $abonnement = $entityManager->getRepository(Abonnement::class)->find($idAbonnement);
        if (!$abonnement) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour modifier vos informations.');
        }

        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $abonnement = $form->getData();
            $entityManager->persist($abonnement);
            $entityManager->flush();

            
            return $this->render('abonnement/consulter.html.twig', [
                'modifyForm' => $form->createView(),
                'a' => $abonnement

            ]);
        }

        return $this->render('abonnement/consulter.html.twig', [
            'modifyForm' => $form->createView(),
            'a' => $abonnement
        ]);

    }



    #[Route('/abonnement/create', name: 'app_create_abonnement')]
    public function createAbonnement(Request $request, EntityManagerInterface $entityManager): Response
    {
        $e = new Abonnement();
        $form = $this->createForm(AbonnementType::class, $e);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $e = $form->getData();
            $entityManager->persist($e);
            $entityManager->flush();

            return $this->redirectToRoute('app_abonnement_liste');
        }

        return $this->render('abonnement/create.html.twig', [
            'creationForm' => $form,
        ]);
    }

    
    #[Route('/abonnement/delete/{idAbonnement}', name: 'app_delete_abonnement')]
    public function deleteCompte(Request $request, EntityManagerInterface $entityManager, $idAbonnement)
    {
        $c = $entityManager->getRepository(Abonnement::class)->find($idAbonnement);
        if (!$c) {
            return $this->redirectToRoute('app_abonnement_liste');
        }

        $entityManager->remove($c);
        $entityManager->flush();

        return $this->redirectToRoute('app_abonnement_liste');
    }
}
