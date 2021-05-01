<?php

namespace Rediite\Model\Repository;

use \Rediite\Model\Entity\Message as MessageEntity;
use \Rediite\Model\Hydrator\MessageHydrator;

class ChatRepository
{
    /**
     * @var \PDO
     */
    private $dbAdapter;

    /**
     * @var MessageHydrator
     */
    private $messageHydrator;


    public function __construct(\PDO $dbAdapter, MessageHydrator $messageHydrator)
    {
        $this->dbAdapter = $dbAdapter;
        $this->messageHydrator = $messageHydrator;
    }

    public function findConvsByUserId($userId)
    {
        $stmt = $this->dbAdapter->prepare(
            'SELECT * FROM "conversation" WHERE id1 = :id OR id2 =:id'
        );
        $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $convs = null;
        $i = 0;
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $convs[$i] = $row ? $row : null;
            $i++;
        }
        return $convs;
    }

    public function getConvFromId($convId)
    {
        $stmt = $this->dbAdapter->prepare(
            'SELECT * FROM "conversation" WHERE id = :id'
        );
        $stmt->bindValue(':id', $convId, \PDO::PARAM_INT);
        $stmt->execute();
        $rawConv = $stmt->fetch();
        return $rawConv ? $rawConv : null;
    }

    public function getMessagesFromConvId($convId)
    {
        $stmt = $this->dbAdapter->prepare(
            'SELECT * FROM "message" WHERE ref_conv = :id'
        );
        $stmt->bindValue(':id', $convId, \PDO::PARAM_INT);
        $stmt->execute();
        $messages = null;
        $i = 0;
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $messages[$i] = $row ? $this->messageHydrator->hydrate($row) : null;
            $i++;
        }
        return $messages;
    }

    function createConv($idAnnonce, $id1, $id2)
    {
        $stmt = $this->dbAdapter->prepare(
            'INSERT INTO "conversation" (conv_idAnnonce, id1, id2) VALUES (:idAnnonce, :id1, :id2)'
        );
        $stmt->bindValue(':idAnnonce', $idAnnonce, \PDO::PARAM_INT);
        $stmt->bindValue(':id1', $id1, \PDO::PARAM_INT);
        $stmt->bindValue(':id2', $id2, \PDO::PARAM_INT);
        $stmt->execute();
    }

    function getConv($idAnnonce, $id1, $id2)
    {
        $stmt = $this->dbAdapter->prepare(
            'SELECT id FROM "conversation" WHERE conv_idannonce = :idAnnonce AND id1 = :id1 AND id2 = :id2 ORDER BY ID DESC LIMIT 1'
        );
        $stmt->bindValue(':idAnnonce', $idAnnonce, \PDO::PARAM_INT);
        $stmt->bindValue(':id1', $id1, \PDO::PARAM_INT);
        $stmt->bindValue(':id2', $id2, \PDO::PARAM_INT);
        $stmt->execute();
        $id = $stmt->fetch();
        return $id ? $id : null;
    }
    //function insert(string $userName,string $createdAt,string $playersToFind,string $gameName,string $title)
    function insertMessage(int $ref_conv, int $idAuteur, string $datePublication, string $description, bool $demande)
    {
        $stmt = $this->dbAdapter->prepare(
            'INSERT INTO "message" (ref_conv, idAuteur, datePublication , description, demandeResa) VALUES (:ref_conv, :idAuteur, :datePublication, :description, :demande)'
        );
        $stmt->bindValue(':ref_conv', $ref_conv, \PDO::PARAM_INT);
        $stmt->bindValue(':idAuteur', $idAuteur, \PDO::PARAM_INT);
        $stmt->bindValue(':datePublication', $datePublication, \PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, \PDO::PARAM_STR);
        $stmt->bindValue(':demande', $demande, \PDO::PARAM_BOOL);
        $stmt->execute();
    }

    function updateResa(int $messageId, bool $demande)
    {
        $stmt = $this->dbAdapter->prepare(
            'UPDATE "message" SET demandeResa=:demande WHERE id = :id'
        );
        $stmt->bindValue(':id', $messageId, \PDO::PARAM_INT);
        $stmt->bindValue(':demande', $demande, \PDO::PARAM_BOOL);
        $stmt->execute();
    }

    function updateDescription(int $messageId, string $description)
    {
        $stmt = $this->dbAdapter->prepare(
            'UPDATE "message" SET description=:description WHERE id = :id'
        );
        $stmt->bindValue(':id', $messageId, \PDO::PARAM_INT);
        $stmt->bindValue(':description', $description, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete($MessageId)
    {
        $stmt = $this
            ->dbAdapter
            ->prepare('DELETE FROM "Message" where id = :id');

        $stmt->bindParam('id', $id);
        $stmt->execute();
    }
}
