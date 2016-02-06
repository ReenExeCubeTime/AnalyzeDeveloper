<?php

namespace AppBundle\Service\DevelopProfile\Doctrine;

use AppBundle\Repository\CriteriaListRepositoryInterface;
use AppBundle\Service\DevelopProfile\CriteriaProviderInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;

class CriteriaProvider implements CriteriaProviderInterface
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getSkillList()
    {
        $existSkillIdList = $this
            ->doctrine
            ->getRepository('AppBundle:SDeveloperProfileToSkill')
            ->getAllSkillIdList();

        return $this->getCriteriaList(
            $existSkillIdList,
            $this->doctrine->getRepository('AppBundle:SSkill')
        );
    }

    public function getCityList()
    {
        $existCityIdList = $this
            ->doctrine
            ->getRepository('AppBundle:SDeveloperProfile')
            ->getAllCityIdList();

        return $this->getCriteriaList(
            $existCityIdList,
            $this->doctrine->getRepository('AppBundle:SCity')
        );
    }

    private function getCriteriaList(array $idList, CriteriaListRepositoryInterface $repository)
    {
        return $idList ? $repository->getCriteriaList($idList) : [];
    }
}
