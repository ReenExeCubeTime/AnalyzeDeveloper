<?php

namespace AppBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Mapping\ClassMetadata;

class DatabaseTesterService
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function truncate($entity)
    {
        /* @var $connection \Doctrine\DBAL\Connection */
        $connection = $this->doctrine->getConnection();

        /* @var $metadata ClassMetadata */
        $metadata = $this->doctrine->getManager()->getClassMetadata("AppBundle:$entity");

        $connection->executeQuery("TRUNCATE TABLE {$metadata->table['name']};");
    }
}
