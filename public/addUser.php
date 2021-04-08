<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);

$userService = new \Rediite\Model\Service\UserService($userRepository);

$pseudo = !empty($_POST['pseudo']) ? $_POST['pseudo'] : null;
$prenom = !empty($_POST['prenom']) ? $_POST['prenom'] : null;
$nom = !empty($_POST['nom']) ? $_POST['nom'] : null;
$email = !empty($_POST['email']) ? $_POST['email'] : null;
$telephone = !empty($_POST['telephone']) ? $_POST['telephone'] : null;
$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

$viewData = [];

function checkFormData($userService, $email)
{
  $errorMessage = [];
  if ($userService->doesUserExist($email)) {
    $errorMessage['userAlreadyExist'] = "Un utilisateur existe déjà à cette adresse mail";
  }

  return $errorMessage;
}

if (null !== $nom &&  null !== $prenom &&  null !== $email &&  null !== $telephone && null !== $password) {
  $viewData = checkFormData($userService, $email);
  if (empty($viewData)) {
    $log = $userRepository->insert($prenom, $pseudo, $nom, $email, $telephone, $password);
    if ($userService->doesUserExist($email)) {
      header('Location: index.php?erreur=' . $log);
      exit;
    }
    $viewData['errorInCreation'] = $log;
  }
}
loadView('connexion/signup', $viewData);
