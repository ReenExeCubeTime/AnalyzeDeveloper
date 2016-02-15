<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\ParameterBag;

interface DeveloperSearcherServiceInterface
{
    public function search(ParameterBag $parameters, $offset, $limit);

    public function count(ParameterBag $parameters);
}
