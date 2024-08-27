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

    #[ORM\OneToOne(mappedBy: 'animal', cascade: ['persist', 'remove'])]
    private ?RapportVeterinaire $rapport_veterinaire = null;

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

    public function __construct()
    {
        $this->rapportEmployees = new ArrayCollection();
        $this->rapportVeterinaires = new ArrayCollection();
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

    public function getRapportVeterinaire(): ?RapportVeterinaire
    {
        return $this->rapport_veterinaire;
    }

    public function setRapportVeterinaire(RapportVeterinaire $rapport_veterinaire): static
    {
        // set the owning side of the relation if necessary
        if ($rapport_veterinaire->getAnimal() !== $this) {
            $rapport_veterinaire->setAnimal($this);
        }

        $this->rapport_veterinaire = $rapport_veterinaire;

        return $this;
    }

    public function getRace(): ?race
    {
        return $this->race;
    }

    public function setRace(?race $race): static
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
}
