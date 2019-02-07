<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emprunt
 *
 * @ORM\Table(name="emprunt", indexes={@ORM\Index(name="emprunt_emprunteur_FK", columns={"idEmprunteur"}), @ORM\Index(name="emprunt_Materiel2_FK", columns={"Id"})})
 * @ORM\Entity
 */
class Emprunt
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEmprunt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idemprunt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DatePret", type="date", nullable=false)
     */
    private $datepret;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateRetourDemander", type="date", nullable=false)
     */
    private $dateretourdemander;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateRetourEffectif", type="date", nullable=true)
     */
    private $dateretoureffectif;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Statut_emprunt", type="integer", nullable=true)
     */
    private $statutEmprunt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Incident", type="string", length=1000, nullable=true)
     */
    private $incident;

    /**
     * @var \Materiel
     *
     * @ORM\ManyToOne(targetEntity="Materiel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id", referencedColumnName="Id")
     * })
     */
    private $id;

    /**
     * @var \Emprunteur
     *
     * @ORM\ManyToOne(targetEntity="Emprunteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEmprunteur", referencedColumnName="idEmprunteur")
     * })
     */
    private $idemprunteur;

    public function getIdemprunt(): ?int
    {
        return $this->idemprunt;
    }

    public function getDatepret(): ?\DateTimeInterface
    {
        return $this->datepret;
    }

    public function setDatepret(\DateTimeInterface $datepret): self
    {
        $this->datepret = $datepret;

        return $this;
    }

    public function getDateretourdemander(): ?\DateTimeInterface
    {
        return $this->dateretourdemander;
    }

    public function setDateretourdemander(\DateTimeInterface $dateretourdemander): self
    {
        $this->dateretourdemander = $dateretourdemander;

        return $this;
    }

    public function getDateretoureffectif(): ?\DateTimeInterface
    {
        return $this->dateretoureffectif;
    }

    public function setDateretoureffectif(?\DateTimeInterface $dateretoureffectif): self
    {
        $this->dateretoureffectif = $dateretoureffectif;

        return $this;
    }

    public function getStatutEmprunt(): ?int
    {
        return $this->statutEmprunt;
    }

    public function setStatutEmprunt(?int $statutEmprunt): self
    {
        $this->statutEmprunt = $statutEmprunt;

        return $this;
    }

    public function getIncident(): ?string
    {
        return $this->incident;
    }

    public function setIncident(?string $incident): self
    {
        $this->incident = $incident;

        return $this;
    }

    public function getId(): ?Materiel
    {
        return $this->id;
    }

    public function setId(?Materiel $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getIdemprunteur(): ?Emprunteur
    {
        return $this->idemprunteur;
    }

    public function setIdemprunteur(?Emprunteur $idemprunteur): self
    {
        $this->idemprunteur = $idemprunteur;

        return $this;
    }


}
