<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Compte;
use App\Entity\Abonnement;
use App\Form\CompteType;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends AbstractController
{
    #[Route('/compte/list', name: 'app_compte_list')]
    
    public function listerComptes(EntityManagerInterface $entityManager){
		//$comptes= $doctrine->getRepository(Compte::class)->findAll();
        $comptes = $entityManager->getRepository(Compte::class)->findAll();

		return $this->render('compte/lister.html.twig', [
            'comptes' => $comptes]);	
	}

    #[Route('/compte/consulter/{idCompte}', name: 'app_consulter_compte')]

    public function consulterCompte(Request $request, EntityManagerInterface $entityManager, $idCompte){
        //$comptes= $doctrine->getRepository(Compte::class)->findAll();
        $compte = $entityManager->getRepository(Compte::class)->find($idCompte);
        if (!$compte) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour modifier vos informations.');
        }

        $form = $this->createForm(CompteType::class, $compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $compte = $form->getData();
            $entityManager->persist($compte);
            $entityManager->flush();

            
            return $this->render('compte/consulter.html.twig', [
                'modifyForm' => $form->createView(),
                'compte' => $compte,
                'operations'=>$compte->getOperations()

            ]);
        }

        return $this->render('compte/consulter.html.twig', [
            'modifyForm' => $form->createView(),
            'compte' => $compte,
            'operations'=>$compte->getOperations()
        ]);

    }
}
