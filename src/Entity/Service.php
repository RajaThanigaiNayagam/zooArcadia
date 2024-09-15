<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, ServiceImage>
     */
    #[ORM\OneToMany(targetEntity: ServiceImage::class, mappedBy: 'service', orphanRemoval: true)]
    private Collection $serviceImages;

    public function __construct()
    {
        $this->serviceImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    /**
     * @return Collection<int, ServiceImage>
     */
    public function getServiceImages(): Collection
    {
        return $this->serviceImages;
    }

    public function addServiceImage(ServiceImage $serviceImage): static
    {
        if (!$this->serviceImages->contains($serviceImage)) {
            $this->serviceImages->add($serviceImage);
            $serviceImage->setService($this);
        }

        return $this;
    }

    public function removeServiceImage(ServiceImage $serviceImage): static
    {
        if ($this->serviceImages->removeElement($serviceImage)) {
            // set the owning side to null (unless already changed)
            if ($serviceImage->getService() === $this) {
                $serviceImage->setService(null);
            }
        }

        return $this;
    }
}
