<?php

namespace App\Controller;

use DateTime;
use DateTimeImmutable;
use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    private ProductRepository $productRepository;

    // Injection du repository dans le constructeur
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    #[Route('/produits', name: 'app_produit')]
    public function searchAll(): Response
    {
        $products = $this->productRepository->findAll();

        return $this->render('produit/index.html.twig', [
            'controller_name' => 'AnimalerieController',
            'products' => $products,
        ]);
    }

    #[Route('/createProduit', name: 'app_produit_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
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
            ->add("name", TextType::class, [
                'label' => 'Nom du produit'
            ])
            ->add("description", TextareaType::class, [
                'label' => 'Description'
            ])
            ->add("prix", NumberType::class, [
                'label' => 'Prix'
            ])
            ->add("Envoyer", SubmitType::class)

            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $produit->setCreateAt(new DateTimeImmutable());
            $produit->setActive(true);
            $productData = $form->getData();
            $em->persist($productData);
            $em->flush();
        }


        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            "form" => $form
        ]);
    }
}
