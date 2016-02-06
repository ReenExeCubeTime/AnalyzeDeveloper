<?php

namespace AppBundle\Service;

use AppBundle\Entity\SSkill;
use AppBundle\Common\ExistIdListInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;

class SkillService implements ExistIdListInterface
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function create(... $names)
    {
        foreach ($names as $name) {
            $skill = new SSkill();

            $skill->setName($name);

            $this->doctrine->getManager()->persist($skill);
        }

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

    /**
     * @param array $idList
     * @return array
     */
    public function existIdList(array $idList)
    {
        return $this->doctrine->getRepository('AppBundle:SSkill')->existIdList($idList);
    }
}
