<?php

namespace Rediite\Model\Service;

use \Rediite\Model\Repository\AnnounceRepository;

class AnnounceService
{

  /**
   * @var AnnounceRepository
   */
  private $announceRepository;

  public function __construct(AnnounceRepository $announceRepository)
  {
    $this->announceRepository = $announceRepository;
  }

  public function doesAnnounceExist($id): bool
  {
    $announce = $this->announceRepository->findOneById($id);
    return null !== $announce;
  }
}
