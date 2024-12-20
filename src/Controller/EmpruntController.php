<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Emprunt;
use App\Form\EmpruntType;
use Symfony\Component\HttpFoundation\Request;


class EmpruntController extends AbstractController
{
    #[Route('/emprunt/lister', name: 'app_emprunt_list')]
    
    public function listerEmprunts(EntityManagerInterface $entityManager){
		//$emprunts= $doctrine->getRepository(Emprunt::class)->findAll();
        $emprunts = $entityManager->getRepository(Emprunt::class)->findAll();
        return $this->render('emprunt/lister.html.twig', ['emprunts' => $emprunts]);
    }
    
    #[Route('/emprunt/ajouter', name: 'app_emprunt_ajouter')]  
    public function ajouterEmprunt(Request $request, EntityManagerInterface $entityManager){
 
		$emprunt = new emprunt();
        $form = $this->createForm(EmpruntType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
 
            $entityManager->persist($emprunt);
            $entityManager->flush();

   	        return $this->render('emprunt/ajouter.html.twig', ['emprunt' => $emprunt,]);
        }
        else
        {
            return $this->render('emprunt/ajouter.html.twig', array('form' => $form->createView(), ));
        }
    }
}