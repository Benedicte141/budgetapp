<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\AssuranceType;
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
    #[Route('/contrat/form', name: 'app_lister_contrat')]
    public function ajouterContrat()
    {
        $contrat = new contrat();
        $form = $this->createForm(AssuranceType::class, $contrat);
        return $this->render('assurance/ajouter.html.twig', array(
            'form' => $form->createView(), ));
    }
}
