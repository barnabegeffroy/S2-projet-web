<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$authenticatorService = new \Rediite\Model\Service\AuthenticatorService($userRepository);
$chatRepository = new \Rediite\Model\Repository\ChatRepository($dbAdapter);

$password = $_POST['password'];
$idConv = $_POST['idConv'];
$user = isset($_POST['idUser']) ? $userRepository->findOneById($_POST['idUser']) : $authenticatorService->getCurrentUser();

$viewData = [];
if (!password_verify($password, $authenticatorService->getCurrentUser()->getPassword())) {
    $viewData['failedPassword'] = 'Mot de passe incorrect';
    loadView('chat/chat', $viewData);
} else {
    $chatRepository->deleteConv($idConv);
    header('Location: chat.php');
    exit;
}
