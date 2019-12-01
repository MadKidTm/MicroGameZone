<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Plateforme
 *
 * @ORM\Table(name="plateforme")
 * @ORM\Entity
 */
class Plateforme
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_plateforme", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="plateforme_nom_plateforme_seq", allocationSize=1, initialValue=1)
     */
    private $nomPlateforme;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_de_sortie", type="date", nullable=true)
     */
    private $dateDeSortie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Jeu", inversedBy="nomPlateforme", cascade={"All"}, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="stock",
     *   joinColumns={
     *     @ORM\JoinColumn(name="nom_plateforme", referencedColumnName="nom_plateforme")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_jeu", referencedColumnName="id")
     *   }
     * )
     */
    private $idJeu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idJeu = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNomPlateforme(): ?string
    {
        return $this->nomPlateforme;
    }

    public function getDateDeSortie(): ?\DateTimeInterface
    {
        return $this->dateDeSortie;
    }

    public function setDateDeSortie(?\DateTimeInterface $dateDeSortie): self
    {
        $this->dateDeSortie = $dateDeSortie;

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
        }

        return $this;
    }

    public function removeIdJeu(Jeu $idJeu): self
    {
        if ($this->idJeu->contains($idJeu)) {
            $this->idJeu->removeElement($idJeu);
        }

        return $this;
    }

}
