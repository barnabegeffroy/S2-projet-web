<?php

namespace Rediite\Model\Hydrator;

use \Rediite\Model\Entity\Announce as AnnounceEntity;

class AnnounceHydrator
{
  public function hydrate($data): AnnounceEntity
  {
    $topic = new AnnounceEntity();
    $topic->setId($data['id'])
      ->setTitle($data['titre'])
      ->setUserId($data['idutilisateur'])
      ->setDate($data['datepublication'])
      ->setIsAvailable($data['estdisponible'])
      ->setDuration($data['duree'])
      ->setDescription($data['description'])
      ->setPhoto($data['photo'])
      ->setPlace($data['lieu']);
    return $topic;
  }
}