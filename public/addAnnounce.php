<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);

$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);

$titre = !empty($_POST['titre']) ? $_POST['titre'] : null;
$date = date('d/m/Y');
$viewData = [];

if (null !== $titre &&  null !== $date) {
  $announceRepository->insert($titre, $_SESSION['user_id'], $date);
  header('Location: login.php');
}
$viewData['errorInCreation'] = "Impossible de créer l'announce";
loadView('signup', $viewData);
