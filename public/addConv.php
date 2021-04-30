<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$messageHydrator = new \Rediite\Model\Hydrator\MessageHydrator();
$chatRepository = new \Rediite\Model\Repository\ChatRepository($dbAdapter, $messageHydrator);


$idAuteur = $_POST['id'];
$idAnnounce = $_POST['idAnnounce'];
$idAutre = $_POST['idOther'];
$date = date('Y-m-d');
$description = $_POST['message'];

$chatRepository->createConv($idAnnounce, $idAutre, $idAuteur);
echo $idAnnounce;
echo $idAutre;
echo $idAuteur;
echo $_SESSION['user_id'];
// $ref_conv = $chatRepository->getLastConvCreated($idAnnounce, $idAutre, $idAuteur);
// $chatRepository->insertMessage($ref_conv, $idAuteur, $date, $description);
// header('Location: php.php?idConv=' . $ref_conv);
// exit;
