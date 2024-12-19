<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Compte;
use App\Entity\Abonnement;

class CompteController extends AbstractController
{
    #[Route('/compte/list', name: 'app_compte_list')]
    
    public function listerComptes(EntityManagerInterface $entityManager){
		//$comptes= $doctrine->getRepository(Compte::class)->findAll();
        $comptes = $entityManager->getRepository(Compte::class)->findAll();

		return $this->render('compte/lister.html.twig', [
            'comptes' => $comptes,]);	
	}

}
