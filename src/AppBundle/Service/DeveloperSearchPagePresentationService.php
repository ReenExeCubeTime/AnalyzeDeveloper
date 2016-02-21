<?php

namespace AppBundle\Service;

use AppBundle\Adapter\DeveloperSearchAdapter;
use AppBundle\Presentation\DeveloperSearchPagePresentation;
use AppBundle\Presentation\DeveloperSearchPagePresentationInterface;
use AppBundle\Service\DevelopProfile\SearchServiceInterface;
use ReenExeCubeTime\LightPaginator\Factory;
use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearchPagePresentationService
{
    /**
     * @var Factory
     */
    private $pagerFactory;

    /**
     * @var SearchServiceInterface
     */
    private $search;

    /**
     * @var ParameterParserInterface
     */
    private $parser;

    public function __construct(Factory $pagerFactory, SearchServiceInterface $search, ParameterParserInterface $parser)
    {
        $this->pagerFactory = $pagerFactory;
        $this->search = $search;
        $this->parser = $parser;
    }

    /**
     * @param ParameterBag $parameters
     * @return DeveloperSearchPagePresentationInterface
     */
    public function getPresentation(ParameterBag $parameters)
    {
        $page = $parameters->get('page', 1);
        $limit = $parameters->get('limit', 20);

        $adapter = new DeveloperSearchAdapter($this->search, $this->parser->parse($parameters));

        $pager = $this->pagerFactory->createPager($adapter, $page, $limit);

        return new DeveloperSearchPagePresentation($pager);
    }
}
