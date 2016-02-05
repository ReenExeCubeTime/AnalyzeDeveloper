<?php

namespace AppBundle\Service;

use AppBundle\Searcher\DevelopProfileParameter;
use AppBundle\Service\DevelopProfile\SearchParameterService;
use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearchParameterParser implements ParameterParserInterface
{
    const SKILL = 's';
    const SKILL_NAME = 'skills';

    const CITY = 'c';
    const CITY_NAME = 'cities';

    /**
     * @var SkillService
     */
    private $skillService;

    /**
     * @var SearchParameterService
     */
    private $searchParameter;

    public function __construct(SkillService $skillService, SearchParameterService $searchParameter)
    {
        $this->skillService = $skillService;

        $this->searchParameter = $searchParameter;
    }

    public function parse(ParameterBag $parameters)
    {
        return new DevelopProfileParameter(
            $this->getSkillBitSet($parameters->get(self::SKILL))
        );
    }

    private function getSkillBitSet($skillAliases)
    {
        if (empty($skillAliases)) {
            return false;
        }

        $skillAliasList = explode(',', $skillAliases);
        $skillIdList = $this->skillService->getIdList($skillAliasList);

        if (empty($skillIdList)) {
            return false;
        }

        $emptySkillBitSet = $this->searchParameter->getSkillBitSet('_');

        foreach ($skillIdList as $skillId) {
            $emptySkillBitSet[$skillId] = '1';
        }

        return $emptySkillBitSet;
    }
}
