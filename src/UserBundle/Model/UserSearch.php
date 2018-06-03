<?php

namespace UserBundle\Model;

/**
 * Description of UserSearch
 *
 * @author omar
 */
class UserSearch
{

    // begin of creation range
    protected $createdFrom;
    // end of creation range
    protected $createdTo;
    // enabled or not
    protected $isEnabled;
    // username
    protected $username;

    public function __construct()
    {
        // initialise the createdFrom to "one month ago", and the createdTo to "today"
        $date = new \DateTime();
        $month = new \DateInterval('P1Y');
        $date->sub($month);
        $date->setTime('00', '00', '00');

        $this->createdFrom = $date;
        $this->createdTo = new \DateTime();
        $this->createdTo->setTime('23', '59', '59');
    }

    public function setCreatedFrom($createdFrom)
    {
        if ($createdFrom != "") {
            $createdFrom->setTime('00', '00', '00');
            $this->createdFrom = $createdFrom;
        }

        return $this;
    }

    public function getCreatedFrom()
    {
        return $this->createdFrom;
    }

    public function setCreatedTo($createdTo)
    {
        if ($createdTo != "") {
            $createdTo->setTime('23', '59', '59');
            $this->createdTo = $createdTo;
        }

        return $this;
    }

    public function getCreatedTo()
    {
        return $this->createdTo;
    }

    public function clearDates()
    {
        $this->createdTo = null;
        $this->createdFrom = null;
    }

    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
}
