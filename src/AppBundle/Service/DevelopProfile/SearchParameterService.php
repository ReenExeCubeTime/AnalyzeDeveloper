<?php

namespace AppBundle\Service\DevelopProfile;

use AppBundle\Entity\SDeveloperProfileSearchParameter;

class SearchParameterService
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
