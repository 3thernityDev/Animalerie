<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    /**
     * @var Collection<int, Animalerie>
     */
    #[ORM\ManyToMany(targetEntity: Animalerie::class, mappedBy: 'Products')]
    private Collection $animaleries;

    public function __construct()
    {
        $this->animaleries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, Animalerie>
     */
    public function getAnimaleries(): Collection
    {
        return $this->animaleries;
    }

    public function addAnimalery(Animalerie $animalery): static
    {
        if (!$this->animaleries->contains($animalery)) {
            $this->animaleries->add($animalery);
            $animalery->addProduct($this);
        }

        return $this;
    }

    public function removeAnimalery(Animalerie $animalery): static
    {
        if ($this->animaleries->removeElement($animalery)) {
            $animalery->removeProduct($this);
        }

        return $this;
    }
}
