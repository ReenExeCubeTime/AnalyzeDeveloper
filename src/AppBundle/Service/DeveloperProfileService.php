<?php

namespace AppBundle\Service;

use AppBundle\Entity\SCity;
use AppBundle\Entity\SDeveloperProfile;
use AppBundle\Entity\SDeveloperProfileSearchParameter;
use AppBundle\Entity\SDeveloperProfileToSkill;
use AppBundle\Entity\SUser;
use AppBundle\Service\DevelopProfile\SearchParameterService;
use Doctrine\Bundle\DoctrineBundle\Registry;

class DeveloperProfileService
{
    private $doctrine;

    private $searchParameter;

    public function __construct(Registry $doctrine, SearchParameterService $searchParameter)
    {
        $this->doctrine = $doctrine;

        $this->searchParameter = $searchParameter;
    }

    public function create(SUser $user, $title, $salary, $description, SCity $city, array $skills = [])
    {
        $profile = new SDeveloperProfile();

        $profile
            ->setUser($user)
            ->setCity($city)
            ->setTitle($title)
            ->setSalary($salary)
            ->setDescription($description);

        if ($skillCollection = $this->getSkillCollection($skills)) {
            $emptyBitSet = $this->searchParameter->getSkillBitSet();

            foreach ($skillCollection as $index => $skill) {
                $developerToSkill = new SDeveloperProfileToSkill();

                $emptyBitSet[$skill->getId()] = '1';

                $developerToSkill
                    ->setDeveloperProfile($profile)
                    ->setSkill($skill)
                    ->setScore(1)
                    ->setPosition($index);

                $this->doctrine->getManager()->persist($developerToSkill);
                $profile->addSkill($developerToSkill);
            }

            $searchParameter = new SDeveloperProfileSearchParameter();
            $searchParameter
                ->setDeveloperProfile($profile)
                ->setSkillBitSet($emptyBitSet);

            $this->doctrine->getManager()->persist($searchParameter);
            $profile->setSearchParameter($searchParameter);
        }

        $this->doctrine->getManager()->persist($profile);
        $this->doctrine->getManager()->flush();

        return $profile;
    }

    private function getSkillCollection(array $skills)
    {
        if ($skills) {
            return $this->doctrine->getRepository('AppBundle:SSkill')->findBy([
                'name' => $skills
            ]);
        }
    }
}
