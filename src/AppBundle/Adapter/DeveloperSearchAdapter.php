<?php

namespace AppBundle\Adapter;

use AppBundle\Searcher\DevelopProfileParameter;
use AppBundle\Service\DevelopProfile\SearchServiceInterface;
use ReenExeCubeTime\LightPaginator\Adapter\AdapterInterface;

class DeveloperSearchAdapter implements AdapterInterface
{
    /**
     * @var SearchServiceInterface
     */
    private $search;

    /**
     * @var DevelopProfileParameter
     */
    private $parameter;

    public function __construct(SearchServiceInterface $search, DevelopProfileParameter $parameter)
    {
        $this->search = $search;
        $this->parameter = $parameter;
    }

    /**
     * Returns the number of results.
     *
     * @return integer The number of results.
     */
    public function getCount()
    {
        return $this->search->count($this->parameter);
    }

    /**
     * Returns an slice of the results.
     *
     * @param integer $offset The offset.
     * @param integer $length The length.
     *
     * @return array|\Traversable The slice.
     */
    public function getSlice($offset, $length)
    {
        return $this->search->search($this->parameter, $offset, $length);
    }
}
