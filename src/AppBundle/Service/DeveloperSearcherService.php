<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\ParameterBag;
use Doctrine\Bundle\DoctrineBundle\Registry;

class DeveloperSearcherService implements DeveloperSearcherServiceInterface
{
    private $doctrine;

    private $parser;

    public function __construct(Registry $doctrine, DeveloperSearchParameterParser $parser)
    {
        $this->doctrine = $doctrine;
        $this->parser = $parser;
    }

    /**
     * @param ParameterBag $parameters
     * @return \AppBundle\Entity\SDeveloperProfile[]|array
     */
    public function search(ParameterBag $parameters)
    {
        return $this
            ->doctrine
            ->getManager()
            ->getRepository('AppBundle:SDeveloperProfile')
            ->search($this->parser->parse($parameters), 0, 1024);
    }

    public function count(ParameterBag $parameters)
    {
        return $this
            ->doctrine
            ->getManager()
            ->getRepository('AppBundle:SDeveloperProfile')
            ->count($this->parser->parse($parameters));
    }
}
