<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, Commande::class);
        $this->manager = $manager;
    }

    public function saveCommande($ref_cmd, $date_cmd, $etat_cmd)
    {
        $newCommande = new Commande();

        $newCommande
            ->setRefCmd($ref_cmd)
            ->setDateCmd($date_cmd)
            ->setEtatCmd($etat_cmd);


        $this->manager->persist($newCommande);
        $this->manager->flush();
    }

    public function updateCommande(Commande $commande, $data)
    {
        empty($data['ref_cmd']) ? true : $commande->setRefCmd($data['ref_cmd']);
        empty($data['date_cmd']) ? true : $commande->setDateCmd($data['date_cmd']);
        empty($data['etat_cmd']) ? true : $commande->setEtatCmd($data['etat_cmd']);

        $this->manager->flush();
    }

    public function removeCommande(Commande $commande)
    {
        $this->manager->remove($commande);
        $this->manager->flush();
    }
}
