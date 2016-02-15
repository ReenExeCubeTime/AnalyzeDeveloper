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
     * @param $offset
     * @param $limit
     * @return \AppBundle\Entity\SDeveloperProfile[]|array
     */
    public function search(ParameterBag $parameters, $offset, $limit)
    {
        return $this->search->search($this->parser->parse($parameters), $offset, $limit);
    }

    public function count(ParameterBag $parameters)
    {
        return $this->search->count($this->parser->parse($parameters));
    }
}
