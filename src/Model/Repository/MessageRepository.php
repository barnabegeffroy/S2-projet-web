<?php

namespace Rediite\Model\Repository;
use \Rediite\Model\Entity\Message as MessageEntity;

class MessageRepository
{
    /**
     * @var \PDO
     */
    private $dbAdapter;

    public function __construct(\PDO $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function fetchAll()
    {
        $MessagesData = $this->dbAdapter->query('SELECT * FROM "Message"');
        $Messages = [];
        foreach ($MessagesData as $MessagesDatum) {
            $Message = new Message();
            $Message
                ->setMessageId($MessagesDatum['id'])
                ->setDescription($MessagesDatum['description'])
                ->setIdReceveur($MessagesDatum['idReceveur'])
                ->setDatePublication($MessagesDatum['datePublication'])
                ->setIdEmetteur($MessagesDatum['idEmetteur']);
            $Messages[] = $Message;
        }
        return $Messages;
    }

    //function insert(string $userName,string $createdAt,string $playersToFind,string $gameName,string $title)
    function insert(int $id, int $idEmetteur, int $idReceveur,string $datePublication, string $description)
    {
        $stmt = $this->dbAdapter->prepare(
            'INSERT INTO "Message" (id, idEmetteur, idReceveur, datePublication , description) VALUES (:id, :idEmetteur, :idReceveur, : datePublication, : description)'
          );
          $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
          $stmt->bindValue(':idEmetteur', $idEmetteur, \PDO::PARAM_STR);
          $stmt->bindValue(':idReceveur', $idReceveur, \PDO::PARAM_STR);
          $stmt->bindValue(':datePublication', $datePublication, \PDO::PARAM_STR);
          $stmt->bindValue(':description', $description, \PDO::PARAM_STR);
          $stmt->execute();
    }

    public function delete ($MessageId)
    {
        $stmt = $this
            ->dbAdapter
            ->prepare('DELETE FROM "Message" where id = :id');

        $stmt->bindParam('id', $id);
        $stmt->execute();

    }

    public function viewMessage(int $id)
    {
        $stmt = $this
            ->dbAdapter
            ->prepare('SELECT description,idEmetteur FROM "Message" where id = :id');

        $stmt->bindParam('id', $id);
        $stmt->execute();
        foreach ($stmt as $MessagesDatum) {
            $Message = new Message();
                $Message
                    ->setidEmetteur($MessagesDatum['idEmetteur'])
                    ->setDescription($MessagesDatum['description']);
                $Messages[] = $Message;
            }
        if(empty($Messages))
        {
            return "";
        }
        return $Messages;
    }

}