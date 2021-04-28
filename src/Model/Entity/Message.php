<?php

namespace Rediite\Model\Entity;

class Message
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idEmetteur;

    /**
     * @var int
     */
    private $idReceveur;

    /**
     * @var string
     */
    private $datePublication;

    /**
     * @var string
     */
    private $description;


    /**
     * @return mixed
     */
    public function getMessageId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Utilisateur
     */
    public function setMessageId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getIdReceveur()
    {
        return $this->idReceveur;
    }
    /**
     * @param mixed $id
     * @return Message
     */
    public function setIdReceveur($id)
    {
        $this->idReceveur = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdEmetteur()
    {
        return $this->idEmetteur;
    }
    /**
     * @param mixed $id
     * @return Message
     */
    public function setIdEmetteur($id)
    {
        $this->idEmetteur = $id;
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
     * @return Message
     */
    public function setDatePublication($date)
    {
        $this->datePublication = $date;
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
     * @param mixed $contenu
     * @return Message
     */
    public function setDescription($contenu)
    {
        $this->description = $contenu;
        return $this;
    }
}