<?php

namespace App\Repository;

use App\Entity\Condidature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Condidature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Condidature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Condidature[]    findAll()
 * @method Condidature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CondidatureRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, Condidature::class);
        $this->manager = $manager;
    }

    public function saveCondidature($applicateur, $patisserie, $etat, $message, $cv)
    {
        $newCondidature = new Condidature();

        $newCondidature
            ->setApplicateur($applicateur)
            ->setPatisserie($patisserie)
            ->setEtat($etat)
            ->setMessage($message)
            ->setCv($cv);

        $this->manager->persist($newCondidature);
        $this->manager->flush();
    }

    public function updateCondidature(Condidature $condidature, $data)
    {
        empty($data['applicateur']) ? true : $condidature->setApplicateur($data['applicateur']);
        empty($data['patisserie']) ? true : $condidature->setPatisserie($data['patisserie']);
        empty($data['etat']) ? true : $condidature->setEtat($data['etat']);
        empty($data['message']) ? true : $condidature->setMessage($data['message']);
        empty($data['cv']) ? true : $condidature->setCv($data['cv']);

        $this->manager->flush();
    }

    public function removeCondidature(Condidature $condidature)
    {
        $this->manager->remove($condidature);
        $this->manager->flush();
    }
}
