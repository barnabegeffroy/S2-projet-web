<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

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
$password =  $_POST['password'];
$passwordVerify =  $_POST['password_verify'];

$viewData = [];

function checkFormData($userService, $email, $password, $passwordVerify)
{
  $errorMessage = [];
  if ($userService->doesUserExist($email)) {
    $errorMessage['userAlreadyExist'] = "Un utilisateur existe déjà à cette adresse mail";
  }

  if ($password !== $passwordVerify) {
    $errorMessage['passwordDoesNotMatch'] = "Les mots de passes ne sont pas identiques";
  }
  return $errorMessage;
}

$viewData = checkFormData($userService, $email, $password, $passwordVerify);
if (empty($viewData)) {
  $userRepository->insert($prenom, $nom, $email, $telephone, password_hash($password, PASSWORD_BCRYPT));
  
  header('Location: index.php');
}
loadView('signup', $viewData);
