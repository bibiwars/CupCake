<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity
 */
class Note
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("post:read")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="utilisateur_id", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $utilisateurId;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="cible", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $cible;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUtilisateurId(): int
    {
        return $this->utilisateurId;
    }

    /**
     * @param int $utilisateurId
     */
    public function setUtilisateurId(int $utilisateurId): void
    {
        $this->utilisateurId = $utilisateurId;
    }

    /**
     * @return int
     */
    public function getNote(): int
    {
        return $this->note;
    }

    /**
     * @param int $note
     */
    public function setNote(int $note): void
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getCible(): string
    {
        return $this->cible;
    }

    /**
     * @param string $cible
     */
    public function setCible(string $cible): void
    {
        $this->cible = $cible;
    }


}
