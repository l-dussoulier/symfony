<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MembreAsso
 *
 * @ORM\Table(name="membre_asso")
 * @ORM\Entity
 */
class MembreAsso
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMembre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmembre;

    /**
     * @var string
     *
     * @ORM\Column(name="NomMembre", type="string", length=50, nullable=false)
     */
    private $nommembre;

    /**
     * @var string
     *
     * @ORM\Column(name="PrenomMembre", type="string", length=50, nullable=false)
     */
    private $prenommembre;

    public function getIdmembre(): ?int
    {
        return $this->idmembre;
    }

    public function getNommembre(): ?string
    {
        return $this->nommembre;
    }

    public function setNommembre(string $nommembre): self
    {
        $this->nommembre = $nommembre;

        return $this;
    }

    public function getPrenommembre(): ?string
    {
        return $this->prenommembre;
    }

    public function setPrenommembre(string $prenommembre): self
    {
        $this->prenommembre = $prenommembre;

        return $this;
    }


}
