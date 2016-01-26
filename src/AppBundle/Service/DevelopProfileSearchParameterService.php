<?php

namespace AppBundle\Service;

use AppBundle\Entity\SDeveloperProfileSearchParameter;

class DevelopProfileSearchParameterService
{
    public function getEmptySkillBitSet($char = '0')
    {
        return str_repeat($char, SDeveloperProfileSearchParameter::SKILL_BIT_SET_SIZE);
    }
}
