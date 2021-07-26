<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity
 */
class Competition
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_competition", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("post:read")

     */
    private $idCompetition;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     * @Groups("post:read")
     */
    private $dateDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     * @Groups("post:read")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_competition", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $nomCompetition;

    /**
     * @return int
     */
    public function getIdCompetition(): ?int
    {
        return $this->idCompetition;
    }

    /**
     * @param int $idCompetition
     */
    public function setIdCompetition(?int $idCompetition): void
    {
        $this->idCompetition = $idCompetition;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime|null $dateDebut
     */
    public function setDateDebut(?\DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime|null $dateFin
     */
    public function setDateFin(?\DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return string
     */
    public function getNomCompetition(): string
    {
        return $this->nomCompetition;
    }

    /**
     * @param string $nomCompetition
     */
    public function setNomCompetition(?string $nomCompetition): void
    {
        $this->nomCompetition = $nomCompetition;
    }


}
