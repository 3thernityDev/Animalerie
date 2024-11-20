<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[ORM\Column(length: 255)]
    private ?string $streetname = null;

    #[ORM\Column]
    private ?float $postal = null;

    #[ORM\OneToOne(mappedBy: 'adresse', cascade: ['persist', 'remove'])]
    private ?Animalerie $animalerie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(float $number)
    {
        $this->number = $number;

        return $this;
    }

    public function getStreetname(): ?string
    {
        return $this->streetname;
    }

    public function setStreetname(string $streetname): static
    {
        $this->streetname = $streetname;

        return $this;
    }

    public function getPostal(): ?float
    {
        return $this->postal;
    }

    public function setPostal(float $postal): static
    {
        $this->postal = $postal;

        return $this;
    }

    public function getAnimalerie(): ?Animalerie
    {
        return $this->animalerie;
    }

    public function setAnimalerie(?Animalerie $animalerie): static
    {
        // unset the owning side of the relation if necessary
        if ($animalerie === null && $this->animalerie !== null) {
            $this->animalerie->setAdresse(null);
        }

        // set the owning side of the relation if necessary
        if ($animalerie !== null && $animalerie->getAdresse() !== $this) {
            $animalerie->setAdresse($this);
        }

        $this->animalerie = $animalerie;

        return $this;
    }
}
