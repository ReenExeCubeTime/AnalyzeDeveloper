<?php

namespace AppBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;

class DeveloperSearchParameterService
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getFilter()
    {
        return [
            DeveloperSearchParameterParser::SKILL => $this->getSkillList()
        ];
    }

    private function getSkillList()
    {
        return $this->doctrine->getRepository('AppBundle:SSkill')->getNameList();
    }
}
