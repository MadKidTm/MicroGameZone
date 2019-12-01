<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="IDX_6EEAA67DBADED7A5", columns={"email_client"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="num_commande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="commande_num_commande_seq", allocationSize=1, initialValue=1)
     */
    private $numCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande", type="date", nullable=false)
     */
    private $dateCommande;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="email_client", referencedColumnName="email")
     * })
     */
    private $emailClient;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Jeu", mappedBy="numCommande")
     */
    private $idJeu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idJeu = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNumCommande(): ?int
    {
        return $this->numCommande;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getEmailClient(): ?Client
    {
        return $this->emailClient;
    }

    public function setEmailClient(?Client $emailClient): self
    {
        $this->emailClient = $emailClient;

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
            $idJeu->addNumCommande($this);
        }

        return $this;
    }

    public function removeIdJeu(Jeu $idJeu): self
    {
        if ($this->idJeu->contains($idJeu)) {
            $this->idJeu->removeElement($idJeu);
            $idJeu->removeNumCommande($this);
        }

        return $this;
    }

}
