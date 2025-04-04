<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\AssuranceType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/contrat/ajouter', name: 'app_ajouter_contrat')]
    public function ajouterContrat(ManagerRegistry $doctrine,Request $request)
    {
        $contrat = new contrat();
        $form = $this->createForm(AssuranceType::class, $contrat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $contrat = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($contrat);
            $entityManager->flush();

            return $this->redirectToRoute('app_lister_contrat');
        }
    else
        {
            return $this->render('assurance/ajouter.html.twig', array(
                'form' => $form->createView(), ));
        }
    }
}

