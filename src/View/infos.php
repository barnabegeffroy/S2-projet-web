<?php
if (!$authenticatorService->isAuthenticated()) {
    $error = "Vous devez vous connecter pour accéder à cette page";
    header('Location: index.php?erreur=' . $error);
    exit;
}
$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$userService = new \Rediite\Model\Service\UserService($userRepository);

$user = $userRepository->findOneById($_SESSION['user_id']);
?>
<form action="addUser.php" method="post">
    <div>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $user->getFirstName() ?>" required />
    </div>
    <div>
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" value="<?php echo $user->getNickName() ?>" />
    </div>
    <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $user->getLastName() ?>" required />
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" value="<?php echo $user->getEMail() ?>" required />
        <?php if (isset($data['userAlreadyExist'])) : ?>
            <span class="error-message"><?= $data['userAlreadyExist'] ?></span>
        <?php endif; ?>
    </div>
    <div>
        <label for="telephone">Numéro de téléphone:</label>
        <input type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" value="<?php echo $user->getPhoneNumber() ?>" required>
        <small>Format: 0612345678</small>
    </div>
    <button type="submit">Valider</button>
</form>