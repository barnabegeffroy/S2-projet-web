<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$userService = new \Rediite\Model\Service\UserService($userRepository);
$authenticatorService = new \Rediite\Model\Service\AuthenticatorService($userRepository);

$prenom =  $_POST['prenom'];
$pseudo =  !empty($_POST['pseudo']) ? $_POST['pseudo'] : null;
$nom =  $_POST['nom'];
$email =  $_POST['email'];
$telephone =  $_POST['telephone'];

$viewData = [];
$id = $authenticatorService->getCurrentUserId();
$user = $userRepository->findOneById($id);

if ($email !== $user->getEMail()) {
    if ($userService->doesUserExist($email)) {
        $viewData['userAlreadyExist'] = "Un utilisateur existe déjà à cette adresse mail";
        loadView('infos', $viewData);
        exit;
    }
    $userRepository->changeEMail($id, $email);
}

if ($prenom !== $user->getFirstName()) {
    $userRepository->changeFirstName($id, $prenom);
}

if ($pseudo !== $user->getNickName()) {
    $userRepository->changeNickName($id, $pseudo);
}

if ($nom !== $user->getLastName()) {
    $userRepository->changeLastName($id, $nom);
}

if ($telephone !== $user->getPhoneNumber()) {
    $userRepository->changeLastName($id, $telephone);
}
header('Location: account.php');
exit;
