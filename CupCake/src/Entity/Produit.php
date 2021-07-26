<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="ref_pdt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("post:read")
     */
    private $refPdt;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     * @Groups("post:read")
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="qte_stock", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $qteStock;


    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     * @Groups("post:read")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Patisserie::class, inversedBy="produits", cascade={"persist"})
     */
    private $patisserie;

    /**
     * @return int
     */
    public function getRefPdt(): ?int
    {
        return $this->refPdt;
    }

    /**
     * @param int $refPdt
     */
    public function setRefPdt(int $refPdt): void
    {
        $this->refPdt = $refPdt;
    }

    /**
     * @return string
     */
    public function getDesignation(): string
    {
        return $this->designation;
    }

    /**
     * @param string $designation
     */
    public function setDesignation(string $designation): void
    {
        $this->designation = $designation;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getPrix(): int
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix(int $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getQteStock(): int
    {
        return $this->qteStock;
    }

    /**
     * @param int $qteStock
     */
    public function setQteStock(int $qteStock): void
    {
        $this->qteStock = $qteStock;
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

    public function getPatisserie(): ?Patisserie
    {
        return $this->patisserie;
    }

    public function setPatisserie(?Patisserie $patisserie): self
    {
        $this->patisserie = $patisserie;

        return $this;
    }


}