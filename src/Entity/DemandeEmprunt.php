<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeEmprunt
 *
 * @ORM\Table(name="demande_emprunt", indexes={@ORM\Index(name="fk344343", columns={"id_user"}), @ORM\Index(name="fk3434", columns={"id_materiel"}), @ORM\Index(name="fk656565", columns={"statut"})})
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateDemande = 'CURRENT_TIMESTAMP';

    /**
     * @var \Materiel
     *
     * @ORM\ManyToOne(targetEntity="Materiel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_materiel", referencedColumnName="Id")
     * })
     */
    private $idMateriel;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \StatutDemandeEmprunt
     *
     * @ORM\ManyToOne(targetEntity="StatutDemandeEmprunt")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="statut", referencedColumnName="id")
     * })
     */
    private $statut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

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

    public function getStatut(): ?StatutDemandeEmprunt
    {
        return $this->statut;
    }

    public function setStatut(?StatutDemandeEmprunt $statut): self
    {
        $this->statut = $statut;

        return $this;
    }


}
