<?php
$data = $announceRepository->getDataById($_POST['id']);
$user = $userRepository->getIdentity($data['idutilisateur']);
?>
<h1><?php echo $data['titre']; ?></h1>

<div>
    Publié par <?php echo $user['prenom'] . (isset($user['pseudo']) ? ' \'' . $user['pseudo'] . '\' ' : ' ') . $user['nom'] ?>
</div>
<div>
    <?php echo $data['datepublication']; ?>
</div>

<?php if (isset($data['description'])) : ?>
    <div>
        <?php echo $data['description']; ?>
    </div>
<?php endif; ?>
<?php if (isset($data['duree'])) : ?>
    <div>
        Durée maximale de prêt<?php echo $data['duree']; ?>
    </div>

<?php endif; ?>

<?php $file = glob("../src/View/images/announces/" . $data['id'] . ".*");
if (isset($file[0])) : ?>
    <div>
        <img src="<?php echo $file[0] ?>" />
    </div>
<?php endif;
if ($data['idutilisateur'] == $authenticatorService->getCurrentUserId()) :
?>
    <form action="newAnnounce.php" method="post">
        <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
        <button class="button1" type="submit">Modifier mon annonce</button>
    </form>
    <button class="button1" onclick="openForm('deleteAccountForm'); change('idAnnounce','<?php echo $data['id'] ?>')">Supprimer mon annonce</button>
    <div class="form-popup" id="deleteAccountForm">
        <form action="deleteAnnounce.php" method="post" class="form-container">
            <label for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
            <input id="idAnnounce" name="idAnnounce" type="hidden">
            <button type="submit" class="button1">Supprimer définitivement</button>
            <button type="button" class="button1 cancel" onclick="closeForm('deleteAccountForm')">Annuler</button>
        </form>
    </div>
<?php else : ?>
    <form action="userAnnounces.php" method="post">
        <input type="hidden" name="userId" value="<?php echo $data['idutilisateur'] ?>">
        <button class="button1" type="submit">Voir toutes les annonces de cet entraiideur</button>
    </form>
<?php endif;
if ($authenticatorService->isAuthenticated()) :
    $bool = ($announceService->isFav($announce->getId(), $userId)) ?>
    <form action="<?php echo $bool ? "deleteFav.php" : "addToFav.php" ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
        <button class="button1" type="submit"><?php echo $bool ? "Supprimer des" : "Ajouter aux"  ?> favoris</button>
    </form>
<?php endif;
if ($authenticatorService->isAdmin() && $authenticatorService->getCurrentUserId() !== $data['idutilisateur']) :
?>
    <button class="button1" onclick="openForm('deleteAccountForm'); change('idUser','<?php echo $data['idutilisateur'] ?>'); change('idAnnounce','<?php echo $data['id'] ?>')">Supprimer l'annonce</button>
    <div class="form-popup" id="deleteAccountForm">
        <form action="deleteAnnounce.php" method="post" class="form-container">
            <label for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
            <input id="idAnnounce" name="idAnnounce" type="hidden">
            <input id="idUser" name="idUser" type="hidden">
            <button type="submit" class="button1">Supprimer définitivement</button>
            <button type="button" class="button1 cancel" onclick="closeForm('deleteAccountForm')">Annuler</button>
        </form>
    </div>
<?php endif; ?>