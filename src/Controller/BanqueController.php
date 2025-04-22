<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Banque;
use App\Form\BanqueType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BanqueController extends AbstractController
{
    #[Route('/banque', name: 'app_banque_list')]

    public function listerBanques(EntityManagerInterface $entityManager){
        $banques = $entityManager->getRepository(Banque::class)->findAll();

        return $this->render('banque/lister.html.twig', [
            'banques' => $banques]);
    }


    #[Route('/banque/consulter/{idBanque}', name: 'app_consulter_banque')]

    public function consulterBanque(Request $request, EntityManagerInterface $entityManager, $idBanque){
        //$comptes= $doctrine->getRepository(Compte::class)->findAll();
        $banque = $entityManager->getRepository(Banque::class)->find($idBanque);
        if (!$banque) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour modifier vos informations.');
        }

        $form = $this->createForm(BanqueType::class, $banque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $banque = $form->getData();
            $entityManager->persist($banque);
            $entityManager->flush();

            
            return $this->render('banque/consulter.html.twig', [
                'modifyForm' => $form->createView(),
                'b' => $banque

            ]);
        }

        return $this->render('banque/consulter.html.twig', [
            'modifyForm' => $form->createView(),
            'b' => $banque
        ]);

    }



    #[Route('/banque/create', name: 'app_create_banque')]
    public function createBanque(Request $request, EntityManagerInterface $entityManager): Response
    {
        $e = new Banque();
        $form = $this->createForm(BanqueType::class, $e);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $e = $form->getData();
            $entityManager->persist($e);
            $entityManager->flush();

            return $this->redirectToRoute('app_banque_list');
        }

        return $this->render('banque/create.html.twig', [
            'creationForm' => $form,
        ]);
    }

    
    #[Route('/banque/delete/{idBanque}', name: 'app_delete_banque')]
    public function deleteCompte(Request $request, EntityManagerInterface $entityManager, $idBanque)
    {
        $c = $entityManager->getRepository(Banque::class)->find($idBanque);
        if (!$c) {
            return $this->redirectToRoute('app_banque_list');
        }

        $entityManager->remove($c);
        $entityManager->flush();

        return $this->redirectToRoute('app_banque_list');
    }
}
