<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur) : ?>
    <p class="error"><?php echo $erreur; ?></p>
<?php
endif;
$users = $userRepository->findAll();
?>
<h1>Les inscrits :</h1>

<?php foreach ($users as &$user) : ?>
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
    <?php if ($authenticatorService->getCurrentUserId() !== $user->getId()) : ?>
        <button class="button1" onclick="openForm('deleteForm'); change('idUser','<?php echo $user->getId() ?>')">Supprimer le compte</button>
    <?php else : ?>
        <button class="button1" onclick="location.href = 'account.php'">Mon compte</button>
<?php endif;
endforeach; ?>
<div class="form-popup" id="deleteForm">
    <form action="deleteAccount.php" method="post" class="form-container">
        <label for="password"><b>Mot de passe</b></label>
        <input type="password" placeholder="entrez votre mot de passe" name="password" required>
        <input id="idUser" name="idUser" type="hidden">
        <button type="submit" class="button1">Supprimer définitivement</button>
        <button type="button" class="button1 cancel" onclick="closeForm('deleteForm')">Annuler</button>
    </form>
</div>