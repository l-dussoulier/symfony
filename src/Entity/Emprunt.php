<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emprunt
 *
 * @ORM\Table(name="emprunt", indexes={@ORM\Index(name="emprunt_emprunteur_FK", columns={"idUser"})})
 * @ORM\Entity(repositoryClass="App\Repository\EmpruntRepository")
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
     * @var \Materiel
     *
     * @ORM\ManyToOne(targetEntity="Materiel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMateriel", referencedColumnName="Id")
     * })
     */
    private $idMateriel;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Incident", type="string", length=1000, nullable=true)
     */
    private $incident;

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

    public function getIdMateriel(): ?Materiel
    {
        return $this->idMateriel;
    }

    public function setIdMateriel(?Materiel $idMateriel): self
    {
        $this->idMateriel = $idMateriel;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

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


}
