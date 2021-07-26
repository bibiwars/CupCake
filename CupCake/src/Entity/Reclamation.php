<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("post:read")
     */
    private $idReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="imessage", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $imessage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idutilisateur", type="integer", nullable=true)
     * @Groups("post:read")
     */
    private $idutilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $type;


    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $reponse;


    public function __construct()
    {
        $this->avis = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdReclamation(): ?int
    {
        return $this->idReclamation;
    }

    /**
     * @param int $idReclamation
     */
    public function setIdReclamation(?int $idReclamation): void
    {
        $this->idReclamation = $idReclamation;
    }

    /**
     * @return string
     */
    public function getImessage(): string
    {
        return $this->imessage;
    }

    /**
     * @param string $imessage
     */
    public function setImessage(string $imessage): void
    {
        $this->imessage = $imessage;
    }

    /**
     * @return int|null
     */
    public function getIdutilisateur(): ?int
    {
        return $this->idutilisateur;
    }

    /**
     * @param int|null $idutilisateur
     */
    public function setIdutilisateur(?int $idutilisateur): void
    {
        $this->idutilisateur = $idutilisateur;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    /**
     * @param string $reponse
     */
    public function setReponse(?string $reponse): void
    {
        $this->reponse = $reponse;
    }






}