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
        $developProfileParameter = $this->parse([]);

        $bitSetPattern = $this->container->get('rqs.developer_profile')->getEmptySkillBitSet('*');

        $this->assertSame($developProfileParameter->getSkillBitSetPattern(), $bitSetPattern);

        $developProfileParameter = $this->parse([
            DeveloperSearchParameterParser::SKILL => 'PHP'
        ]);

        $bitSetPattern = $this->container->get('rqs.developer_profile')->getEmptySkillBitSet('*');

        $bitSetPattern[1] = '1';

        $this->assertSame($developProfileParameter->getSkillBitSetPattern(), $bitSetPattern);
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
