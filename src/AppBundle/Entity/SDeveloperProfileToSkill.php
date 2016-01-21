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
    private $position;

    /**
     * @var integer
     */
    private $score;

    /**
     * @var \AppBundle\Entity\SDeveloperProfile
     */
    private $developerProfile;

    /**
     * @var \AppBundle\Entity\SSKill
     */
    private $skill;


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
     * Set position
     *
     * @param integer $position
     *
     * @return SDeveloperProfileToSkill
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
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

    /**
     * Set skill
     *
     * @param \AppBundle\Entity\SSKill $skill
     *
     * @return SDeveloperProfileToSkill
     */
    public function setSkill(\AppBundle\Entity\SSKill $skill = null)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return \AppBundle\Entity\SSKill
     */
    public function getSkill()
    {
        return $this->skill;
    }
}

