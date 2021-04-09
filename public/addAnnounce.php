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
$lieu = !empty($_POST['lieu']) ? $_POST['lieu'] : null;
$date = date('d/m/Y');
$image = !empty($_FILES['image']) ? $_FILES['image'] : null;
$viewData = [];

if (null !== $titre &&  null !== $date) {
  $announceRepository->insert($titre, $_SESSION['user_id'], $date, $duree, $description, $lieu, !(empty($image) ? basename($image['name']) : null));
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
      $viewData['errorInCreation'] += 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
    }
    if ($taille > $taille_maxi) {
      $viewData['errorInCreation'] += 'Le fichier est trop gros...';
    }
    if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
      //On formate le nom du fichier ici...
      $fichier = strtr(
        $fichier,
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
      );
      $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
      if (move_uploaded_file($image['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
      {
        $viewData['errorInCreation'] = 'Upload effectué avec succès !';
      } else //Sinon (la fonction renvoie FALSE).
      {
        $viewData['errorInCreation'] = 'Echec de l\'upload !';
      }
    }
  }
}
else {
  $viewData['errorInCreation'] += "Impossible de créer l'annonce";
}
if (empty($viewData['errorInCreation'])){
  header('Location: myAnnounces.php');
  exit;
}
loadView('announce/newAnnounce', $viewData);
