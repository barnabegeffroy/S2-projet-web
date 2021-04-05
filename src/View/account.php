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

<h1>Vos informations</h1>

<div>
    <div>Prénom :</div>
    <div><?php echo $user->getFirstName() ?></div>
</div>
<?php if ($user->getNickName() !== null) : ?>
    <div>
        <div>Pseudo :</div>
        <div><?php echo $user->getNickName() ?></div>
    </div>
<?php endif; ?>
<div>
    <div>Nom :</div>
    <div><?php echo $user->getLastName() ?></div>
</div>
<div>
    <div>Email :</div>
    <div><?php echo $user->getEMail() ?></div>
</div>
<div>
    <div>Téléphone :</div>
    <div><?php echo $user->getPhoneNumber() ?></div>
</div>
<ul class="link-header-container">
    <li class="link-header-item">
        <button class="button1" onclick="location.href = 'password.php'">Modifier mon mot de passe</button>
    </li>
    <li class="link-header-item">
        <button class="button1" onclick="location.href = 'infos.php'">Modifier mes informations</button>
    </li>
</ul>
<button class="open-button" onclick="openForm()">Supprimer mon compte</button>
<div class="form-popup" id="myForm">
    <form action="deleteAccount.php" method="post" class="form-container">
        <label for="psw"><b>Mot de passe</b></label>
        <input type="password" placeholder="entrez votre mot de passe" name="password" required>
        <button type="submit" class="btn">Supprimer définitivement</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
    </form>
</div>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>
<?php if (isset($data['failedPassword'])) : ?>
    <span class="error-message"><?= $data['failedPassword'] ?></span>
<?php endif; ?>