<<<<<<< HEAD
<?php
if (!$authenticatorService->isAuthenticated()) {
    $error = "Vous devez vous connecter pour accéder à cette page";
    header('Location: index.php?erreur=' . $error);
    exit;
}

$userId = $authenticatorService->getCurrentUserId();
$convs = $chatRepository->findConvsByUserId($userId);

?>

<?php if (isset($data['failedPassword'])) : ?>
    <span class="error-message"><?= $data['failedPassword'] ?></span>
<?php endif; ?>
<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Messagerie</h1>
</div>
<?php if (empty($convs)) : ?>
    <h4 class="text-dark text-center pt-4">Vous n'avez encore de message.</h4>

<?php else : ?>
    <div class="form-popup" id="deleteConvForm">
        <form action="deleteConv.php" method="post" class="form-container">
            <label class="form-label" for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
            <input id="idConv" name="idConv" type="hidden">
            <button type="submit" class="button1">Supprimer définitivement</button>
            <button type="button" class="button1 cancel" onclick="closeForm('deleteAnnounceForm')">Annuler</button>
        </form>
    </div>
    <?php foreach ($convs as &$conv) :
        $idAnnounce = $conv['conv_idAnnonce'];
        $idChatter = $conv['id1'] == $userId ? $conv['id2'] : $conv['id1'];
        $idChat = $conv['conv_id'];
        $announce = $announceRepository->getTitle($idAnnounce);
        $chatterIdentity = $userRepository->getIdentity($idChatter);
    ?>
        <div class="container mt-2">
            <div class="row rounded-3 border border-3 my-5">
                <div class="col my-auto">
                    <h4 class="my-4"><?php echo $announce['titre'] ?></h4>
                    <h6><?php echo $chatterIdentity['prenom'] . (isset($chatterIdentity['pseudo']) ? ' \'' . $chatterIdentity['pseudo'] . '\' ' : ' ') . $chatterIdentity['nom']; ?></h6>
                </div>

                <div class="col my-auto">
                    <?php $file = glob("../src/View/images/announces/" . $idAnnounce . ".*"); ?>
                    <img src=" <?php if (isset($file[0])) {
                                    echo $file[0];
                                } else {
                                    echo "../src/View/images/no_pic.jpg";
                                } ?>" class="w-100" />
                </div>
                <div class="col my-auto">
                    <form action="salon.php" method="GET">
                        <input type="hidden" name="idConv" value="<?php echo $idChat ?>">
                        <button class="btn btn-outline-dark btn-md my-1" type="submit">Ouvrir la conversation</button>
                    </form>
                    <button class="btn btn-outline-dark btn-md my-1" onclick="openForm('deleteConvForm'); change('deleteConv','<?php echo $idAnnounce ?>')">Supprimer mon annonce</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
=======
<?php
if (!$authenticatorService->isAuthenticated()) {
    $error = "Vous devez vous connecter pour accéder à cette page";
    header('Location: index.php?erreur=' . $error);
    exit;
}

$userId = $authenticatorService->getCurrentUserId();
$convs = $chatRepository->findConvsByUserId($userId);

?>

<?php if (isset($data['failedPassword'])) : ?>
    <span class="error-message"><?= $data['failedPassword'] ?></span>
<?php endif; ?>
<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Messagerie</h1>
</div>
<?php if (empty($convs)) : ?>
    <h4 class="text-dark text-center pt-4">Vous n'avez encore de message.</h4>

<?php else : ?>
    <div class="form-popup" id="deleteConvForm">
        <form action="deleteConv.php" method="post" class="form-container">
            <label class="form-label" for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
            <input id="idConv" name="idConv" type="hidden">
            <button type="submit" class="button1">Supprimer définitivement</button>
            <button type="button" class="button1 cancel" onclick="closeForm('deleteAnnounceForm')">Annuler</button>
        </form>
    </div>
    <?php foreach ($convs as &$conv) :
        $idAnnounce = $conv['conv_idAnnonce'];
        $idChatter = $conv['id1'] == $userId ? $conv['id2'] : $conv['id1'];
        $idChat = $conv['id'];
        $announce = $announceRepository->getTitle($idAnnounce);
        $chatterIdentity = $userRepository->getIdentity($idChatter);
    ?>
        <div class="container mt-2">
            <div class="row rounded-3 border border-3 my-5">
                <div class="col my-auto">
                    <h4 class="my-4"><?php echo $announce['titre'] ?></h4>
                    <h6><?php echo $chatterIdentity['prenom'] . (isset($chatterIdentity['pseudo']) ? ' \'' . $chatterIdentity['pseudo'] . '\' ' : ' ') . $chatterIdentity['nom']; ?></h6>
                </div>

                <div class="col my-auto">
                    <?php $file = glob("../src/View/images/announces/" . $idAnnounce . ".*"); ?>
                    <img src=" <?php if (isset($file[0])) {
                                    echo $file[0];
                                } else {
                                    echo "../src/View/images/no_pic.jpg";
                                } ?>" class="w-100" />
                </div>
                <div class="col my-auto">
                    <form action="salon.php" method="GET">
                        <input type="hidden" name="idConv" value="<?php echo $idChat ?>">
                        <button class="btn btn-outline-dark btn-md my-1" type="submit">Ouvrir la conversation</button>
                    </form>
                    <button class="btn btn-outline-dark btn-md my-1" onclick="openForm('deleteConvForm'); change('deleteConv','<?php echo $idAnnounce ?>')">Supprimer mon annonce</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
>>>>>>> 4a0d3176a1de787a4bcf0e8035f3023811ae38d9
<?php endif; ?>