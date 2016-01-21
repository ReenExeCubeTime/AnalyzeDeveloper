<?php

namespace AppBundle\Services;

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
        if ($this->exists($name)) return;

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
        return (bool)$this->doctrine->getRepository('AppBundle:SSkill')->findOneBy([
            'name' => $name
        ]);
    }

    public function clear()
    {
        /* @var $connection \Doctrine\DBAL\Connection */
        $connection = $this->doctrine->getConnection();

        /* @var $metadata ClassMetadata */
        $metadata = $this->doctrine->getManager()->getClassMetadata('AppBundle:SSkill');

        $connection->executeQuery("TRUNCATE TABLE {$metadata->table['name']};");
    }
}
