<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CondidatureRepository")
 */
class Condidature
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $applicateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $patisserie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApplicateur(): ?string
    {
        return $this->applicateur;
    }

    public function setApplicateur(string $applicateur): self
    {
        $this->applicateur = $applicateur;

        return $this;
    }

    public function getPatisserie(): ?string
    {
        return $this->patisserie;
    }

    public function setPatisserie(string $patisserie): self
    {
        $this->patisserie = $patisserie;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }
}
