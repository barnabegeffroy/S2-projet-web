<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../src/Model/Repository/UserRepository.php';
include_once '../src/Model/Repository/AnnounceRepository.php';
include_once '../src/Model/Repository/ChatRepository.php';
include_once '../src/Model/Factory/dbFactory.php';
include_once '../src/Model/Entity/User.php';
include_once '../src/Model/Entity/Announce.php';
include_once '../src/Model/Entity/Message.php';
include_once '../src/Model/Hydrator/UserHydrator.php';
include_once '../src/Model/Hydrator/AnnounceHydrator.php';
include_once '../src/Model/Hydrator/MessageHydrator.php';
include_once '../src/Model/Service/UserService.php';
include_once '../src/Model/Service/AnnounceService.php';
include_once '../src/Model/Service/AuthenticatorService.php';
