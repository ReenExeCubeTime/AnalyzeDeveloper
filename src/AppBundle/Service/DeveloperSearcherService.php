<?php

namespace AppBundle\Service;

use AppBundle\Service\DevelopProfile\SearchServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearcherService implements DeveloperSearcherServiceInterface
{
    private $search;

    private $parser;

    public function __construct(SearchServiceInterface $search, ParameterParserInterface $parser)
    {
        $this->search = $search;
        $this->parser = $parser;
    }

    /**
     * @param ParameterBag $parameters
     * @return \AppBundle\Entity\SDeveloperProfile[]|array
     */
    public function search(ParameterBag $parameters)
    {
        return $this->search->search($this->parser->parse($parameters), 0, 1024);
    }

    public function count(ParameterBag $parameters)
    {
        return $this->search->count($this->parser->parse($parameters));
    }
}
