<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    // /**
    //  * @return Utilisateur[] Returns an array of Utilisateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findOneByIdSecure($id)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u.id, u.nom, u.prenom, u.email, u.adresse, u.tel, u.username 
            FROM App\Entity\Utilisateur u
            WHERE u.id = :id'
        )->setParameter('id', $id);
        return $query->getOneOrNullResult();
    }

    public function findOneByUsernameSecure($username)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u.id, u.nom, u.prenom, u.email, u.adresse, u.tel, u.username 
            FROM App\Entity\Utilisateur u
            WHERE u.username = :username'
        )->setParameter('username', $username);
        return $query->getOneOrNullResult();
    }

    public function findMultipleSecure($chaine)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u.id, u.nom, u.prenom, u.email, u.adresse, u.tel, u.username 
            FROM App\Entity\Utilisateur u
            WHERE u.nom LIKE :chaine OR u.prenom LIKE :chaine OR u.email LIKE :chaine'
        )->setParameter('chaine', '%'.$chaine.'%');
        return $query->execute();
    }
    
}
