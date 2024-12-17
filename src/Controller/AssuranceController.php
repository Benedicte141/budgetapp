<?php

namespace App\Controller;

use App\Entity\Contrat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class AssuranceController extends AbstractController
{
    #[Route('/contrat/lister', name: 'app_lister_contrat')]
    public function listerContrat(EntityManagerInterface $entityManager)
    {
        $contrats = $entityManager->getRepository(Contrat::class)->findAll();

        return $this->render('assurance/lister.html.twig', [
            'contrats' => $contrats,
        ]);
    }
}
