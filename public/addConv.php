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
$description = isset($_POST['message']) ? $_POST['message'] : $_POST['dates'];
$demande = isset($_POST['demandeResa']);

$ref_conv = $chatRepository->getConv($idAnnounce, $idAutre, $idAuteur);

if (empty($ref_conv['id'])) {
    $chatRepository->createConv($idAnnounce, $idAutre, $idAuteur);
    $ref_conv = $chatRepository->getConv($idAnnounce, $idAutre, $idAuteur);
}
$ref_conv = $ref_conv['id'];
$chatRepository->insertMessage($ref_conv, $idAuteur, $date, $description, $demande);
header('Location: salon.php?idConv=' . $ref_conv);
exit;
