<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);

$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);

$announceId = $_POST['id'];
$userId = $_POST['userId'];
$start = $_POST['start'];

$announceRepository->deleteResa($announceId, $userId, $start);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
