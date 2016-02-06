<?php

namespace AppBundle\Repository;

use AppBundle\Searcher\DevelopProfileParameter;
use Doctrine\ORM\QueryBuilder;

/**
 * SDeveloperProfileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SDeveloperProfileRepository extends \Doctrine\ORM\EntityRepository
{
    public function search(DevelopProfileParameter $developProfileParameter)
    {
        $queryBuilder = $this->createQueryBuilder('dp');

        $this->useSearchParameter($queryBuilder, $developProfileParameter);

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    private function useSearchParameter(QueryBuilder $queryBuilder, DevelopProfileParameter $developProfileParameter)
    {
        if ($skillBitSetPattern = $developProfileParameter->getSkillBitSetPattern()) {
            $queryBuilder
                ->join('dp.searchParameter', 'sp')
                ->andWhere('sp.skillBitSet LIKE :skillBitSetPattern')
                ->setParameter('skillBitSetPattern', $skillBitSetPattern);
        }

        if ($cityIdList = $developProfileParameter->getCityIdList()) {
            $queryBuilder
                ->andWhere('dp.cityId IN (:cityIdList)')
                ->setParameter('cityIdList', $cityIdList);
        }
    }

    /**
     * @return array
     */
    public function getAllCityIdList()
    {
        $source = $this
            ->createQueryBuilder('dp')
            ->distinct(true)
            ->select('dp.cityId')
            ->getQuery()
            ->getResult();

        return array_column($source, 'cityId');
    }
}
