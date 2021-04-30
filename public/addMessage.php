<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$messageHydrator = new \Rediite\Model\Hydrator\MessageHydrator();
$chatRepository = new \Rediite\Model\Repository\ChatRepository($dbAdapter, $messageHydrator);


$chatId = $_POST['id'];
$ref_conv = $_POST['ref_conv'];
$idAuteur = $_POST['idAuteur'];
$date = date('Y-m-d');
$description = $_POST['message'];

$chatRepository->insertMessage($ref_conv, $idAuteur, $date, $description);
header('Location: php.php?idConv=' . $ref_conv);
exit;
