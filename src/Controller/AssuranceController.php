<?php

namespace App\Controller;

use App\Entity\Contrat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class AssuranceController extends AbstractController
{
    #[Route('/contrat/consulter', name: 'app_consulter_contrat')]
    public function consulterContrat(EntityManagerInterface $entityManager)
    {
        $contrat = $entityManager->getRepository(Contrat::class)->findAll();

        return $this->render('assurance/consulter.html.twig', [
            'contrat' => $contrat,
        ]);
    }
}
