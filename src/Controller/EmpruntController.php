<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Emprunt;
use App\Form\EmpruntType;


class EmpruntController extends AbstractController
{
    #[Route('/emprunt/list', name: 'app_emprunt_lister')]
    
    public function listerEmprunts(EntityManagerInterface $entityManager){
		//$emprunts= $doctrine->getRepository(Emprunt::class)->findAll();
        $emprunts = $entityManager->getRepository(Emprunt::class)->findAll();

		return $this->render('emprunt/lister.html.twig', [
            'emprunts' => $emprunts,]);	
 
	}

    #[Route('/emprunt/consulter/{idEmprunt}', name: 'app_consulter_emprunt')]

    public function consulterEmprunt(Request $request, EntityManagerInterface $entityManager, $idEmprunt){
        //$comptes= $doctrine->getRepository(Compte::class)->findAll();
        $emprunt = $entityManager->getRepository(Emprunt::class)->find($idEmprunt);
        if (!$emprunt) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour consulter un emprunt.');
        }

        $form = $this->createForm(EmpruntType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $emprunt = $form->getData();
            $entityManager->persist($emprunt);
            $entityManager->flush();

            
            return $this->render('emprunt/consulter.html.twig', [
                'modifyForm' => $form->createView(),
                'emprunt' => $emprunt

            ]);
        }

        return $this->render('emprunt/consulter.html.twig', [
            'modifyForm' => $form->createView(),
            'emprunt' => $emprunt
        ]);

    }


    #
}



