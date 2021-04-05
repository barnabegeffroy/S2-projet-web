<?php

namespace Rediite\Model\Hydrator;

use \Rediite\Model\Entity\Utilisateur as UserEntity;

class UserHydrator
{
  public function hydrate($data): UserEntity
  {
    $topic = new UserEntity(
      $data['prenom'],
      $data['nom'],
      $data['email'],
      $data['telephone'],
      $data['password']
    );
    return $topic;
  }
}
