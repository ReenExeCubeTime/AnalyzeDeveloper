<?php

namespace AppBundle\Common;

interface ExistIdListInterface
{
    /**
     * @param array $idList
     * @return array
     */
    public function existIdList(array $idList);
}
