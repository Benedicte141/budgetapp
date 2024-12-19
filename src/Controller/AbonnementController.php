<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Abonnement;

class AbonnementController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement_liste')]

    public function listerAbonnements(EntityManagerInterface $entityManager){
        $abonnements = $entityManager->getRepository(Abonnement::class)->findAll();

        return $this->render('abonnement/lister.html.twig', [
            'abonnements' => $abonnements,]);
    }
}
