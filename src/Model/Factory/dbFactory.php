<?php

namespace Rediite\Model\Factory;

class dbFactory
{

  function createService()
  {
    return new \PDO('pgsql:dbname=ipw_astro_g29;host=pgsql2;port=5432"', 'tpcurseurs', 'tpcurseurs');
  }
}
