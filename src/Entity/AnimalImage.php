<?php

namespace App\Entity;

use App\Repository\AnimalImageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalImageRepository::class)]
class AnimalImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string  $image_data = null;

    #[ORM\ManyToOne(inversedBy: 'animalImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_clique = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageData(): ?string
    {
        return $this->image_data;
    }

    public function setImageData(?string $image_data): static
    {
        $this->image_data = $image_data;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getNbClique(): ?int
    {
        return $this->nb_clique;
    }

    public function setNbClique(?int $nb_clique): static
    {
        $this->nb_clique = $nb_clique;

        return $this;
    }
    
    public function __toString()
    {
        return $this->image_data;
    }

}
