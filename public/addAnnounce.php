<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$authenticatorService = new \Rediite\Model\Service\AuthenticatorService($userRepository);
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
$date = date('Y-m-d');
$image = is_uploaded_file($_FILES['image']['tmp_name']) ? $_FILES['image'] : null;
$viewData = [];
$userId = $authenticatorService->getCurrentUserId();

if (null !== $titre &&  null !== $date) {
  $viewData['errorInCreation'] = $announceRepository->insert($titre, $userId, $date, $duree, $description, $coordonnees);
  $id = $announceRepository->getLastCreated($userId)['id'];
  $viewData = upload_image($announceRepository, $viewData, $image, $id);
} else {
  $viewData['errorInCreation'] += "Impossible de créer l'annonce";
}
if (empty($viewData['errorInCreation'])) {
  header('Location: myAnnounces.php');
  exit;
}
loadView('announce/newAnnounce', $viewData);
