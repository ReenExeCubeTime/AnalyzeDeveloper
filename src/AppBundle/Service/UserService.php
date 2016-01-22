<?php

namespace AppBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;

class UserService
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getUser()
    {
        return $this->doctrine->getManager()->getReference('AppBundle:SUser', 1);
    }
}
