<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$userService = new \Rediite\Model\Service\UserService($userRepository);
$authenticatorService = new \Rediite\Model\Service\AuthenticatorService($userRepository);

$last_password =  $_POST['last_password'];
$password =  password_hash($_POST['password'], PASSWORD_BCRYPT);

$viewData = [];
$user = $authenticatorService->getCurrentUser();
if (!password_verify($last_password, $user->getPassword())) {
    $viewData['failedPassword'] = 'Mot de passe incorrect';
    loadView('account/password', $viewData);
} else {
    $userRepository->changePassword($user->getId(), $password);
    header('Location: account.php');
    exit;
}
