<?php

namespace AppBundle\Services;

use Doctrine\Bundle\DoctrineBundle\Registry;

class DeveloperProfileService
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function create()
    {

    }
}
