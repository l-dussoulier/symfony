<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur")
 * @ORM\Entity
 */
class Joueur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="text", length=65535, nullable=false)
     */
    private $nom;


    /**
    * @ORM\OneToMany(targetEntity="Partie", mappedBy="joueur1")
    *
    */
    private $parties1;



    /**
    * @ORM\OneToMany(targetEntity="Partie", mappedBy="joueur2")
    *
    */
    private $parties2; 

//-------------------------------------------------------
// PROPRIETES AJOUTEES
//-------------------------------------------------------

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="text", length=65535, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", length=65535, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="text", length=65535, nullable=false)
     */
    private $telephone;

//-------------------------------------------------------
// PROPRIETES AJOUTEES | FIN
//-------------------------------------------------------




    public function __construct() {
        $this->parties1 = new ArrayCollection();
        $this->parties2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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


    /**
     * @return Collection|Parties[]
     */
    public function getParties1(): Collection
    {
        return $this->parties1;
    }

    public function addParties1(Partie $partie): self
    {
        $this->partie1[] = $partie;
        return $this;
    }

    public function removeParties1(Partie $partie): self
    {
        if ($this->partie1->contains($partie)) {
            $this->partie1->removeElement($partie);
        }

        return $this;
    }


    /**
     * @return Collection|Parties[]
     */
    public function getParties2(): Collection
    {
        return $this->parties2;
    }

    public function addParties2(Partie $partie): self
    {
        $this->partie2[] = $partie;
        return $this;
    }

    public function removeParties2(Partie $partie): self
    {
        if ($this->partie2->contains($partie)) {
            $this->partie2->removeElement($partie);
        }

        return $this;
    }




//-------------------------------------------------------
// METHODES AJOUTEES
//-------------------------------------------------------


    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }


//-------------------------------------------------------
// METHODES AJOUTEES | FIN
//-------------------------------------------------------


}

