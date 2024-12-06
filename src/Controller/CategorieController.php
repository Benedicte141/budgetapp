<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;

class CategorieController extends AbstractController
{
    #[Route('/categorie/list', name: 'app_categorie_list')]
    public function listerCategories(EntityManagerInterface $entityManager){
        //$categories= $doctrine->getRepository(Categorie::class)->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();

        return $this->render('categorie/lister.html.twig', [
            'categories' => $categories,]);	

    }
}