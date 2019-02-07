<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partie
 *
 * @ORM\Table(name="partie", indexes={@ORM\Index(name="FK_JOUEUR1", columns={"joueur1"}), @ORM\Index(name="FK_JOUEUR2", columns={"joueur2"})})
 * @ORM\Entity
 */
class Partie
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="points_joueur1", type="integer", nullable=false)
     */
    private $pointsJoueur1;

    /**
     * @var integer
     *
     * @ORM\Column(name="points_joueur2", type="integer", nullable=false)
     */
    private $pointsJoueur2;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur", inversedBy="parties1")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="joueur1", referencedColumnName="id")
     * })
     */
    private $joueur1;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur", inversedBy="parties2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="joueur2", referencedColumnName="id")
     * })
     */
    private $joueur2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPointsJoueur1(): ?int
    {
        return $this->pointsJoueur1;
    }

    public function setPointsJoueur1(int $pointsJoueur1): self
    {
        $this->pointsJoueur1 = $pointsJoueur1;

        return $this;
    }

    public function getPointsJoueur2(): ?int
    {
        return $this->pointsJoueur2;
    }

    public function setPointsJoueur2(int $pointsJoueur2): self
    {
        $this->pointsJoueur2 = $pointsJoueur2;

        return $this;
    }

    public function getJoueur1(): ?Joueur
    {
        return $this->joueur1;
    }

    public function setJoueur1(?Joueur $joueur1): self
    {
        $this->joueur1 = $joueur1;

        return $this;
    }

    public function getJoueur2(): ?Joueur
    {
        return $this->joueur2;
    }

    public function setJoueur2(?Joueur $joueur2): self
    {
        $this->joueur2 = $joueur2;

        return $this;
    }


}

