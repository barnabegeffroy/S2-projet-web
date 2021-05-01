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
    private $idAuteur;

    /**
     * @var int
     */
    private $refConv;

    /**
     * @var string
     */
    private $datePublication;

    /**
     * @var string
     */
    private $description;

    /**
     * @var boolean
     */
    private $demandeResa;


    /**
     * @return mixed
     */
    public function getMessageId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Message
     */
    public function setMessageId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getIdAuteur()
    {
        return $this->idAuteur;
    }
    /**
     * @param mixed $id
     * @return Message
     */
    public function setIdAuteur($id)
    {
        $this->idAuteur = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRefConv()
    {
        return $this->refConv;
    }
    /**
     * @param mixed $id
     * @return Message
     */
    public function setRefConv($id)
    {
        $this->refConv = $id;
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

    /**
     * @return bool
     */
    public function getDemandeResa()
    {
        return $this->demandeResa;
    }

    /**
     * @param mixed $demandeResa
     * @return Message
     */
    public function setDemandeResa($demandeResa)
    {
        $this->demandeResa = $demandeResa;
        return $this;
    }
}
