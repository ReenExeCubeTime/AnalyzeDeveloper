<?php

namespace AppBundle\Service;

use AppBundle\Service\DevelopProfile\CriteriaProviderInterface;

class DeveloperSearchParameterService
{
    /**
     * @var CriteriaProviderInterface
     */
    private $criteriaProvider;

    public function __construct($criteriaProvider)
    {
        $this->criteriaProvider = $criteriaProvider;
    }

    public function getFilter()
    {
        $result = [];

        if ($skills = $this->criteriaProvider->getSkillList()) {
            $result[DeveloperSearchParameterParser::SKILL_NAME] = [
                'param' => DeveloperSearchParameterParser::SKILL,
                'name' => DeveloperSearchParameterParser::SKILL_NAME,
                'list' => $skills,
            ];
        }

        if ($cities = $this->criteriaProvider->getCityList()) {
            $result[DeveloperSearchParameterParser::CITY_NAME] = [
                'param' => DeveloperSearchParameterParser::CITY,
                'name' => DeveloperSearchParameterParser::CITY_NAME,
                'list' => $cities,
            ];
        }

        return $result;
    }
}
