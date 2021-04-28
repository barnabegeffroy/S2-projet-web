<?php

namespace Rediite\Model\Hydrator;

use \Rediite\Model\Entity\Utilisateur as UserEntity;

class UserHydrator
{
  public function hydrate($data): UserEntity
  {
    $topic = new UserEntity();
    $topic->setId($data['id'])
      ->setLastName($data['nom'])
      ->setFirstName($data['prenom'])
      ->setEMail($data['email'])
      ->setPhoneNumber($data['telephone'])
      ->setPassword($data['password']);
    if (!empty($data['pseudo'])) {
      $topic->setNickName($data['pseudo']);
    }
    return $topic;
  }
}
