<?php

namespace App\Controller;

use App\Entity\Product;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/createProduit', name: 'app_produit_create')]
    public function create(EntityManagerInterface $em): Response
    {
        $croquette = new Product();
        $croquette->setName('Croquette');
        $croquette->setPrix(200);
        $croquette->setDescription("Une croquette qui en fera bavé vos petit compagnons !");
        $croquette->setCreateAt(new DateTimeImmutable());
        $croquette->setActive(true);

        $em->persist($croquette); // Rend les données persistantes
        $em->flush(); // Envoie à la BDD

        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
}
