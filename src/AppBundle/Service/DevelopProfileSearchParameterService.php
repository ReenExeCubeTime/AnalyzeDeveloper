<?php

namespace AppBundle\Service;

use AppBundle\Entity\SDeveloperProfileSearchParameter;

class DevelopProfileSearchParameterService
{
    public function getSkillBitSet($char = '0', array $skillIdList = [])
    {
        $bitSet = str_repeat($char, SDeveloperProfileSearchParameter::SKILL_BIT_SET_SIZE);

        foreach ($skillIdList as $skillId) {
            $bitSet[$skillId] = '1';
        }

        return $bitSet;
    }
}
