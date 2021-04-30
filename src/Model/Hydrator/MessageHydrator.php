<?php

namespace Rediite\Model\Hydrator;

use \Rediite\Model\Entity\Message as MessageEntity;

class MessageHydrator
{
  public function hydrate($data): MessageEntity
  {
    $message = new MessageEntity();
    $message
        ->setMessageId($data['mes_id'])
        ->setIdAuteur($data['idauteur'])
        ->setDescription($data['description'])
        ->setDatePublication($data['datepublication'])
        ->setRefConv($data['ref_conv']);
    return $message;
  }
}
