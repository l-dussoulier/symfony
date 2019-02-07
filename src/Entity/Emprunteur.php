<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emprunteur
 *
 * @ORM\Table(name="emprunteur")
 * @ORM\Entity
 */
class Emprunteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEmprunteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idemprunteur;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Formation", type="string", length=50, nullable=false)
     */
    private $formation;

    /**
     * @var string
     *
     * @ORM\Column(name="Incidents", type="string", length=50, nullable=false)
     */
    private $incidents;

    public function getIdemprunteur(): ?int
    {
        return $this->idemprunteur;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getIncidents(): ?string
    {
        return $this->incidents;
    }

    public function setIncidents(string $incidents): self
    {
        $this->incidents = $incidents;

        return $this;
    }


}
