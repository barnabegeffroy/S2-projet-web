<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur) : ?>
    <p class="error"><?php echo $erreur; ?></p>
<?php
endif;
$users = $userRepository->findAll();
?>
<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4 my-5">Les inscrits :</h1>
    <?php foreach ($users as &$user) : ?>
        <div class="border rounded">
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
            <?php if ($authenticatorService->getCurrentUserId() !== $user->getId()) : ?>
                <button class="btn btn-outline-dark btn-md my-1" onclick="openForm('deleteForm'); change('idUser','<?php echo $user->getId() ?>')">Supprimer le compte</button>
            <?php else : ?>
                <button class="btn btn-outline-dark btn-md my-1" onclick="location.href = 'account.php'">Mon compte</button>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <div class="form-popup" id="deleteForm">
        <form action="deleteAccount.php" method="post" class="form-container">
            <label class="form-label" for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
            <input id="idUser" name="idUser" type="hidden">
            <button type="submit" class="btn btn-outline-dark btn-md my-1">Supprimer définitivement</button>
            <button type="button" class="btn btn-outline-dark btn-md my-1 cancel" onclick="closeForm('deleteForm')">Annuler</button>
        </form>
    </div>
</div>