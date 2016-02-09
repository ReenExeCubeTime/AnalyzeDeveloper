<?php

namespace AppBundle\Service;

use AppBundle\Service\DevelopProfile\SearchServiceInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;

class DeveloperSearcherFactory
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return SearchServiceInterface
     */
    public function createSearcher()
    {
        return $this->doctrine->getRepository('AppBundle:SDeveloperProfile');
    }
}
