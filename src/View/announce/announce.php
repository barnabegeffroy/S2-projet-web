<?php
$data = $announceRepository->getDataById($_GET['id']);
if (empty($data)) : ?>
    <h3>Annonce introuvable</h3>
<?php else :
    $user = $userRepository->getIdentity($data['idutilisateur']);
    $userSessionId = $authenticatorService->getCurrentUserId(); ?>

    <div class="col-12 text-center mt-5">
        <h1 class="text-dark pt-4"><?php echo $data['titre']; ?></h1>
        <div class="border-top border-primary w-25 mx-auto my-3"></div>
        <p class="lead">
            Publié par <?php echo $user['prenom'] . (isset($user['pseudo']) ? ' \'' . $user['pseudo'] . '\' ' : ' ') . $user['nom'] . " le " . $data['datepublication']; ?>
        </p>
    </div>


    <div class="container mt-2">
        <div class="row my-5">
            <div class="col">
                <?php $file = glob("../src/View/images/announces/" . $data['id']  . ".*"); ?>
                <img src=" <?php if (isset($file[0])) {
                                echo $file[0];
                            } else {
                                echo "../src/View/images/no_pic.jpg";
                            } ?>" class="w-100" />
            </div>

            <div class="col">
                <?php if (isset($data['description'])) : ?>
                    <p>
                        <?php echo $data['description']; ?>
                    </p>
                <?php endif; ?>
                <?php if (isset($data['duree'])) : ?>
                    <p>
                        Durée maximale de prêt en jours : <strong><?php echo $data['duree']; ?></strong>
                    </p>
                <?php endif; ?>
            </div>


            <div class="col">
                <?php if ($data['idutilisateur'] == $userSessionId) : ?>
                    <form action="newAnnounce.php" method="post">
                        <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
                        <button class="btn btn-outline-dark btn-md my-1" type="submit">Modifier mon annonce</button>
                    </form>
                    <button class="btn btn-outline-dark btn-md my-1" onclick="openForm('deleteAccountForm'); change('idAnnounce','<?php echo $data['id'] ?>')">Supprimer mon annonce</button>
                    <div class="form-popup" id="deleteAccountForm">
                        <form action="deleteAnnounce.php" method="post" class="form-container">
                            <label class="form-label" for="password"><b>Mot de passe</b></label>
                            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
                            <input id="idAnnounce" name="idAnnounce" type="hidden">
                            <button type="submit" class="btn btn-outline-dark btn-md my-1">Supprimer définitivement</button>
                            <button type="button" class="btn btn-outline-dark btn-md my-1 cancel" onclick="closeForm('deleteAccountForm')">Annuler</button>
                        </form>
                    </div>
                <?php else : ?>
                    <form action="userAnnounces.php" method="GET">
                        <input type="hidden" name="userId" value="<?php echo $data['idutilisateur'] ?>">
                        <button class="btn btn-outline-dark btn-md my-1" type="submit">Voir toutes les annonces de cet entraiideur</button>
                    </form>
                <?php endif;
                if (!empty($userSessionId) && $userSessionId !== $data['idutilisateur']) :
                    $bool = ($announceService->isFav($data['id'], $userSessionId)) ?>
                    <form action="<?php echo $bool ? "deleteFav.php" : "addToFav.php" ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                        <button class="btn btn-outline-dark btn-md my-1" type="submit"><?php echo $bool ? "Supprimer des" : "Ajouter aux"  ?> favoris</button>
                    </form>
                <?php endif;
                if ($authenticatorService->isAdmin() && $userSessionId !== $data['idutilisateur']) :
                ?>
                    <button class="btn btn-outline-dark btn-md my-1" onclick="openForm('deleteAccountForm'); change('idUser','<?php echo $data['idutilisateur'] ?>'); change('idAnnounce','<?php echo $data['id'] ?>')">Supprimer l'annonce</button>
                    <div class="form-popup" id="deleteAccountForm">
                        <form action="deleteAnnounce.php" method="post" class="form-container">
                            <label class="form-label" for="password"><b>Mot de passe</b></label>
                            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
                            <input id="idAnnounce" name="idAnnounce" type="hidden">
                            <input id="idUser" name="idUser" type="hidden">
                            <button type="submit" class="btn btn-outline-dark btn-md my-1">Supprimer définitivement</button>
                            <button type="button" class="btn btn-outline-dark btn-md my-1 cancel" onclick="closeForm('deleteAccountForm')">Annuler</button>
                        </form>
                    </div>
                <?php endif; ?>
                <form id="resa" name="resa" action="addReservation.php" onsubmit="return validateForm(<?php echo isset($data['duree']) ? $data['duree'] : PHP_INT_MAX ?>)" method="POST">
                    <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
                    <input type="hidden" name="auth" value="<?php echo ($userSessionId !== $data['idutilisateur'] && !empty($userSessionId)) ?>">
                    <input type="hidden" id="resaDates" value="<?php
                                                                $resas = $announceRepository->findReservationsByAnnounce($data['id']);
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
                            <label class="form-label" for="dates"><b><?php echo $data['idutilisateur'] == $userSessionId || empty($userSessionId) ? "Calendrier des réservations" : "Sélectionnez la ou les dates de réservation" ?></b></label><br>
                            <input name="dates" required />
                            <div></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="../src/assets/scripts/maps.js"></script>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDabmvz7QF2a2kqCvs-yZjN-Uu54Ao3zbQ&callback=initMap&libraries=&v=weekly" async></script>

    <script src="../src/assets/scripts/calendar.js"></script>
    <link rel="stylesheet" type="text/css" href="../src/assets/css/calendar.css">
<?php endif; ?>