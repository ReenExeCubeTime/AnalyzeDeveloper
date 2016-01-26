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
     */
    public function testSkillBitSetPattern()
    {
        foreach ($this->skillBitSetDataProvider() as list($parameters, $expectBtSetPattern)) {
            $developProfileParameter = $this->parse($parameters);

            $this->assertSame($developProfileParameter->getSkillBitSetPattern(), $expectBtSetPattern);
        }
    }

    public function skillBitSetDataProvider()
    {
        $service = $this->container->get('rqs.developer.profile.search.parameter');

        yield [
            [],
            $service->getSkillBitSet('*')
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => 'PHP'
            ],
            $service->getSkillBitSet('*', [1])
        ];

        yield [
            [
                DeveloperSearchParameterParser::SKILL => 'PHP,TDD'
            ],
            $service->getSkillBitSet('*', [1, 5])
        ];
    }

    private function createParameterList()
    {
        $this->container->get('rqs.database.tester')->clear();

        $allSkills = [
            'PHP',
            'Redis',
            'SQL',
            'JavaScript',
            'TDD',
        ];

        $this->container->get('rqs.skill')->create(...$allSkills);
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
