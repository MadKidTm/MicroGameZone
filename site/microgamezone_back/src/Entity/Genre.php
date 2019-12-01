<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="genre_libelle_seq", allocationSize=1, initialValue=1)
     */
    private $libelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Jeu", mappedBy="libelleGenre")
     */
    private $idJeu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idJeu = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Jeu[]
     */
    public function getIdJeu(): Collection
    {
        return $this->idJeu;
    }

    public function addIdJeu(Jeu $idJeu): self
    {
        if (!$this->idJeu->contains($idJeu)) {
            $this->idJeu[] = $idJeu;
            $idJeu->addLibelleGenre($this);
        }

        return $this;
    }

    public function removeIdJeu(Jeu $idJeu): self
    {
        if ($this->idJeu->contains($idJeu)) {
            $this->idJeu->removeElement($idJeu);
            $idJeu->removeLibelleGenre($this);
        }

        return $this;
    }

}
