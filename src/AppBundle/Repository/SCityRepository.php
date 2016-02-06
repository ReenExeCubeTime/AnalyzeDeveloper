<?php

namespace AppBundle\Repository;

use AppBundle\Common\ExistIdListInterface;
use Doctrine\ORM\EntityRepository;

class SCityRepository
    extends EntityRepository
    implements ExistIdListInterface, CriteriaListRepositoryInterface
{
    use ExistIdListRepositoryTrait;

    public function getCriteriaList(array $idList)
    {
        return $this->createQueryBuilder('c')
            ->select('c.id, c.name')
            ->where('c.id IN (:idList)')
            ->setParameter('idList', $idList)
            ->getQuery()
            ->getResult();
    }
}
