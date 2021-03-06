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
if (null !== $user) {
    if (password_verify($password, $user->getPassword())) {
        $_SESSION['user_id'] = $user->getId();
        header('Location: index.php');
        exit;
    } else {
        $viewData['failedAuthent'] = 'Mot de passe incorrect';
        loadView('connexion/login', $viewData);
    }
}
$viewData['failedAuthent'] = 'Utilisateur introuvable';
loadView('connexion/login', $viewData);
