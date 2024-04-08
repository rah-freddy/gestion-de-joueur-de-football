<?php

namespace App\Repository;

use App\Entity\ClubTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClubTeam>
 *
 * @method ClubTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClubTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClubTeam[]    findAll()
 * @method ClubTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubTeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClubTeam::class);
    }

//    /**
//     * @return ClubTeam[] Returns an array of ClubTeam objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ClubTeam
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
