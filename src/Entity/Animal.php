<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $etat = null;

    #[ORM\OneToOne(inversedBy: 'animal', cascade: ['persist', 'remove'])]
    private ?Race $race = null;

    #[ORM\ManyToOne(inversedBy: 'animal')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habitat $habitat = null;

    /**
     * @var Collection<int, RapportEmployee>
     */
    #[ORM\OneToMany(targetEntity: RapportEmployee::class, mappedBy: 'animal')]
    private Collection $rapportEmployees;

    /**
     * @var Collection<int, RapportVeterinaire>
     */
    #[ORM\OneToMany(targetEntity: RapportVeterinaire::class, mappedBy: 'animal')]
    private Collection $rapportVeterinaires;

    /**
     * @var Collection<int, AnimalImage>
     */
    #[ORM\OneToMany(targetEntity: AnimalImage::class, mappedBy: 'animal', orphanRemoval: true)]
    private Collection $animalImages;

    #[ORM\Column(nullable: true)]
    private ?int $nb_clique = null;

    public function __construct()
    {
        $this->rapportEmployees = new ArrayCollection();
        $this->rapportVeterinaires = new ArrayCollection();
        $this->animalImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getHabitat(): ?Habitat
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitat $habitat): static
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * @return Collection<int, RapportEmployee>
     */
    public function getRapportEmployees(): Collection
    {
        return $this->rapportEmployees;
    }

    public function addRapportEmployee(RapportEmployee $rapportEmployee): static
    {
        if (!$this->rapportEmployees->contains($rapportEmployee)) {
            $this->rapportEmployees->add($rapportEmployee);
            $rapportEmployee->setAnimal($this);
        }

        return $this;
    }

    public function removeRapportEmployee(RapportEmployee $rapportEmployee): static
    {
        if ($this->rapportEmployees->removeElement($rapportEmployee)) {
            // set the owning side to null (unless already changed)
            if ($rapportEmployee->getAnimal() === $this) {
                $rapportEmployee->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RapportVeterinaire>
     */
    public function getRapportVeterinaires(): Collection
    {
        return $this->rapportVeterinaires;
    }

    public function addRapportVeterinaire(RapportVeterinaire $rapportVeterinaire): static
    {
        if (!$this->rapportVeterinaires->contains($rapportVeterinaire)) {
            $this->rapportVeterinaires->add($rapportVeterinaire);
            $rapportVeterinaire->setAnimal($this);
        }

        return $this;
    }

    public function removeRapportVeterinaire(RapportVeterinaire $rapportVeterinaire): static
    {
        if ($this->rapportVeterinaires->removeElement($rapportVeterinaire)) {
            // set the owning side to null (unless already changed)
            if ($rapportVeterinaire->getAnimal() === $this) {
                $rapportVeterinaire->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AnimalImage>
     */
    public function getAnimalImages(): Collection
    {
        return $this->animalImages;
    }

    public function addAnimalImage(AnimalImage $animalImage): static
    {
        if (!$this->animalImages->contains($animalImage)) {
            $this->animalImages->add($animalImage);
            $animalImage->setAnimal($this);
        }

        return $this;
    }

    public function removeAnimalImage(AnimalImage $animalImage): static
    {
        if ($this->animalImages->removeElement($animalImage)) {
            // set the owning side to null (unless already changed)
            if ($animalImage->getAnimal() === $this) {
                $animalImage->setAnimal(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->prenom;
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
}
