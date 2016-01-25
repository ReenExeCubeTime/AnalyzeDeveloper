<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\ParameterBag;

interface ParameterParser
{
    public function parse(ParameterBag $parameters);
}
