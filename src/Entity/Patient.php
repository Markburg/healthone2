<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $woonplaats;

    /**
     * @ORM\OneToMany(targetEntity=Recept::class, mappedBy="patient", orphanRemoval=true)
     */
    private $recepten;

    public function __construct()
    {
        $this->recepten = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getWoonplaats(): ?string
    {
        return $this->woonplaats;
    }

    public function setWoonplaats(string $woonplaats): self
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    /**
     * @return Collection|Recept[]
     */
    public function getRecepten(): Collection
    {
        return $this->recepten;
    }

    public function addRecepten(Recept $recepten): self
    {
        if (!$this->recepten->contains($recepten)) {
            $this->recepten[] = $recepten;
            $recepten->setPatient($this);
        }

        return $this;
    }

    public function removeRecepten(Recept $recepten): self
    {
        if ($this->recepten->removeElement($recepten)) {
            // set the owning side to null (unless already changed)
            if ($recepten->getPatient() === $this) {
                $recepten->setPatient(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNaam();
    }
}
