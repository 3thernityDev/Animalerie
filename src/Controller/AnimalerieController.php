<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Animalerie;
use App\Repository\AnimalerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalerieController extends AbstractController
{
    private AnimalerieRepository $animalerieRepository;

    // Injection du repository dans le constructeur
    public function __construct(AnimalerieRepository $animalerieRepository)
    {
        $this->animalerieRepository = $animalerieRepository;
    }

    // Route pour afficher toutes les animaleries
    #[Route('/animaleries', name: 'app_animalerie')]
    public function searchAll(): Response
    {
        $animaleries = $this->animalerieRepository->findAll();

        return $this->render('animalerie/index.html.twig', [
            'controller_name' => 'AnimalerieController',
            'animaleries' => $animaleries,
        ]);
    }

    // Route pour trouver une animalerie par id
    #[Route('/animalerie/{id}', name: 'app_animalerie_id')]
    public function searchById(int $id): Response
    {
        $animalerie = $this->animalerieRepository->find($id);



        return $this->render('animalerie/index.html.twig', [
            'controller_name' => 'AnimalerieController',
        ]);
    }


    // Route pour créer une nouvelle animalerie
    #[Route('/createAnimalerie', name: 'app_animalerie_create')]
    public function create(EntityManagerInterface $em): Response
    {
        $petShop = new Animalerie();
        $petShop->setName("TytyAndHisLitlleFriends");

        $adresse = new Adresse();
        $adresse->setNumber(18);
        $adresse->setStreetname("Chemin des bestiole");
        $adresse->setPostal(97458);

        // Associe l'adresse à l'animalerie
        $petShop->setAdresse($adresse);

        $em->persist($petShop);
        $em->persist($adresse); // Si la relation est `OneToOne` avec cascade persist, ce n'est pas obligatoire
        $em->flush();

        return $this->render('animalerie/index.html.twig', [
            'controller_name' => 'AnimalerieController',
        ]);
    }
}
