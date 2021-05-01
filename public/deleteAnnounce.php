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

$password = $_POST['password'];
$idAnnounce = $_POST['idAnnounce'];
$user = isset($_POST['idUser']) ? $userRepository->findOneById($_POST['idUser']) : $authenticatorService->getCurrentUser();

$viewData = [];
if (!password_verify($password, $user->getPassword())) {
    $viewData['failedPassword'] = 'Mot de passe incorrect';
    loadView('announce/myAnnounces', $viewData);
} else {
    $announceRepository->deleteAnnounce($idAnnounce);
    header('Location: myAnnounces.php');
    exit;
}
