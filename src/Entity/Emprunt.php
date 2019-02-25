<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emprunt
 *
 * @ORM\Table(name="emprunt", indexes={@ORM\Index(name="emprunt_emprunteur_FK", columns={"idUser"})})
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
     * @ORM\Column(name="idUser", type="integer", nullable=true)
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="idMateriel", type="integer", nullable=false)
     */
    private $idmateriel;

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

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(?int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getIdmateriel(): ?int
    {
        return $this->idmateriel;
    }

    public function setIdmateriel(int $idmateriel): self
    {
        $this->idmateriel = $idmateriel;

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


}
