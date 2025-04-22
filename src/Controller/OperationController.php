<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\OperationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Operation;
use Symfony\Component\HttpFoundation\Request;

class OperationController extends AbstractController
{
    #[Route('/operation ', name: 'app_operation')]
    public function index(): Response
    {
        return $this->render('operation/index.html.twig', [
            'controller_name' => 'OperationController',
        ]);
    }

    #[Route('/operation/list ', name: 'app_operation_lister')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $operations = $entityManager->getRepository(Operation::class)->findAll();
        return $this->render('operation/lister.html.twig', [
            'operations' => $operations
        ]);
    }

    #[Route('/operation/consulter/{idOperation}', name: 'app_consulter_operation')]

    public function consulterOperation(Request $request, EntityManagerInterface $entityManager, $idOperation){
        //$comptes= $doctrine->getRepository(Compte::class)->findAll();
        $operation = $entityManager->getRepository(Operation::class)->find($idOperation);
        if (!$operation) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour modifier vos informations.');
        }

        $form = $this->createForm(OperationType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $operation = $form->getData();
            $entityManager->persist($operation);
            $entityManager->flush();

            
            return $this->render('operation/consulter.html.twig', [
                'modifyForm' => $form->createView(),
                'o' => $operation

            ]);
        }

        return $this->render('operation/consulter.html.twig', [
            'modifyForm' => $form->createView(),
            'o' => $operation
        ]);

    }


    #[Route('/operation/create', name: 'app_create_operation')]
    public function createOperation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $e = new Operation();
        $form = $this->createForm(OperationType::class, $e);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $e = $form->getData();
            $entityManager->persist($e);
            $entityManager->flush();

            return $this->redirectToRoute('app_operation_liste');
        }

        return $this->render('operation/create.html.twig', [
            'creationForm' => $form,
        ]);
    }


    
    #[Route('/operation/delete/{idOperation}', name: 'app_delete_operation')]
    public function deleteCompte(Request $request, EntityManagerInterface $entityManager, $idOperation)
    {
        $c = $entityManager->getRepository(Operation::class)->find($idOperation);
        if (!$c) {
            return $this->redirectToRoute('app_operation_liste');
        }

        $entityManager->remove($c);
        $entityManager->flush();

        return $this->redirectToRoute('app_operation_liste');
    }

}
