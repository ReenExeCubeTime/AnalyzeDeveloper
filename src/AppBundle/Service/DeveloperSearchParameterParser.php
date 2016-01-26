<?php

namespace AppBundle\Service;

use AppBundle\Searcher\DevelopProfileParameter;
use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearchParameterParser implements ParameterParser
{
    const SKILL = 's';

    /**
     * @var SkillService
     */
    private $skillService;

    /**
     * @var DevelopProfileSearchParameterService
     */
    private $searchParameter;

    public function __construct(SkillService $skillService, DevelopProfileSearchParameterService $searchParameter)
    {
        $this->skillService = $skillService;

        $this->searchParameter = $searchParameter;
    }

    public function parse(ParameterBag $parameters)
    {
        $skillAliases = $parameters->get(self::SKILL);

        $emptySkillBitSet = $this->searchParameter->getEmptySkillBitSet('*');

        if ($skillAliases) {
            $skillAliasList = explode(',', $skillAliases);
            $skillIdList = $this->skillService->getIdList($skillAliasList);

            foreach ($skillIdList as $skillId) {
                $emptySkillBitSet[$skillId] = '1';
            }
        }

        return new DevelopProfileParameter($emptySkillBitSet);
    }
}
