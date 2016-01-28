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
        return $this->doctrine->getRepository('AppBundle:SSkill')->getNameList();
    }
}
