<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);

$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);

$titre = !empty($_POST['titre']) ? $_POST['titre'] : null;
$description = !empty($_POST['description']) ? $_POST['description'] : null;
$duree = !empty($_POST['duree']) ? $_POST['duree'] : null;
$cp = !empty($_POST['cp']) ? "postcode=" . $_POST['cp'] : null;
$ville = !empty($_POST['ville']) ?  preg_replace('/\s+/', '_', $_POST['ville']) : null;
$adresse = !empty($_POST['search_input']) ? $_POST['search_input'] : null;
$lat = !empty($_POST['lat']) ? $_POST['lat'] : null;
$lng = !empty($_POST['lng']) ? $_POST['lng'] : null;
$image = isset($_FILES['image']) ? (is_uploaded_file($_FILES['image']['tmp_name']) ? $_FILES['image'] : null) : null;
$id = $_POST['idAnnounce'];
$viewData = [];
$announce = $announceRepository->findOneById($id);

$isSet = !empty($_POST['isSet']) ? $_POST['isSet'] : null;

if ($titre !== $announce->getTitle()) {
  $announceRepository->changeTitle($id, $titre);
}

if ($description !== $announce->getDescription()) {
  $announceRepository->changeDescription($id, $description);
}

if ($duree !== $announce->getDuration()) {
  $announceRepository->changeDuration($id, $duree);
}

if (!empty($isSet)) {
  $file = glob("../src/View/images/announces/" . $id . ".*");
  unlink($file[0]);
  $announceRepository->changePhoto($id, false);
}

if (!empty($image)) {
  $viewData = upload_image($announceRepository, $viewData, $image, $id);
}

if (!empty($adresse) && !empty($lat) && !empty($lng)) {
  $announceRepository->changePlace($id, $adresse);
  $announceRepository->changeLat($id, $lat);
  $announceRepository->changeLng($id, $lng);
}

if (empty($viewData['errorInCreation'])) {
  header('Location: announce.php?id=' . $id);
  exit;
}
loadView('announce/myAnnounces', $viewData);
