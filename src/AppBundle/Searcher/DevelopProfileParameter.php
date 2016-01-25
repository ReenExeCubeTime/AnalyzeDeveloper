<?php

namespace AppBundle\Searcher;

class DevelopProfileParameter
{
    private $skillBitSetPattern;

    public function __construct($skillBitSetPattern)
    {
        $this->skillBitSetPattern = $skillBitSetPattern;
    }

    public function getSkillBitSetPattern()
    {
        return $this->skillBitSetPattern;
    }
}
