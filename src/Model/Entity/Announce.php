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
    private $nom;

    /**
     * @var string
     */
    private $idUser;

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
     * @var string
     */
    private $lieu;
    

    /**
     * @var boolean
     */
    private $isAvailableNow;
    
    // /**
    //  * @var image
    //  */
    // private $profilePicture;
    

    /**
     * constructor
     * @param string $prenom
     * @param string $nom
     * @param string $email
     * @return void
     */
    public function __construct(int $id, string $nom, int $idUser , string $datePublication, string $duree, string $description, Localisation $lieu, bool $isAvailableNow)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->idUser = $idUser;
        $this->datePublication = $datePublication;
        $this->duree = $duree;
        $this->description = $description;
        $this->lieu = $lieu;
        $this->$isAvailableNow = $isAvailableNow;

    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->nom;
    }

    /**
     * @param mixed $lastName
     * @return Announce
     */
    public function setUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
    


    /**
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->$isAvailableNow;
    }

}
