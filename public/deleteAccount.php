<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$userService = new \Rediite\Model\Service\UserService($userRepository);

$password = $_POST['password'];

$viewData = [];
$user = $userRepository->findOneById($_SESSION['user_id']);
if (!password_verify($password, $user->getPassword())) {
    $viewData['failedPassword'] = 'Mot de passe incorrect';
    loadView('account', $viewData);
    exit;
} else {
    $userRepository->deleteUser($user->getId());
    header('Location: account.php');
}
