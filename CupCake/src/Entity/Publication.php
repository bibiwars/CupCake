<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity
 */
class Publication
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_publication", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPublication;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idcompetition", type="integer", nullable=true)
     * @Groups("post:read")
     */
    private $idcompetition;


    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $texte;

    /**
     * @var string|null
     *
     * @ORM\Column(name="media", type="string", length=255, nullable=true)
     * @Groups("post:read")
     */
    private $media;

    /**
     * @return int
     */
    public function getIdPublication(): int
    {
        return $this->idPublication;
    }

    /**
     * @param int $idPublication
     */
    public function setIdPublication(int $idPublication): void
    {
        $this->idPublication = $idPublication;
    }

    /**
     * @return int|null
     */
    public function getIdcompetition(): ?int
    {
        return $this->idcompetition;
    }

    /**
     * @param int|null $idcompetition
     */
    public function setIdcompetition(?int $idcompetition): void
    {
        $this->idcompetition = $idcompetition;
    }


    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(?string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getTexte(): string
    {
        return $this->texte;
    }

    /**
     * @param string $texte
     */
    public function setTexte(?string $texte): void
    {
        $this->texte = $texte;
    }

    /**
     * @return string|null
     */
    public function getMedia(): ?string
    {
        return $this->media;
    }

    /**
     * @param string|null $media
     */
    public function setMedia(?string $media): void
    {
        $this->media = $media;
    }


}