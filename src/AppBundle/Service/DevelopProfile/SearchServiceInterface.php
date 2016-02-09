<?php

namespace AppBundle\Service\DevelopProfile;

use AppBundle\Entity\SDeveloperProfile;
use AppBundle\Searcher\DevelopProfileParameter;

interface SearchServiceInterface
{
    /**
     * @param DevelopProfileParameter $developProfileParameter
     * @param $offset
     * @param $limit
     * @return SDeveloperProfile[]|array
     */
    public function search(DevelopProfileParameter $developProfileParameter, $offset, $limit);

    /**
     * @param DevelopProfileParameter $developProfileParameter
     * @return int
     */
    public function count(DevelopProfileParameter $developProfileParameter);
}
