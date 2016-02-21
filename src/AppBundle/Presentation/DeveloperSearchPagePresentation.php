<?php

namespace AppBundle\Presentation;

use ReenExeCubeTime\LightPaginator\PagerInterface;

class DeveloperSearchPagePresentation implements DeveloperSearchPagePresentationInterface
{
    /**
     * @var PagerInterface
     */
    private $pager;

    public function __construct(PagerInterface $pager)
    {
        $this->pager = $pager;
    }

    /**
     * @return PagerInterface
     */
    public function getPager()
    {
        return $this->pager;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->pager->getResults();
    }
}
