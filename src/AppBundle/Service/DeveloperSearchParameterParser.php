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
     * @var CityService
     */
    private $cityService;

    /**
     * @var SearchParameterService
     */
    private $searchParameter;

    public function __construct(SearchParameterService $searchParameter, SkillService $skillService, CityService $cityService)
    {
        $this->searchParameter = $searchParameter;
        $this->skillService = $skillService;
        $this->cityService = $cityService;
    }

    public function parse(ParameterBag $parameters)
    {
        return new DevelopProfileParameter(
            $this->getSkillBitSet($this->getString($parameters, self::SKILL)),
            $this->getCityIdList($this->getString($parameters, self::CITY))
        );
    }

    private function getSkillBitSet($skills)
    {
        if (empty($skills)) {
            return false;
        }

        $skillIdList = $this->getIdList($skills);

        if (empty($skillIdList)) {
            return false;
        }

        $existSkillIdList = $this->skillService->existIdList($skillIdList);

        if (empty($existSkillIdList)) {
            return false;
        }

        $emptySkillBitSet = $this->searchParameter->getSkillBitSet('_');

        foreach ($existSkillIdList as $skillId) {
            $emptySkillBitSet[$skillId] = '1';
        }

        return $emptySkillBitSet;
    }

    private function getCityIdList($cities)
    {
        if (empty($cities)) {
            return [];
        }

        $cityIdList = $this->getIdList($cities);

        if (empty($cityIdList)) {
            return [];
        }

        return $this->cityService->existIdList($cityIdList);
    }

    private function getIdList($string)
    {
        $result = [];

        $array = explode(',', $string);

        foreach ($array as $item) {
            $id = (int)$item;

            if ($id > 0) {
                $result[] = $id;
            }
        }

        return array_unique($result);
    }

    private function getString(ParameterBag $parameters, $name)
    {
        $parameter = $parameters->get($name);

        return $parameter && is_string($parameter)
            ? $parameter
            : false;
    }
}
