<?php

namespace AppBundle\Service;

use AppBundle\Entity\SSkill;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Mapping\ClassMetadata;

class SkillService
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function create($name)
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

    public function exists($name)
    {
        return $this->doctrine->getRepository('AppBundle:SSkill')->exists($name);
    }
}
