<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Animalerie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnnimalerieController extends AbstractController
{
    #[Route('/annimalerie', name: 'app_annimalerie')]
    public function index(): Response
    {
        return $this->render('annimalerie/index.html.twig', [
            'controller_name' => 'AnnimalerieController',
        ]);
    }


    #[Route('/createAnnimalerie', name: 'app_annimalerie')]
    public function create(EntityManagerInterface $em): Response
    {

        $petShop = new Animalerie();
        $petShop->setName("TytyAndHisLitlleFriends");

        $adresse = new Adresse();
        $adresse->setNumber(18);
        $adresse->setStreetname("Chemin des bestiole");
        $adresse->setPostal(97458);

        $petShop->setAdresse($adresse);

        $em->persist($petShop);
        $em->flush();


        return $this->render('annimalerie/index.html.twig', [
            'controller_name' => 'AnnimalerieController',
        ]);
    }
}
