<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Patisserie
 *
 * @ORM\Table(name="patisserie")
 * @ORM\Entity
 */
class Patisserie
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $tel;

    /**
     * @var int
     *
     * @ORM\Column(name="idutilisateur", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $idutilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $theme;

    /**
     * @var int
     *
     * @ORM\Column(name="activer", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $activer;

    /**
     * @return int
     */
    public function getId(): ?int
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
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return int
     */
    public function getTel(): int
    {
        return $this->tel;
    }

    /**
     * @param int $tel
     */
    public function setTel(int $tel): void
    {
        $this->tel = $tel;
    }

    /**
     * @return int
     */
    public function getIdutilisateur(): int
    {
        return $this->idutilisateur;
    }

    /**
     * @param int $idutilisateur
     */
    public function setIdutilisateur(int $idutilisateur): void
    {
        $this->idutilisateur = $idutilisateur;
    }

    /**
     * @return string
     */
    public function getTheme(): string
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     */
    public function setTheme(string $theme): void
    {
        $this->theme = $theme;
    }

    /**
     * @return int
     */
    public function getActiver(): int
    {
        return $this->activer;
    }

    /**
     * @param int $activer
     */
    public function setActiver(int $activer): void
    {
        $this->activer = $activer;
    }


}
