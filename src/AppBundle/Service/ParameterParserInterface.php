<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\ParameterBag;

interface ParameterParserInterface
{
    public function parse(ParameterBag $parameters);
}
