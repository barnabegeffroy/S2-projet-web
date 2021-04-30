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

  function insert(string $titre, int $idUser, string $datePublication, $duree, $description, $place)
  {
    $stmt = $this->dbAdapter->prepare(
      'INSERT INTO "annonce" (titre, idUtilisateur, datePublication, duree, description, photo, lieu) 
      VALUES (:titre, :idUser, :datePublication, :duree, :description, FALSE, :lieu)'
    );
    $stmt->bindValue(':titre', $titre, \PDO::PARAM_STR);
    $stmt->bindValue(':idUser', $idUser, \PDO::PARAM_INT);
    $stmt->bindValue(':datePublication', $datePublication, \PDO::PARAM_STR);
    $stmt->bindValue(':duree', $duree, \PDO::PARAM_INT);
    $stmt->bindValue(':description', $description, \PDO::PARAM_STR);
    $stmt->bindValue(':lieu', $place, \PDO::PARAM_STR);
    $is_success = $stmt->execute();
    // Code à rajouter
    if (!$is_success) {
      // Ne pas garder ça en production car ça peut servir de faille de sécurité
      return "SQL Insert error: " . $stmt->errorInfo()[2];
    } else {
      return "Insert success";
    }
    // /* $id =  */$stmt->fetch();
    // return $id ? $id : null;
  }

  function getLastCreated(int $idUser)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT id FROM annonce WHERE idutilisateur = :idUser ORDER BY ID DESC LIMIT 1'
    );
    $stmt->bindValue(':idUser', $idUser, \PDO::PARAM_INT);
    $stmt->execute();
    $id = $stmt->fetch();
    return $id ? $id : null;
  }


  public function getDataById($announceId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM "annonce" WHERE id = :id'
    );
    $stmt->bindValue(':id', $announceId, \PDO::PARAM_INT);
    $stmt->execute();
    $rawAnnounce = $stmt->fetch();
    return $rawAnnounce ? $rawAnnounce : null;
  }

  public function getTitle($announceId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT titre FROM "annonce" WHERE id = :id'
    );
    $stmt->bindValue(':id', $announceId, \PDO::PARAM_INT);
    $stmt->execute();
    $rawAnnounce = $stmt->fetch();
    return $rawAnnounce ? $rawAnnounce['titre'] : null;
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
    $file = glob("../src/View/images/announces/" . $id . ".*");
    if (isset($file[0])) {
      unlink($file[0]);
    }
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
    $stmt->bindValue(':duree', $duree, \PDO::PARAM_INT);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function changePhoto($id, $bool)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "annonce" SET photo=:bool WHERE id = :id'
    );
    $stmt->bindValue(':bool', $bool, \PDO::PARAM_BOOL);
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

  public function addFav($idAnnounce, $userId)
  {
    $stmt = $this->dbAdapter->prepare(
      'INSERT INTO "favoris" (fav_idUtilisateur,fav_idAnnonce) VALUES (:idUser,:idAnnounce)'
    );
    $stmt->bindValue(':idUser', $userId, \PDO::PARAM_INT);
    $stmt->bindValue(':idAnnounce', $idAnnounce, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function deleteFav($idAnnounce, $userId)
  {
    $stmt = $this->dbAdapter->prepare(
      'DELETE FROM "favoris" WHERE fav_idUtilisateur = :idUser AND fav_idAnnonce = :idAnnounce'
    );
    $stmt->bindValue(':idUser', $userId, \PDO::PARAM_INT);
    $stmt->bindValue(':idAnnounce', $idAnnounce, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function findFav($idAnnounce, $userId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM "favoris" WHERE fav_idUtilisateur = :idUser AND fav_idAnnonce = :idAnnounce'
    );
    $stmt->bindValue(':idUser', $userId, \PDO::PARAM_INT);
    $stmt->bindValue(':idAnnounce', $idAnnounce, \PDO::PARAM_INT);
    $stmt->execute();
    $fav = $stmt->fetch();
    return $fav ? $fav : null;
  }

  public function findAllFavs($userId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM annonce A JOIN favoris F ON A.id = F.fav_idAnnonce WHERE F.fav_idUtilisateur=:idUser;'
    );
    $stmt->bindValue(':idUser', $userId, \PDO::PARAM_INT);
    $stmt->execute();
    $favs = null;
    $i = 0;
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $favs[$i] = $row ? $this->announceHydrator->hydrate($row) : null;
      $i++;
    }
    return $favs;
  }

  public function findReservationsByAnnounce($announceId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT dateDebut, dateFin FROM reservation WHERE res_idAnnonce=:idAnnounce;'
    );
    $stmt->bindValue(':idAnnounce', $announceId, \PDO::PARAM_INT);
    $stmt->execute();
    $resas = null;
    $i = 0;
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $resas[$i] = $row ? $row : null;
      $i++;
    }
    return $resas;
  }

  public function findReservationsByUser($userId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT res_idAnnonce, dateDebut, dateFin FROM reservation WHERE res_idUtilisateur=:userId;'
    );
    $stmt->bindValue(':userId', $userId, \PDO::PARAM_INT);
    $stmt->execute();
    $resas = null;
    $i = 0;
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $resas[$i] = $row ? $row : null;
      $i++;
    }
    return $resas;
  }

  public function findLoans($userId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM reservation R JOIN annonce A ON A.id = R.res_idAnnonce WHERE R.res_idUtilisateur=:idUser'
    );
    $stmt->bindValue(':idUser', $userId, \PDO::PARAM_INT);
    $stmt->execute();
    $resas = null;
    $i = 0;
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $resas[$i] = $row ? $row : null;
      $i++;
    }
    return $resas;
  }

  public function addReservation($announceId, $userId, $start, $end)
  {
    $stmt = $this->dbAdapter->prepare(
      'INSERT INTO "reservation" (res_idUtilisateur, res_idAnnonce, dateDebut, dateFin) VALUES (:idUser,:idAnnounce, :start, :end)'
    );
    $stmt->bindValue(':idUser', $userId, \PDO::PARAM_INT);
    $stmt->bindValue(':idAnnounce', $announceId, \PDO::PARAM_INT);
    $stmt->bindValue(':start', $start, \PDO::PARAM_STR);
    $stmt->bindValue(':end', $end, \PDO::PARAM_STR);
    $stmt->execute();
  }

  public function deleteResa($idAnnounce, $userId, $start)
  {
    $stmt = $this->dbAdapter->prepare(
      'DELETE FROM "reservation" WHERE res_idUtilisateur = :idUser AND res_idAnnonce = :idAnnounce AND dateDebut = :start'
    );
    $stmt->bindValue(':idUser', $userId, \PDO::PARAM_INT);
    $stmt->bindValue(':idAnnounce', $idAnnounce, \PDO::PARAM_INT);
    $stmt->bindValue(':start', $start, \PDO::PARAM_STR);
    $stmt->execute();
  }

  public function search($expression)
  {
    $stmt = $this->dbAdapter->prepare(
      "SELECT * FROM Annonce WHERE lower(CONCAT(titre,description)) LIKE lower(CONCAT('%','" . $expression . "','%')) ORDER BY id DESC"
    );
    $stmt->execute();

    $searchs = null;
    $i = 0;
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $searchs[$i] = $row ? $this->announceHydrator->hydrate($row) : null;
      $i++;
    }
    return $searchs;
  }
}
