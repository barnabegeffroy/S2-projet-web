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
$adresse = !empty($_POST['search_input']) ? $_POST['search_input'] : null;
$lat = !empty($_POST['lat']) ? $_POST['lat'] : null;
$lng = !empty($_POST['lng']) ? $_POST['lng'] : null;
$date = date('Y-m-d');
$image = is_uploaded_file($_FILES['image']['tmp_name']) ? $_FILES['image'] : null;
$viewData = [];
$userId = $authenticatorService->getCurrentUserId();

if (null !== $titre &&  null !== $date) {
  $announceRepository->insert($titre, $userId, $date, $duree, $description, $adresse, $lat, $lng);
  $id = $announceRepository->getLastCreated($userId)['id'];
  if ($image !== null) {
    $viewData = upload_image($announceRepository, $viewData, $image, $id);
  }
} else {
  $viewData['errorInCreation'] += "Impossible de créer l'annonce";
}
if (empty($viewData['errorInCreation'])) {
  header('Location: myAnnounces.php');
  exit;
}
loadView('announce/newAnnounce', $viewData);
