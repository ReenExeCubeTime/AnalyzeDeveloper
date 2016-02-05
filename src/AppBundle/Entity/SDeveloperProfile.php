<?php

namespace AppBundle\Entity;

/**
 * SDeveloperProfile
 */
class SDeveloperProfile
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var integer
     */
    private $salary;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \AppBundle\Entity\SDeveloperProfileSearchParameter
     */
    private $searchParameter;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $skills;

    /**
     * @var \AppBundle\Entity\SUser
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return SDeveloperProfile
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set salary
     *
     * @param integer $salary
     *
     * @return SDeveloperProfile
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return integer
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SDeveloperProfile
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set searchParameter
     *
     * @param \AppBundle\Entity\SDeveloperProfileSearchParameter $searchParameter
     *
     * @return SDeveloperProfile
     */
    public function setSearchParameter(\AppBundle\Entity\SDeveloperProfileSearchParameter $searchParameter = null)
    {
        $this->searchParameter = $searchParameter;

        return $this;
    }

    /**
     * Get searchParameter
     *
     * @return \AppBundle\Entity\SDeveloperProfileSearchParameter
     */
    public function getSearchParameter()
    {
        return $this->searchParameter;
    }

    /**
     * Add skill
     *
     * @param \AppBundle\Entity\SDeveloperProfileToSkill $skill
     *
     * @return SDeveloperProfile
     */
    public function addSkill(\AppBundle\Entity\SDeveloperProfileToSkill $skill)
    {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\SDeveloperProfileToSkill $skill
     */
    public function removeSkill(\AppBundle\Entity\SDeveloperProfileToSkill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\SUser $user
     *
     * @return SDeveloperProfile
     */
    public function setUser(\AppBundle\Entity\SUser $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\SUser
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \AppBundle\Entity\SCity
     */
    private $city;


    /**
     * Set city
     *
     * @param \AppBundle\Entity\SCity $city
     *
     * @return SDeveloperProfile
     */
    public function setCity(\AppBundle\Entity\SCity $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \AppBundle\Entity\SCity
     */
    public function getCity()
    {
        return $this->city;
    }
}
