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

  function insert(string $prenom, $pseudo, string $nom, string $email, string $telephone, string $password)
  {
    $stmt = $this->dbAdapter->prepare(
      'INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES (:nom, :pseudo, :prenom, :email, :telephone, :password)'
    );
    $stmt->bindValue(':nom', $nom, \PDO::PARAM_STR);
    $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
    $stmt->bindValue(':prenom', $prenom, \PDO::PARAM_STR);
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
  
  public function findAll()
  {
    $stmt = $this->dbAdapter->prepare(
      'SELECT * FROM "utilisateur" ORDER BY id DESC'
    );
    $stmt->execute();
    $users = null;
    $i = 0;
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $users[$i] = $row ? $this->userHydrator->hydrate($row) : null;
      $i++;
    }
    return $users;
  }
  
    public function getIdentity($userId)
    {
      $stmt = $this->dbAdapter->prepare(
        'SELECT prenom, pseudo, nom FROM "utilisateur" WHERE id = :id'
      );
      $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
      $stmt->execute();
      $rawUser = $stmt->fetch();
      return $rawUser ? $rawUser : null;
    }
  
  public function changePassword($userId, $password)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "utilisateur" SET password=:password WHERE id = :id'
    );
    $stmt->bindValue(':password', $password, \PDO::PARAM_STR);
    $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
    $stmt->execute();
  }



  public function changeFirstName($userId, $prenom)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "utilisateur" SET prenom=:prenom WHERE id = :id'
    );
    $stmt->bindValue(':prenom', $prenom, \PDO::PARAM_STR);
    $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function changeNickName($userId, $pseudo)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "utilisateur" SET pseudo=:pseudo WHERE id = :id'
    );
    $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
    $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function changeNickNameByEmail($email, $pseudo)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "utilisateur" SET pseudo=:pseudo WHERE email = :email'
    );
    $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function changeLastName($userId, $nom)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "utilisateur" SET nom=:nom WHERE id = :id'
    );
    $stmt->bindValue(':nom', $nom, \PDO::PARAM_STR);
    $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function changeEMail($userId, $email)
  {
    $stmt = $this->dbAdapter->prepare(
      'UPDATE "utilisateur" SET email=:email WHERE id = :id'
    );
    $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
    $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
    $stmt->execute();
  }

  public function deleteUser($userId)
  {
    $stmt = $this->dbAdapter->prepare(
      'DELETE FROM "utilisateur" WHERE id = :id'
    );
    $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
    $stmt->execute();
  }
}
