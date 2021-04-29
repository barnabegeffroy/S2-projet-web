<?php
$data = $announceRepository->getDataById($_GET['id']);
$user = $userRepository->getIdentity($data['idutilisateur']);
$userSessionId = $authenticatorService->getCurrentUserId();
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
        Durée maximale de prêt en jours : <?php echo $data['duree']; ?>
    </div>

<?php endif; ?>

<?php $file = glob("../src/View/images/announces/" . $data['id'] . ".*");
if (isset($file[0])) : ?>
    <div>
        <img src="<?php echo $file[0] ?>" />
    </div>
<?php endif;
if ($data['idutilisateur'] == $userSessionId) :
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
    <form action="userAnnounces.php" method="GET">
        <input type="hidden" name="userId" value="<?php echo $data['idutilisateur'] ?>">
        <button class="button1" type="submit">Voir toutes les annonces de cet entraiideur</button>
    </form>
<?php endif;
if (!empty($userSessionId) && $userSessionId !== $data['idutilisateur']) :
    $bool = ($announceService->isFav($data['id'], $userSessionId)) ?>
    <form action="<?php echo $bool ? "deleteFav.php" : "addToFav.php" ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
        <button class="button1" type="submit"><?php echo $bool ? "Supprimer des" : "Ajouter aux"  ?> favoris</button>
    </form>
<?php endif;
if ($authenticatorService->isAdmin() && $userSessionId !== $data['idutilisateur']) :
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
<form id="resa" name="resa" action="addReservation.php" onsubmit="return validateForm(<?php echo isset($data['duree']) ? $data['duree'] : PHP_INT_MAX ?>)" method="POST">
    <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
    <input type="hidden" name="auth" value="<?php echo ($userSessionId !== $data['idutilisateur'] && !empty($userSessionId)) ?>">
    <input type="hidden" id="resaDates" value="<?php
                                                $resas = $announceRepository->getReservation($data['id']);
                                                foreach ($resas as &$resa) {
                                                    $date = strtotime($resa['datedebut']);
                                                    $endDate = strtotime($resa['datefin']);
                                                    while ($date <= $endDate) {
                                                        $printedDate = date("Y/m/d", $date);
                                                        echo $printedDate . " ";
                                                        $date = strtotime("+1 day", $date);
                                                    }
                                                } ?>">

    <div class="wrapper">
        <div id="jrange" class="dates">
            <label for="dates"><b><?php echo $data['idutilisateur'] == $userSessionId || empty($userSessionId) ? "Calendrier des réservations" : "Sélectionnez la ou les dates de réservation" ?></b></label>
            <input name="dates" required />
            <div></div>
        </div>
    </div>
</form>
<script src="../src/assets/scripts/calendar.js"></script>
<style>
    .date-range-selected>.ui-state-active,
    .date-range-selected>.ui-state-default {
        background: none;
        background-color: lightsteelblue;
    }
</style>


<div id="map"></div>
<script src="../src/assets/scripts/maps.js"></script>