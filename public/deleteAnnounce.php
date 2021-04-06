<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);

$password = $_POST['password'];
$idAnnounce = $_POST['idAnnounce'];

$viewData = [];
$user = $userRepository->findOneById($_SESSION['user_id']);
if (!password_verify($password, $user->getPassword())) {
    $viewData['failedPassword'] = 'Mot de passe incorrect';
    loadView('account', $viewData);
} else {
    $announceRepository->deleteAnnounce($idAnnounce);
    header('Location: myAnnounces.php');
    exit;
}
