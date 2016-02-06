<?php

namespace AppBundle\Service;

use AppBundle\Entity\SCity;
use AppBundle\Common\ExistIdListInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;

class CityService implements ExistIdListInterface
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function create(... $names)
    {
        foreach ($names as $name) {
            $city = new SCity();

            $city->setName($name);

            $this->doctrine->getManager()->persist($city);
        }

        $this->doctrine->getManager()->flush();
    }

    /**
     * @param $id
     * @return SCity
     */
    public function find($id)
    {
        return $this->doctrine->getRepository('AppBundle:SCity')->find($id);
    }

    /**
     * @param array $idList
     * @return array
     */
    public function existIdList(array $idList)
    {
        return $this->doctrine->getRepository('AppBundle:SCity')->existIdList($idList);
    }
}
