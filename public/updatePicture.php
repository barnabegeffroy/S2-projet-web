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
        $id = $announceRepository->getDataById($_POST['id'])['id'];
        $fichier = $id . $extension;
        if (move_uploaded_file($image['tmp_name'], $dossier . $fichier)) {
            $announceRepository->changePhoto($id, true);
        } else {
            $viewData['errorInCreation'] = 'Echec de l\'upload !';
        }
    }
}

if (empty($viewData['errorInCreation'])) {
    header('Location: myAnnounces.php');
    exit;
}
loadView('announce/newAnnounce', $viewData);
