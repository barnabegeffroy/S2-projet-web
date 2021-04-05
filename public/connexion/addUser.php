<?php
include_once '../../src/utils/autoloader.php';
include_once '../../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);

$userService = new \Rediite\Model\Service\UserService($userRepository);

$prenom =  $_POST['prenom'];
$pseudo =  !empty($_POST['pseudo']) ? $_POST['pseudo'] : null;
$nom =  $_POST['nom'];
$email =  $_POST['email'];
$telephone =  $_POST['telephone'];
$password =  password_hash($_POST['password'], PASSWORD_BCRYPT);
$passwordVerify =  $_POST['password_verify'];

$viewData = [];

function checkFormData($userService, $email)
{
  $errorMessage = [];
  if ($userService->doesUserExist($email)) {
    $errorMessage['userAlreadyExist'] = "Un utilisateur existe déjà à cette adresse mail";
  }

  return $errorMessage;
}

$viewData = checkFormData($userService, $email);
if (empty($viewData)) {
  $userRepository->insert($prenom, $nom, $email, $telephone, $password);

  header('Location: login.php');
}
loadView('signup', $viewData);
