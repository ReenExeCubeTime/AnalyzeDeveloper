<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\SDeveloperProfileSearchParameter;
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

        $emptyBitSetPattern = str_repeat('*', SDeveloperProfileSearchParameter::SKILL_BIT_SET_SIZE);

        $this->assertSame($developProfileParameter->getSkillBitSetPattern(), $emptyBitSetPattern);
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
