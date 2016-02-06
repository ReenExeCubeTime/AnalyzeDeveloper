<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

trait ExistIdListRepositoryTrait
{
    public function existIdList(array $idList)
    {
        /* @var $this EntityRepository */
        $source = $this->createQueryBuilder('t')
            ->select('t.id')
            ->where('t.id IN (:idList)')
            ->setParameter('idList', $idList)
            ->getQuery()
            ->getResult();

        return array_column($source, 'id');
    }
}
