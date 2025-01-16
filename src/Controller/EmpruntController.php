<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Emprunt;
use App\Form\EmpruntType;
use App\Form\EmpruntModifierType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class EmpruntController extends AbstractController
{
    #[Route('/emprunt/lister', name: 'app_emprunt_lister')]
    
    public function listerEmprunts(EntityManagerInterface $entityManager){
		//$emprunts= $doctrine->getRepository(Emprunt::class)->findAll();
        $emprunts = $entityManager->getRepository(Emprunt::class)->findAll();
        return $this->render('emprunt/lister.html.twig', ['emprunts' => $emprunts]);
    }
    
    #[Route('/emprunt/ajouter', name: 'app_emprunt_ajouter')]  
    public function ajouterEmprunt(Request $request, EntityManagerInterface $entityManager): Response
    {
 
		$emprunt = new emprunt();
        $form = $this->createForm(EmpruntType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
 
            
            $entityManager->persist($emprunt);
            $entityManager->flush();

            $emprunts = $entityManager->getRepository(Emprunt::class)->findAll();
            return $this->render('emprunt/lister.html.twig', ['emprunts' => $emprunts,]);
        }
        else
        {
            return $this->render('emprunt/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }

    #[Route('/emprunt/modifier/{id}', name: 'app_emprunt_modifier')]  
    public function modifierEmprunt(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
    //récupération de l'emprunt dont l'id est passé en paramètre
    $emprunt = $entityManager->getRepository(Emprunt::class)->find($id);
    //var_dump($emprunt);
    
        if (! $emprunt) {
            throw $this->createNotFoundException('Aucun emprunt trouvé pour cet id : '.$id);
         }
        else
        {
            $form = $this->createForm(EmpruntModifierType::class, $emprunt);
            $form->handleRequest($request);
            
                        
            if ($form->isSubmitted() && $form->isValid()) {

                $emprunt = $form->getData();
                //$emprunt->setObjet('Emprunt modifié');
                $entityManager->persist($emprunt);
                $entityManager->flush();
               

                $emprunts = $entityManager->getRepository(Emprunt::class)->findAll();
                return $this->render('emprunt/lister.html.twig', ['emprunts' => $emprunts,]);
            }
            else
            {
                return $this->render('emprunt/ajouter.html.twig', array('form' => $form->createView(),));
            }
        }
    }
}