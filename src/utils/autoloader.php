<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'http://pgsql.pedago.ensiie.fr/~barnabe.geffroy/projet-web/src/Model/Repository/UserRepository.php';
include_once 'http://pgsql.pedago.ensiie.fr/~barnabe.geffroy/projet-web/src/Model/Factory/dbFactory.php';
include_once 'http://pgsql.pedago.ensiie.fr/~barnabe.geffroy/projet-web/src/Model/Entity/User.php';
include_once 'http://pgsql.pedago.ensiie.fr/~barnabe.geffroy/projet-web/src/Model/Hydrator/UserHydrator.php';
include_once 'http://pgsql.pedago.ensiie.fr/~barnabe.geffroy/projet-web/src/Model/Service/UserService.php';
include_once 'http://pgsql.pedago.ensiie.fr/~barnabe.geffroy/projet-web/src/Model/Service/AuthenticatorService.php';
