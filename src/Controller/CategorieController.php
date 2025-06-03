<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;
use App\Form\CategorieType; 

class CategorieController extends AbstractController
{
    #[Route('/categorie/list', name: 'app_categorie_list')]
    public function listerCategories(EntityManagerInterface $entityManager){
        
        $categories = $entityManager->getRepository(Categorie::class)->findAll();

        return $this->render('categorie/lister.html.twig', [
            'categories' => $categories,]);	

    }

    #[Route('/categorie/consulter/{idCategorie}', name: 'app_consulter_categorie')]

    public function consulterCategorie(Request $request, EntityManagerInterface $entityManager, $idCategorie){
        $categorie = $entityManager->getRepository(Categorie::class)->find($idCategorie);
        if (!$categorie) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour modifier vos informations.');
        }

        $form = $this->createForm (CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $categorie = $form->getData();
            $entityManager->persist($categorie);
            $entityManager->flush();

            
            return $this->redirectToRoute('app_categorie_list');
        }

        return $this->render('categorie/consulter.html.twig', [
            'modifyForm' => $form->createView(),
            'categorie' => $categorie
            
        ]);

    }

    #[Route('/categorie/create', name: 'app_create_categorie')]
    public function createCategorie(Request $request, EntityManagerInterface $entityManager): Response
    {
        $c = new Categorie();
        $form = $this->createForm(CategorieType::class, $c);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();
            $entityManager->persist($categorie);
            $entityManager->flush();
        
            return $this->redirectToRoute('app_categorie_list'); // redirection ici
        }
    }
        
}