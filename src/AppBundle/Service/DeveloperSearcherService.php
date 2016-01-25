<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\ParameterBag;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Tests\AppBundle\Service\DeveloperSearchParameterParser;

class DeveloperSearcherService implements DeveloperSearcherServiceInterface
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param ParameterBag $parameters
     * @return \AppBundle\Entity\SDeveloperProfile[]|array
     */
    public function search(ParameterBag $parameters)
    {
        $skills = $parameters->get(DeveloperSearchParameterParser::SKILL, []);

        return $this
            ->doctrine
            ->getManager()
            ->getRepository('AppBundle:SDeveloperProfile')
            ->search($skills);
    }
}
