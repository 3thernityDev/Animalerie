<?php

namespace App\Controller;

use App\Entity\Animal;
use DateTimeImmutable;
use App\Entity\Product;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnimalController extends AbstractController
{
    private AnimalRepository $animalRepository;

    // Injection du repository dans le constructeur
    public function __construct(AnimalRepository $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }


    #[Route('/animals', name: 'app_animal')]
    public function searchAll(): Response
    {
        $animals = $this->animalRepository->findAll();

        return $this->render('animal/index.html.twig', [
            'controller_name' => 'AnimalController',
            'animals' => $animals
        ]);
    }


    #[Route('/createAnimal', name: 'app_animal_create')]
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

        $animal = new Animal();
        $form = $this->createFormBuilder($animal)
            ->add("name", TextType::class, [
                'label' => 'Nom de l"animal'
            ])
            ->add("sex",)
            ->add("birthday", DateType::class)
            ->add("Envoyer", SubmitType::class)

            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $animalData = $form->getData();
            $em->persist($animalData);
            $em->flush();
        }


        return $this->render('animal/createAnimal.html.twig', [
            'controller_name' => 'ProduitController',
            "form" => $form
        ]);
    }
}
