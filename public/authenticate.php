<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$userService = new \Rediite\Model\Service\UserService($userRepository);

$email =  $_POST['email'];
$password =  $_POST['password'];

$viewData = [];
$user = $userRepository->findOneByEmail($email);
if (null !== $user && password_verify($password, $user->getPassword())) {
    $_SESSION['user_id'] = $user->getId();
    header('Location: index.php');
    exit;
}
$viewData['failedAuthent'] = 'L\'indentification a échoué';
loadView('login', $viewData);