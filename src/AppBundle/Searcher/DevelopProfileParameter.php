<?php

namespace AppBundle\Searcher;

class DevelopProfileParameter
{
    /**
     * @var string
     */
    private $skillBitSetPattern;

    /**
     * @var array
     */
    private $cityIdList;

    public function __construct($skillBitSetPattern, array $cityIdList)
    {
        $this->skillBitSetPattern = $skillBitSetPattern;
        $this->cityIdList = $cityIdList;
    }

    public function getSkillBitSetPattern()
    {
        return $this->skillBitSetPattern;
    }

    public function getCityIdList()
    {
        return $this->cityIdList;
    }
}
