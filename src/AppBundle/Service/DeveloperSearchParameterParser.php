<?php

namespace AppBundle\Service;

use AppBundle\Searcher\DevelopProfileParameter;
use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearchParameterParser implements ParameterParserInterface
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
