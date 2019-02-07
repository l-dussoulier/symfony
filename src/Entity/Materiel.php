<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materiel
 *
 * @ORM\Table(name="Materiel")
 * @ORM\Entity
 */
class Materiel
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Provenance", type="string", length=50, nullable=false)
     */
    private $provenance;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=50, nullable=false)
     */
    private $etat;


   /**
    * @var \Categorie
    *
    * @ORM\ManyToOne(targetEntity="Categorie")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="categorie", referencedColumnName="Id")
    * })
    */
    private $categorie;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="StatutEmprunt", type="boolean", nullable=true)
     */
    private $statutemprunt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProvenance(): ?string
    {
        return $this->provenance;
    }

    public function setProvenance(string $provenance): self
    {
        $this->provenance = $provenance;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getStatutemprunt(): ?bool
    {
        return $this->statutemprunt;
    }

    public function setStatutemprunt(?bool $statutemprunt): self
    {
        $this->statutemprunt = $statutemprunt;

        return $this;
    }


}
