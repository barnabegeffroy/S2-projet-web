<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$authenticatorService = new \Rediite\Model\Service\AuthenticatorService($userRepository);

$password = $_POST['password'];

$viewData = [];
$user = isset($_POST['idUser']) ? $userRepository->findOneById($_POST['idUser']) : $authenticatorService->getCurrentUser();
if (!password_verify($password, $authenticatorService->getCurrentUser()->getPassword())) {
    $viewData['failedPassword'] = 'Mot de passe incorrect';
    loadView('account/account', $viewData);
} else {
    $userRepository->deleteUser($user->getId());
    header('Location: logout.php');
    exit;
}
