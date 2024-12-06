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
}
