<?php

namespace AppBundle\Service;

use AppBundle\Entity\SDeveloperProfileSearchParameter;
use AppBundle\Searcher\DevelopProfileParameter;
use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearchParameterParser implements ParameterParser
{
    const SKILL = 's';

    public function parse(ParameterBag $parameters)
    {
        return new DevelopProfileParameter(str_repeat('*', SDeveloperProfileSearchParameter::SKILL_BIT_SET_SIZE));
    }
}
