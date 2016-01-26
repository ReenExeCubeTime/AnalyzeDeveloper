<?php

namespace AppBundle\Service;

use AppBundle\Entity\SDeveloperProfileSearchParameter;
use AppBundle\Searcher\DevelopProfileParameter;
use Symfony\Component\HttpFoundation\ParameterBag;
use Doctrine\Bundle\DoctrineBundle\Registry;

class DeveloperSearchParameterParser implements ParameterParser
{
    const SKILL = 's';

    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var DevelopProfileSearchParameterService
     */
    private $searchParameter;

    public function __construct(Registry $doctrine, DevelopProfileSearchParameterService $searchParameter)
    {
        $this->doctrine = $doctrine;

        $this->searchParameter = $searchParameter;
    }

    public function parse(ParameterBag $parameters)
    {
        $skillAliases = $parameters->get(self::SKILL);

        $emptySkillBitSet = $this->searchParameter->getEmptySkillBitSet('*');

        if ($skillAliases) {
            $emptySkillBitSet[1] = '1';
        }

        return new DevelopProfileParameter($emptySkillBitSet);
    }
}
