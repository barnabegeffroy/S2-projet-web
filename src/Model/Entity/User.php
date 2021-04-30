<?php

namespace Rediite\Model\Entity;

class Utilisateur
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $pseudo;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $adresse;

    /**
     * @var string
     */
    private $birthday;

    /**
     * @var string
     */
    private $telephone;

    /**
     * @var string
     */
    private $password;


    // /**
    //  * @var image
    //  */
    // private $profilePicture;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Utilisateur
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getNickName()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $lastName
     * @return Utilisateur
     */
    public function setNickName($nickName)
    {
        $this->pseudo = $nickName;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->nom;
    }

    /**
     * @param mixed $lastName
     * @return Utilisateur
     */
    public function setLastName($lastName)
    {
        $this->nom = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $firstName
     * @return Utilisateur
     */
    public function setFirstName($firstName)
    {
        $this->prenom = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEMail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Utilisateur
     */
    public function setEMail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdress()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     * @return Utilisateur
     */
    public function setAdress($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $phoneNumber
     * @return Utilisateur
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->telephone = $phoneNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     * @return Utilisateur
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}
