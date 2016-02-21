<?php

namespace AppBundle\Presentation;

use ReenExeCubeTime\LightPaginator\Pager;

interface DeveloperSearchPagePresentationInterface
{
    /**
     * @return Pager
     */
    public function getPager();

    /**
     * @return array
     */
    public function getResults();
}
