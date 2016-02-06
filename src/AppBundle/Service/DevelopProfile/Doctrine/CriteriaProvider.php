<?php

namespace AppBundle\Service\DevelopProfile\Doctrine;

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

        return $existSkillIdList
            ? $this->doctrine->getRepository('AppBundle:SSkill')->getNameList($existSkillIdList)
            : [];
    }

    public function getCityList()
    {
        $existCityIdList = $this
            ->doctrine
            ->getRepository('AppBundle:SDeveloperProfile')
            ->getAllCityIdList();

        return $existCityIdList
            ? $this->doctrine->getRepository('AppBundle:SCity')->getNameList($existCityIdList)
            : [];
    }
}
