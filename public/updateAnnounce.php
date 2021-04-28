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
$adresse = !empty($_POST['adresse']) ? $journalName = preg_replace('/\s+/', '_', $_POST['adresse']) : null;
$coordonnees = !empty($_POST['coordonnees']) ? $journalName = $_POST['coordonnees'] : null;
$image = isset($_FILES['image']) ? (is_uploaded_file($_FILES['image']['tmp_name']) ? $_FILES['image'] : null) : null;
$id = $_POST['idAnnounce'];
$viewData = [];
$announce = $announceRepository->findOneById($id);

if ($titre !== $announce->getTitle()) {
  $announceRepository->changeTitle($id, $titre);
}

if ($description !== $announce->getDescription()) {
  $announceRepository->changeDescription($id, $description);
}

if ($duree !== $announce->getDuration()) {
  $announceRepository->changeDuration($id, $duree);
}

$viewData = upload_image($announceRepository, $viewData, $image, $id);

if (empty($viewData['errorInCreation'])) {
  header('Location: myAnnounces.php');
  exit;
}
loadView('announce/myAnnounces', $viewData);
