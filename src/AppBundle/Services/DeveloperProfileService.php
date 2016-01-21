<?php

namespace AppBundle\Services;

use AppBundle\Entity\SDeveloperProfile;
use AppBundle\Entity\SDeveloperProfileToSkill;
use AppBundle\Entity\SUser;
use Doctrine\Bundle\DoctrineBundle\Registry;

class DeveloperProfileService
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function create(SUser $user, $title, $salary, $description, array $skills = [])
    {
        $profile = new SDeveloperProfile();

        $profile
            ->setUser($user)
            ->setTitle($title)
            ->setSalary($salary)
            ->setDescription($description);

        if ($skills) {
            $skillCollection = $this->doctrine->getRepository('AppBundle:SSkill')->findBy([
                'name' => $skills
            ]);

            foreach ($skillCollection as $index => $skill) {
                $developerToSkill = new SDeveloperProfileToSkill();

                $developerToSkill
                    ->setDeveloperProfile($profile)
                    ->setSkill($skill)
                    ->setScore(1)
                    ->setIndex($index);

                $this->doctrine->getManager()->persist($developerToSkill);
            }
        }

        $this->doctrine->getManager()->persist($profile);
        $this->doctrine->getManager()->flush();

        return $profile;
    }
}
