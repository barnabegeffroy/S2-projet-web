<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../src/Model/Repository/UserRepository.php';
include_once '../src/Model/Factory/dbFactory.php';
include_once '../src/Model/Entity/User.php';
include_once '../src/Model/Hydrator/UserHydrator.php';
