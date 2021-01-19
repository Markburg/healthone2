<?php

namespace App\Entity;

use App\Repository\ReceptRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass=ReceptRepository::class)
 */
class Recept
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $periode;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="recepten")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=Medicijn::class, inversedBy="recepts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medicijn;

    /**
     * @ORM\Column(type="string")
     */
    private $datum;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicijn(): ?Medicijn
    {
        return $this->medicijn;
    }

    public function setMedicijn(Medicijn $medicijn): self
    {
        $this->medicijn = $medicijn;

        return $this;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getDatum(): ?String
    {
        return $this->datum;
    }

    public function setDatum(String $datum): self
    {
        $this->datum = $datum;

        return $this;
    }
}
