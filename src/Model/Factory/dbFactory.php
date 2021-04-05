<?php

namespace Rediite\Model\Factory;

class dbFactory
{

  function createService()
  {
    return new \PDO('pgsql:dbname=projet_entraiide;host=pgsql2;port=5432"', 'tpcurseurs', 'tpcurseurs');
  }
}
