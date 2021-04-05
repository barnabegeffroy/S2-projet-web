<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$userService = new \Rediite\Model\Service\UserService($userRepository);

$last_password =  $_POST['last_password'];
$password =  password_hash($_POST['password'], PASSWORD_BCRYPT);

$viewData = [];
$user = $userRepository->findOneById($_SESSION['user_id']);
if (!password_verify($last_password, $user->getPassword())) {
    $viewData['failedAuthent'] = 'Mot de passe incorrect';
    loadView('password', $viewData);
    exit;
} else {
    $userRepository->changePassword($user->getId(), $password);
    header('Location: account.php');
}
