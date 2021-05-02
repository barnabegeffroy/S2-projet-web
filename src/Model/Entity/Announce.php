<?php

namespace Rediite\Model\Entity;

class Announce
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $datePublication;

    /**
     * @var string
     */
    private $duree;

    /**
     * @var string
     */
    private $description;

    /**
     * @var boolean
     */
    private $photo;

    /**
     * @var string
     */
    private $lieu;
    
    /**
     * @var float
     */
    private $lat;
    
    /**
     * @var float
     */
    private $lng;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Announce
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     * @return Announce
     */
    public function setTitle($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return Announce
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->datePublication;
    }

    /**
     * @param mixed $date
     * @return Announce
     */
    public function setDate($date)
    {
        $this->datePublication = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     * @return Announce
     */
    public function setDuration($duree)
    {
        $this->duree = $duree;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Announce
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoto(): bool
    {
        return $this->photo;
    }

    /**
     * @param boolean $photo
     * @return Announce
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $place
     * @return Announce
     */
    public function setPlace($place)
    {
        $this->lieu = $place;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     * @return Announce
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param mixed $lng
     * @return Announce
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
        return $this;
    }
}
