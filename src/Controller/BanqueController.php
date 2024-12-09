<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Banque;

class BanqueController extends AbstractController
{
    #[Route('/banque', name: 'app_banque_list')]
    // public function index(): Response
    // {
    //     return $this->render('banque/index.html.twig', [
    //         'controller_name' => 'BanqueController',
    //     ]);
    // }

    public function listerBanque(EntityManagerInterface $entityManager){
        $banques = $entityManager->getRepository(Banque::class)->findAll();

        return $this->render('banque/lister.html.twig',[
            'banques' => $banques,]);
    }

    #[Route('/banque/consulter/{id}', name: 'app_banque_details')]
    public function show(int $id, EntityManagerInterface $entityManager){
    {
        //Trouver la banque par son ID
        $banque = $entityManager->getRepository(Banque::class)->find($id);

        // Vérifier si la banque existe
        if (!$banque) {
            throw $this->createNotFoundException('Cette banque n\'existe pas.');
        }

        //Récupérer les comptes associés à la banque
        $comptes = $banque->getComptes();

        //Renvoyer la vue avec les informations de la banque
        return $this->render('banque/consulter.html.twig', [
            'banque' => $banque,
            'comptes' => $comptes,
        ]);
    }
}
}