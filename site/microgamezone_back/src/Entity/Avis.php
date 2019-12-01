<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="IDX_8F91ABF01C4065EF", columns={"id_jeu"}), @ORM\Index(name="IDX_8F91ABF0BADED7A5", columns={"email_client"})})
 * @ORM\Entity
 */
class Avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="avis_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="texte", type="string", nullable=true)
     */
    private $texte;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;

    /**
     * @var \Jeu
     *
     * @ORM\ManyToOne(targetEntity="Jeu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jeu", referencedColumnName="id")
     * })
     */
    private $idJeu;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="email_client", referencedColumnName="email")
     * })
     */
    private $emailClient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(?string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getIdJeu(): ?Jeu
    {
        return $this->idJeu;
    }

    public function setIdJeu(?Jeu $idJeu): self
    {
        $this->idJeu = $idJeu;

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


}
