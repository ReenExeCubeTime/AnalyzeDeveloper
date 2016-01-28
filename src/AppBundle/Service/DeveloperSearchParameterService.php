<?php

namespace AppBundle\Service;

class DeveloperSearchParameterService
{
    public function getFilter()
    {
        return [
            DeveloperSearchParameterParser::SKILL => [

            ]
        ];
    }
}
