<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\DeveloperSearchParameterParser;
use Symfony\Component\HttpFoundation\ParameterBag;

class DeveloperSearchParameterParserTest extends AbstractServiceTest
{
    protected function setUp()
    {
        parent::setUp();

        $this->createParameterList();
    }

    /**
     * @covers \AppBundle\Service\DeveloperSearchParameterParser::parse
     * @covers \AppBundle\Searcher\DevelopProfileParameter::getSkillBitSetPattern
     * @covers \AppBundle\Searcher\DevelopProfileParameter::getCityIdList
     */
    public function testSkillBitSetPattern()
    {
        foreach ($this->skillBitSetDataProvider() as list($parameters, list($bitSetPattern, $cityIdList))) {
            $parameter = $this->parse($parameters);

            $this->assertSame($parameter->getSkillBitSetPattern(), $bitSetPattern);
            $this->assertSame($parameter->getCityIdList(), $cityIdList);
        }
    }

    public function skillBitSetDataProvider()
    {
        $service = $this->container->get('rqs.developer.profile.search.parameter');

        yield [
            [],
            [
                false,
                [],
            ]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1'
            ],
            [
                $service->getSkillBitSet('_', [1]),
                [],
            ]
        ];

        yield [
            [
                DeveloperSearchParameterParser::CITY => '1',
            ],
            [
                false,
                [1],
            ]
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => '1,5',
                DeveloperSearchParameterParser::CITY => '1',
            ],
            [
                $service->getSkillBitSet('_', [1, 5]),
                [1],
            ]
        ];
    }

    private function createParameterList()
    {
        $this->container->get('rqs.database.tester')->clear();

        $skills = $this->getSkillList();
        $this->container->get('rqs.skill')->create(...$skills);

        $cities = $this->getCityList();
        $this->container->get('rqs.city')->create(...$cities);
    }

    /**
     * @param array $parameters
     * @return \AppBundle\Searcher\DevelopProfileParameter
     */
    private function parse(array $parameters)
    {
        return $this->getService()->parse(new ParameterBag($parameters));
    }

    private function getService()
    {
        return $this->container->get('rqs.developer.profile.parameter.parser');
    }
}
