<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeEmprunt
 *
 * @ORM\Table(name="demande_emprunt")
 * @ORM\Entity
 */
class DemandeEmprunt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_membre", type="integer", nullable=true)
     */
    private $idMembre;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_demande", type="date", nullable=true)
     */
    private $dateDemande;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_materiel", type="integer", nullable=true)
     */
    private $idMateriel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="statut", type="integer", nullable=true)
     */
    private $statut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMembre(): ?int
    {
        return $this->idMembre;
    }

    public function setIdMembre(?int $idMembre): self
    {
        $this->idMembre = $idMembre;

        return $this;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(?\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getIdMateriel(): ?int
    {
        return $this->idMateriel;
    }

    public function setIdMateriel(?int $idMateriel): self
    {
        $this->idMateriel = $idMateriel;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(?int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }


}
