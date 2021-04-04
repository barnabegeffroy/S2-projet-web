<?php

// create the database connection
// $dbfactory = new \Rediite\Model\Factory\dbFactory();
// $dbAdapter = $dbfactory->createService();


include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';
loadView('home', []);
