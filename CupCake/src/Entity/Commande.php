<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ref_cmd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_cmd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat_cmd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefCmd(): ?string
    {
        return $this->ref_cmd;
    }

    public function setRefCmd(string $ref_cmd): self
    {
        $this->ref_cmd = $ref_cmd;

        return $this;
    }

    public function getDateCmd(): ?string
    {
        return $this->date_cmd;
    }

    public function setDateCmd(string $date_cmd): self
    {
        $this->date_cmd = $date_cmd;

        return $this;
    }

    public function getEtatCmd(): ?string
    {
        return $this->etat_cmd;
    }

    public function setEtatCmd(string $etat_cmd): self
    {
        $this->etat_cmd = $etat_cmd;

        return $this;
    }
}
