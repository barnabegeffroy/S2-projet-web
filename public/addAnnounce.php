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
$date = date('Y-m-d');
$image = is_uploaded_file($_FILES['image']['tmp_name']) ? $_FILES['image'] : null;
$viewData = [];

if (null !== $titre &&  null !== $date) {
  $viewData['errorInCreation'] = $announceRepository->insert($titre, $_SESSION['user_id'], $date, $duree, $description, $coordonnees);
  if ($image !== null) {
    $dossier = '../src/View/images/announces/';
    $fichier = basename($image['name']);
    $taille_maxi = 1000000;
    $taille = filesize($image['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($image['name'], '.');
    //Début des vérifications de sécurité...
    if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
      $viewData['errorInCreation'] = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg';
    } else if ($taille > $taille_maxi) {
      $viewData['errorInCreation'] = 'Le fichier est trop gros...';
    } else {
      $id = $announceRepository->getLastCreated($_SESSION['user_id'])['id'];
      $fichier = $id . $extension;
      if (move_uploaded_file($image['tmp_name'], $dossier . $fichier)) {
        $announceRepository->changePhoto($id, true);
      } else {
        $viewData['errorInCreation'] = 'Echec de l\'upload !';
      }
    }
  }
} else {
  $viewData['errorInCreation'] += "Impossible de créer l'annonce";
}
if (empty($viewData['errorInCreation'])) {
  header('Location: myAnnounces.php');
  exit;
}
loadView('announce/newAnnounce', $viewData);
