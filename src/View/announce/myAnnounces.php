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

$announces = $announceRepository->findAllByUserId($_SESSION['user_id']);

?>

<?php if (isset($data['failedPassword'])) : ?>
    <span class="error-message"><?= $data['failedPassword'] ?></span>
<?php endif; ?>
<h1>Mes annonces</h1>
<?php if (empty($announces)) : ?>
    <div>Vous n'avez encore aucune annonce publiée.</div>

    <?php else : foreach ($announces as &$announce) :
    ?>
        <div>
            <div>Titre :</div>
            <div><?php echo $announce->getTitle() ?></div>
        </div>
        <div>
            <div>Date de publication :</div>
            <div><?php echo $announce->getDate() ?></div>
        </div>
        <?php if ($announce->getDescription() !== null) : ?>
            <div>
                <div>Description :</div>
                <div><?php echo $announce->getDescription() ?></div>
            </div>
        <?php endif; ?>
        <?php if ($announce->getPlace() !== null) : ?>
            <div>
                <div>Lieu de prêt :</div>
                <div><?php echo $announce->getPlace() ?></div>
            </div>
        <?php endif; ?>
        <?php if ($announce->getDuration() !== null) : ?>
            <div>
                <div>Durée de prêt maximale :</div>
                <div><?php echo $announce->getDuration() ?></div>
            </div>
        <?php endif; ?>

        <ul class="link-header-container">
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'password.php'">Modifier mon annonce</button>
            </li>
        </ul>
        <button class="button1" onclick="openForm()">Supprimer mon annonce</button>
        <div class="form-popup" id="myForm">
            <form action="deleteAnnounce.php" method="post" class="form-container">
                <label for="password"><b>Mot de passe</b></label>
                <input type="password" placeholder="entrez votre mot de passe" name="password" required>
                <input id="idAnnounce" name="idAnnounce" type="hidden" value="<?php $announce->getId() ?>">
                <button type="submit" class="button1">Supprimer définitivement</button>
                <button type="button" class="button1 cancel" onclick="closeForm()">Annuler</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>