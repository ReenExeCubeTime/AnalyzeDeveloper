<?php

namespace AppBundle\Services;

use AppBundle\Entity\SDeveloperProfile;
use AppBundle\Entity\SUser;
use Doctrine\Bundle\DoctrineBundle\Registry;

class DeveloperProfileService
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function create(SUser $user, $title, $salary, $description)
    {
        $profile = new SDeveloperProfile();

        $profile
            ->setTitle($title)
            ->setSalary($salary)
            ->setDescription($description);

        $this->doctrine->getManager()->persist($profile);
        $this->doctrine->getManager()->flush();

        return $profile;
    }
}
