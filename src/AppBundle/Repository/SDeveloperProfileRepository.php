<?php

namespace AppBundle\Repository;

/**
 * SDeveloperProfileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SDeveloperProfileRepository extends \Doctrine\ORM\EntityRepository
{
    public function search(array $skillIdList)
    {
        return $this
            ->createQueryBuilder('dp')
            ->getQuery()
            ->getResult();
    }
}
