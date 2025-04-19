<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Operation;

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

}
