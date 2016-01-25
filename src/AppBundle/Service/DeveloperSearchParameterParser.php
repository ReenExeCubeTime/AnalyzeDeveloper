<?php

namespace AppBundle\Service;

use AppBundle\Searcher\DevelopProfileParameter;
use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearchParameterParser implements ParameterParser
{
    const SKILL = 's';

    public function parse(ParameterBag $parameters)
    {
        return new DevelopProfileParameter();
    }
}
