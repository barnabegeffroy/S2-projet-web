<?php

namespace Rediite\Model\Factory;

class dbFactory
{

  function createService()
  {
    return new \PDO('pgsql:dbname=projet_web_grp35;host=pgsql2;port=5432"', 'administrateur', 'administrateur');
  }
}
