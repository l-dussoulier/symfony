<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materiel
 *
 * @ORM\Table(name="Materiel", indexes={@ORM\Index(name="Categorie", columns={"Categorie"}), @ORM\Index(name="Etat", columns={"Etat"}), @ORM\Index(name="Marque", columns={"Marque"})})
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
     * @var bool|null
     *
     * @ORM\Column(name="StatutEmprunt", type="boolean", nullable=true)
     */
    private $statutemprunt;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Categorie", referencedColumnName="Id")
     * })
     */
    private $categorie;

    /**
     * @var \Etat
     *
     * @ORM\ManyToOne(targetEntity="Etat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Etat", referencedColumnName="id")
     * })
     */
    private $etat;

    /**
     * @var \Marque
     *
     * @ORM\ManyToOne(targetEntity="Marque")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Marque", referencedColumnName="id")
     * })
     */
    private $marque;

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

    public function getStatutemprunt(): ?bool
    {
        return $this->statutemprunt;
    }

    public function setStatutemprunt(?bool $statutemprunt): self
    {
        $this->statutemprunt = $statutemprunt;

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

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }


}
