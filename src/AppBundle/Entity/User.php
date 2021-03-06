<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser{

    /**
     * @ORM\ManyToMany(targetEntity="ActivityList", inversedBy="user")
     * @ORM\JoinTable(name="users_activity")
     */
    private $activity;



    public function __construct() {
        parent::__construct();
        $this->activity = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * Add activity
     *
     * @param \AppBundle\Entity\ActivityList $activity
     * @return User
     */
    public function addActivity(\AppBundle\Entity\ActivityList $activity)
    {
        $this->activity[] = $activity;

        return $this;
    }

    /**
     * Remove activity
     *
     * @param \AppBundle\Entity\ActivityList $activity
     */
    public function removeActivity(\AppBundle\Entity\ActivityList $activity)
    {
        $this->activity->removeElement($activity);
    }

    /**
     * Get activity
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivity()
    {
        return $this->activity;
    }
}
