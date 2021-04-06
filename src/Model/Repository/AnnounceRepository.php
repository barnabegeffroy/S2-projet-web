<?php

namespace Rediite\Model\Repository;

use \Rediite\Model\Entity\Announce as AnnounceEntity;
use \Rediite\Model\Hydrator\AnnounceHydrator;

class AnnounceRepository
{

  /**
   * @var \PDO
   */
  private $dbAdapter;

  /**
   * @var AnnounceHydrator
   */
  private $announceHydrator;


  public function __construct(
    \PDO $dbAdapter,
    AnnounceHydrator $announceHydrator

  ) {
    $this->dbAdapter = $dbAdapter;
    $this->announceHydrator = $announceHydrator;
  }

  function insert(string $titre, int $idUser, string $datePublication)
  {
    $stmt = $this->dbAdapter->prepare(
      'INSERT INTO "annonce" (titre, idUtilisateur, datePublication, estDisponible) 
      VALUES (:nom, :idUser, :datePublication, TRUE)'
    );
    $stmt->bindValue(':titre', $titre, \PDO::PARAM_STR);
    $stmt->bindValue(':idUser', $idUser, \PDO::PARAM_INT);
    $stmt->bindValue(':datePublication', $datePublication, \PDO::PARAM_STR);
    $stmt->execute();
  }

  public function findOneById($announceId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM "annonce" WHERE id = :id'
    );
    $stmt->bindValue(':id', $announceId, \PDO::PARAM_INT);
    $stmt->execute();
    $rawAnnounce = $stmt->fetch();
    return $rawAnnounce ? $this->announceHydrator->hydrate($rawAnnounce) : null;
  }

  public function findAllByUserId($userId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM "annonce" WHERE idUtilisateur = :idUtilisateur'
    );
    $stmt->bindValue(':idUtilisateur', $userId, \PDO::PARAM_INT);
    $stmt->execute();
    $rawAnnounce = $stmt->fetch();
    return $rawAnnounce ? $this->announceHydrator->hydrate($rawAnnounce) : null;
  }

  public function deleteAnnounce($id)
  {
    $stmt = $this->dbAdapter->prepare(
      'DELETE FROM "annonce" WHERE id = :id'
    );
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }
}
