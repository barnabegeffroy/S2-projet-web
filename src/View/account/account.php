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

$user = $authenticatorService->getCurrentUser();

?>

<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Vos informations</h1>
    <div>
        <h5>Prénom :</h5>
        <div><?php echo $user->getFirstName() ?></div>
    </div>
    <?php if ($user->getNickName() !== null) : ?>
        <div>
            <h5>Pseudo :</h5>
            <div><?php echo $user->getNickName() ?></div>
        </div>
    <?php endif; ?>
    <div>
        <h5>Nom :</h5>
        <div><?php echo $user->getLastName() ?></div>
    </div>
    <div>
        <h5>Email :</h5>
        <div><?php echo $user->getEMail() ?></div>
    </div>
    <div>
        <h5>Téléphone :</h5>
        <div><?php echo $user->getPhoneNumber() ?></div>
    </div>
    <button class="btn btn-outline-dark btn-md my-1" onclick="location.href = 'password.php'">Modifier mon mot de passe</button>
    <button class="btn btn-outline-dark btn-md my-1" onclick="location.href = 'infos.php'">Modifier mes informations</button>
    <button class="btn btn-outline-dark btn-md my-1" onclick="openForm('deleteAccountForm')">Supprimer mon compte</button>
    <div class="form-popup" id="deleteAccountForm">
        <form action="deleteAccount.php" method="post" class="form-container">
            <label class="form-label" for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
            <button type="submit" class="btn btn-outline-dark btn-md my-1">Supprimer définitivement</button>
            <button type="button" class="btn btn-outline-dark btn-md my-1 cancel" onclick="closeForm('deleteAccountForm')">Annuler</button>
        </form>
    </div>

    <?php if (isset($data['failedPassword'])) : ?>
        <span class="error-message"><?= $data['failedPassword'] ?></span>
    <?php endif; ?>
</div>