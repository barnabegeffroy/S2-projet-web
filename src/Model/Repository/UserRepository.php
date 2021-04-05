<?php

namespace Rediite\Model\Repository;

use \Rediite\Model\Entity\Utilisateur as UserEntity;
use \Rediite\Model\Hydrator\UserHydrator;

class UserRepository
{

  /**
   * @var \PDO
   */
  private $dbAdapter;

  /**
   * @var UserHydrator
   */
  private $userHydrator;


  public function __construct(
    \PDO $dbAdapter,
    UserHydrator $userHydrator

  ) {
    $this->dbAdapter = $dbAdapter;
    $this->userHydrator = $userHydrator;
  }

  function insert(string $prenom, string $nom, string $email, string $telephone, string $password)
  {
    $stmt = $this->dbAdapter->prepare(
      'INSERT INTO "utilisateur" (nom, prenom, email, telephone, password) VALUES (:nom, :prenom, :email, :telephone, :password)'
    );
    $stmt->bindValue(':prenom', $prenom, \PDO::PARAM_STR);
    $stmt->bindValue(':nom', $nom, \PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
    $stmt->bindValue(':telephone', $telephone, \PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, \PDO::PARAM_STR);
    $stmt->execute();
  }

  function findOneByEmail($email): ?UserEntity
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM "utilisateur" WHERE email = :email'
    );
    $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
    $stmt->execute();
    $rawUser = $stmt->fetch();
    return $rawUser ? $this->userHydrator->hydrate($rawUser) : null;
  }

  public function findOneById($userId)
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM "utilisateur" WHERE id = :id'
    );
    $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
    $stmt->execute();
    $rawUser = $stmt->fetch();
    return $rawUser ? $this->userHydrator->hydrate($rawUser) : null;
  }


  
}
