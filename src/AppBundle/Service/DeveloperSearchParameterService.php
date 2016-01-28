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
        return [
            DeveloperSearchParameterParser::SKILL => $this->criteriaProvider->getSkillList()
        ];
    }
}
