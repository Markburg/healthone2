<?php

namespace App\Entity;

use App\Repository\MedicijnRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicijnRepository::class)
 */
class Medicijn
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bijwerking;

    /**
     * @ORM\Column(type="string")
     */
    private $verzekerd;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBijwerking(): ?string
    {
        return $this->bijwerking;
    }

    public function setBijwerking(string $bijwerking): self
    {
        $this->bijwerking = $bijwerking;

        return $this;
    }

    public function getVerzekerd(): ?string
    {
        return $this->verzekerd;
    }

    public function setVerzekerd(string $verzekerd): self
    {
        $this->verzekerd = $verzekerd;

        return $this;
    }
}
