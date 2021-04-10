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

<?php else : ?>

    <div class="form-popup" id="MyForm">
        <form action="deleteAnnounce.php" method="post" class="form-container">
            <label for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
            <input id="idAnnounce" name="idAnnounce" type="hidden">
            <button type="submit" class="button1">Supprimer définitivement</button>
            <button type="button" class="button1 cancel" onclick="closeForm()">Annuler</button>
        </form>
    </div>
    <?php foreach ($announces as &$announce) :
        loadAnnounce($announce);
    ?>
        <ul class="link-header-container">
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'password.php'">Modifier mon annonce</button>
            </li>
        </ul>
        <button class="button1" onclick="openForm(); change('<?php echo $announce->getId() ?>')">Supprimer mon annonce</button>
    <?php endforeach; ?>
    <script>
        function openForm() {
            document.getElementById("MyForm").style.display = "block";
        }

        function change(value) {
            document.getElementById("idAnnounce").setAttribute('value', value);
        }

        function closeForm() {
            document.getElementById("MyForm").style.display = "none";
        }
    </script>
<?php endif; ?>