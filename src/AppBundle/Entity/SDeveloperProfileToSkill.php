<?php

namespace AppBundle\Entity;

/**
 * SDeveloperProfileToSkill
 */
class SDeveloperProfileToSkill
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $index;

    /**
     * @var integer
     */
    private $score;

    /**
     * @var \AppBundle\Entity\SDeveloperProfile
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
     * Set index
     *
     * @param integer $index
     *
     * @return SDeveloperProfileToSkill
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * Get index
     *
     * @return integer
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return SDeveloperProfileToSkill
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set developerProfile
     *
     * @param \AppBundle\Entity\SDeveloperProfile $developerProfile
     *
     * @return SDeveloperProfileToSkill
     */
    public function setDeveloperProfile(\AppBundle\Entity\SDeveloperProfile $developerProfile = null)
    {
        $this->developerProfile = $developerProfile;

        return $this;
    }

    /**
     * Get developerProfile
     *
     * @return \AppBundle\Entity\SDeveloperProfile
     */
    public function getDeveloperProfile()
    {
        return $this->developerProfile;
    }
}

