<?php

namespace AppBundle\Services;

use AppBundle\Entity\SSkill;
use Doctrine\Bundle\DoctrineBundle\Registry;

class SkillService
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function add($name)
    {
        $skill = new SSkill();

        $skill->setName($name);

        $this->doctrine->getManager()->persist($skill);
        $this->doctrine->getManager()->flush();
    }

    public function findAllLike($value)
    {
        return $this->doctrine->getRepository('AppBundle:SSkill')->findAllLike($value);
    }
}
