<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Utilisateur;

/**
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="integer")
     */
    private $cible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cibletype;
    
    public function __construct(int $a, Utilisateur $b, int $d, string $c)
    {
        $this->setNote($a);
        $this->setUtilisateur($b);
        $this->setCible($d);
        $this->setCibletype($c);
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getCible(): ?int
    {
        return $this->cible;
    }

    public function setCible(int $cible): self
    {
        $this->cible = $cible;

        return $this;
    }

    public function getCibletype(): ?string
    {
        return $this->cibletype;
    }

    public function setCibletype(string $cibletype): self
    {
        $this->cibletype = $cibletype;

        return $this;
    }
}
