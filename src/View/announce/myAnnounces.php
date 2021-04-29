<?php
if (!$authenticatorService->isAuthenticated()) {
    $error = "Vous devez vous connecter pour accéder à cette page";
    header('Location: index.php?erreur=' . $error);
    exit;
}
$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);
$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);

$announces = $announceRepository->findAllByUserId($authenticatorService->getCurrentUserId());

?>

<?php if (isset($data['failedPassword'])) : ?>
    <span class="error-message"><?= $data['failedPassword'] ?></span>
<?php endif; ?>
<h1 class="text-dark pt-4">Mes annonces</h1>
<?php if (empty($announces)) : ?>
    <div>Vous n'avez encore aucune annonce publiée.</div>

<?php else : ?>

    <div class="form-popup" id="deleteAnnounceForm">
        <form action="deleteAnnounce.php" method="post" class="form-container">
            <label for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
            <input id="idAnnounce" name="idAnnounce" type="hidden">
            <button type="submit" class="button1">Supprimer définitivement</button>
            <button type="button" class="button1 cancel" onclick="closeForm('deleteAnnounceForm')">Annuler</button>
        </form>
    </div>
    <?php foreach ($announces as &$announce) :
        loadAnnounce($announce);
    ?>
        <form action="newAnnounce.php" method="post">
            <input type="hidden" name="idAnnounce" value="<?php echo $announce->getId() ?>">
            <button class="button1" type="submit">Modifier mon annonce</button>
        </form>
        <button class="button1" onclick="openForm('deleteAnnounceForm'); change('idAnnounce','<?php echo $announce->getId() ?>')">Supprimer mon annonce</button>
    <?php endforeach; ?>
<?php endif; ?>