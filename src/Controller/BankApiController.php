<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ImportationOperationType;
use App\Service\OperationImportService;


// use App\Form \ImportationOperationType;

class BankApiController extends AbstractController
{
    #[Route('/importerOperations', name: 'app_import_operations')]
    public function index(Request $request, OperationImportService $operationImportService): Response
    {

        $form = $this->createForm(ImportationOperationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $operationImportService->setData($form->get('json')->getData(), $form->get('comptes')->getData());
            return $this->redirectToRoute('app_home');
        }
        return $this->render('bank_api/index.html.twig', [
            'importForm' => $form,
        ]);
    }
}
