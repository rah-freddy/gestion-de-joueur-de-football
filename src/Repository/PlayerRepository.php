<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Player>
 *
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function findDistinctsClub(): array
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.clubTeam', 'c')
            ->select('DISTINCT c.name')
            ->getQuery()
            ->getArrayResult();

        $clubNames = array_column($qb, 'name');

        return $clubNames;
    }

    public function findDistinctsNationalTeam(): array
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.nationalTeam', 'n')
            ->select('DISTINCT n.name')
            ->getQuery()
            ->getArrayResult();

        $nationaleTeamNames = array_column($qb, 'name');

        return $nationaleTeamNames;
    }
}
