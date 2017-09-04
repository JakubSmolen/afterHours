<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityList
 *
 * @ORM\Table(name="activity_list")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActivityListRepository")
 */
class ActivityList
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="placeMeeting", type="text", length=300, nullable=true)
     */
    private $placeMeeting;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     * Set placeMeeting
     *
     * @param string $placeMeeting
     * @return ActivityList
     */
    public function setPlaceMeeting($placeMeeting)
    {
        $this->placeMeeting = $placeMeeting;

        return $this;
    }

    /**
     * Get placeMeeting
     *
     * @return string 
     */
    public function getPlaceMeeting()
    {
        return $this->placeMeeting;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return ActivityList
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ActivityList
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
}
