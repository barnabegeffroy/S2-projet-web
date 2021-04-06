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
      VALUES (:nom, :idUser, :datePublication, TRUE);
      SELECT * FROM annonce WHERE idutilisateur = :idUser ORDER BY ID DESC LIMIT 1 ;'
    );
    $stmt->bindValue(':titre', $titre, \PDO::PARAM_STR);
    $stmt->bindValue(':idUser', $idUser, \PDO::PARAM_INT);
    $stmt->bindValue(':datePublication', $datePublication, \PDO::PARAM_STR);
    $stmt->execute();
    $id = $stmt->fetch();
    return $id ? $id : null;
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
      'SELECT * FROM "annonce" WHERE idutilisateur = :idutilisateur'
    );
    $stmt->bindValue(':idutilisateur', $userId, \PDO::PARAM_INT);
    $stmt->execute();
    $announces = null;
    $i = 0;
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $announces[$i] = $row ? $this->announceHydrator->hydrate($row) : null;
      $i++;
    }
    return $announces;
  }

  public function findAll()
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM "annonce"'
    );
    $stmt->execute();
    $announces = null;
    $i = 0;
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $announces[$i] = $row ? $this->announceHydrator->hydrate($row) : null;
      $i++;
    }
    return $announces;
  }

  public function deleteAnnounce($id)
  {
    $stmt = $this->dbAdapter->prepare(
      'DELETE FROM "annonce" WHERE id = :id'
    );
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function changeTitle($id, $title)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "annonce" SET titre=:titre WHERE id = :id'
    );
    $stmt->bindValue(':titre', $title, \PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function changeDescription($id, $description)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "annonce" SET description=:description WHERE id = :id'
    );
    $stmt->bindValue(':description', $description, \PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function changeDuration($id, $duree)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "annonce" SET duree=:duree WHERE id = :id'
    );
    $stmt->bindValue(':duree', $duree, \PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function changePlace($id, $place)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "annonce" SET lieu=:lieu WHERE id = :id'
    );
    $stmt->bindValue(':lieu', $place, \PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }
}
