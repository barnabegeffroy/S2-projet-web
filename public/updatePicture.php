<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);

$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);

$id = $_POST['idAnnounce'];
$filename = $_POST['filename'];
$announceRepository->changePhoto($id, false);
unlink($filename);
$image = is_uploaded_file($_FILES['image']['tmp_name']) ? $_FILES['image'] : null;
$viewData = [];

$viewData = upload_image($announceRepository, $viewData, $image, $id);

if (empty($viewData['errorInCreation'])) {
    header('Location: myAnnounces.php');
    exit;
}
loadView('announce/newAnnounce', $viewData);
