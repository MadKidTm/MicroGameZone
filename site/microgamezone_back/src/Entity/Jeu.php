<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Jeu
 *
 * @ORM\Table(name="jeu", indexes={@ORM\Index(name="IDX_82E48DB5DB3AEE9F", columns={"id_editeur"}), @ORM\Index(name="IDX_82E48DB53AE20D30", columns={"id_developpeur"})})
 * @ORM\Entity
 */
class Jeu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="jeu_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", nullable=false)
     */
    private $titre;

    /**
     * @var \Editeur
     *
     * @ORM\ManyToOne(targetEntity="Editeur", cascade={"All"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_editeur", referencedColumnName="id")
     * })
     */
    private $editeur;

    /**
     * @var \Developpeur
     *
     * @ORM\ManyToOne(targetEntity="Developpeur", cascade={"All"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_developpeur", referencedColumnName="id")
     * })
     */
    private $developpeur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Commande", inversedBy="idJeu", cascade={"All"})
     * @ORM\JoinTable(name="vente",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_jeu", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="num_commande", referencedColumnName="num_commande")
     *   }
     * )
     */
    private $numCommande;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Plateforme", mappedBy="idJeu", cascade={"All"})
     */
    private $nomPlateforme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="idJeu", cascade={"All"})
     * @ORM\JoinTable(name="genre_jeu",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_jeu", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="libelle_genre", referencedColumnName="libelle")
     *   }
     * )
     */
    private $libelleGenre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->numCommande = new \Doctrine\Common\Collections\ArrayCollection();
        $this->nomPlateforme = new \Doctrine\Common\Collections\ArrayCollection();
        $this->libelleGenre = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->editeur;
    }

    public function setEditeur(?Editeur $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getDeveloppeur(): ?Developpeur
    {
        return $this->developpeur;
    }

    public function setDeveloppeur(?Developpeur $developpeur): self
    {
        $this->developpeur = $developpeur;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getNumCommande(): Collection
    {
        return $this->numCommande;
    }

    public function addNumCommande(Commande $numCommande): self
    {
        if (!$this->numCommande->contains($numCommande)) {
            $this->numCommande[] = $numCommande;
        }

        return $this;
    }

    public function removeNumCommande(Commande $numCommande): self
    {
        if ($this->numCommande->contains($numCommande)) {
            $this->numCommande->removeElement($numCommande);
        }

        return $this;
    }

    /**
     * @return Collection|Plateforme[]
     */
    public function getNomPlateforme(): Collection
    {
        return $this->nomPlateforme;
    }

    public function addNomPlateforme(Plateforme $nomPlateforme): self
    {
        if (!$this->nomPlateforme->contains($nomPlateforme)) {
            $this->nomPlateforme[] = $nomPlateforme;
            $nomPlateforme->addIdJeu($this);
        }

        return $this;
    }

    public function removeNomPlateforme(Plateforme $nomPlateforme): self
    {
        if ($this->nomPlateforme->contains($nomPlateforme)) {
            $this->nomPlateforme->removeElement($nomPlateforme);
            $nomPlateforme->removeIdJeu($this);
        }

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getLibelleGenre(): Collection
    {
        return $this->libelleGenre;
    }

    public function addLibelleGenre(Genre $libelleGenre): self
    {
        if (!$this->libelleGenre->contains($libelleGenre)) {
            $this->libelleGenre[] = $libelleGenre;
        }

        return $this;
    }

    public function removeLibelleGenre(Genre $libelleGenre): self
    {
        if ($this->libelleGenre->contains($libelleGenre)) {
            $this->libelleGenre->removeElement($libelleGenre);
        }

        return $this;
    }

}
