<?php

namespace App\Controller;

use DateTime;
use DateTimeImmutable;
use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        // $croquette = new Product();
        // $croquette->setName('Croquette');
        // $croquette->setPrix(200);
        // $croquette->setDescription("Une croquette qui en fera bavé vos petit compagnons !");
        // $croquette->setCreateAt(new DateTimeImmutable());
        // $croquette->setActive(true);

        // $em->persist($croquette); // Rend les données persistantes
        // $em->flush(); // Envoie à la BDD

        $produit = new Product();
        $form = $this->createFormBuilder($produit)
            ->add("name", TextType::class)
            ->add("prix", NumberType::class)
            ->add("Envoyer", SubmitType::class)

            ->getForm();

        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            "form" => $form
        ]);
    }
}
