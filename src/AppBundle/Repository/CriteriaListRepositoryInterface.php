<?php

namespace AppBundle\Repository;

interface CriteriaListRepositoryInterface
{
    /**
     * @param array $idList
     * @return array
     */
    public function getCriteriaList(array $idList);
}
