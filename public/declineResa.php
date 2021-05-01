<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$messageHydrator = new \Rediite\Model\Hydrator\MessageHydrator();
$chatRepository = new \Rediite\Model\Repository\ChatRepository($dbAdapter, $messageHydrator);


$ref_conv = $_POST['ref_conv'];
$idMessage = $_POST['idMessage'];
$description = 'Demande refusée : ' . $_POST['message'];

$chatRepository->updateResa($idMessage, false);
$chatRepository->updateDescription($idMessage, $description);
header('Location: salon.php?idConv=' . $ref_conv);
exit;
