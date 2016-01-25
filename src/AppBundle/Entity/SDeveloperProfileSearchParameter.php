<?php

namespace AppBundle\Entity;

/**
 * SDeveloperProfileSearchParameter
 */
class SDeveloperProfileSearchParameter
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $skillBitSet;

    /**
     * @var \AppBundle\Entity\SDeveloper
     */
    private $developerProfile;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set skillBitSet
     *
     * @param string $skillBitSet
     *
     * @return SDeveloperProfileSearchParameter
     */
    public function setSkillBitSet($skillBitSet)
    {
        $this->skillBitSet = $skillBitSet;

        return $this;
    }

    /**
     * Get skillBitSet
     *
     * @return string
     */
    public function getSkillBitSet()
    {
        return $this->skillBitSet;
    }

    /**
     * Set developerProfile
     *
     * @param \AppBundle\Entity\SDeveloper $developerProfile
     *
     * @return SDeveloperProfileSearchParameter
     */
    public function setDeveloperProfile(\AppBundle\Entity\SDeveloper $developerProfile = null)
    {
        $this->developerProfile = $developerProfile;

        return $this;
    }

    /**
     * Get developerProfile
     *
     * @return \AppBundle\Entity\SDeveloper
     */
    public function getDeveloperProfile()
    {
        return $this->developerProfile;
    }
}
