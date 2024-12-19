<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Emprunt;

class EmpruntController extends AbstractController
{
    #[Route('/emprunt/list', name: 'app_emprunt_list')]
    
    public function listerEmprunts(EntityManagerInterface $entityManager){
		//$emprunts= $doctrine->getRepository(Emprunt::class)->findAll();
        $emprunts = $entityManager->getRepository(Emprunt::class)->findAll();

		return $this->render('emprunt/lister.html.twig', [
            'emprunts' => $emprunts,]);	
 
	}
}



