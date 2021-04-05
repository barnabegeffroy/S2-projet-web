<?php

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$userService = new \Rediite\Model\Service\UserService($userRepository);

$user = $userRepository->findOneById($_SESSION['user_id']);

?>

<h1>Vos informations</h1>

<div>
    <div>Prénom :</div>
    <div><?php echo $user->getFirstName() ?></div>
</div>