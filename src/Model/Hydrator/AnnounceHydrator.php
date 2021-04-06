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
      ->setUserId($data['idUtilisateur'])
      ->setDate($data['datePublication'])
      ->setIsAvailable($data['estDisponible']);
    if (!empty($data['duree'])) {
      $topic->setDuration($data['duree']);
    }
    if (!empty($data['description'])) {
      $topic->setDescription($data['description']);
    }
    if (!empty($data['lieu'])) {
      $topic->setPlace($data['lieu']);
    }
    return $topic;
  }
}