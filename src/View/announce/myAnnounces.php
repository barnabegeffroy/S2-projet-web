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

$userId = $authenticatorService->getCurrentUserId();
$announces = $announceRepository->findAllByUserId($userId);

?>

<?php if (isset($data['failedPassword'])) : ?>
    <span class="error-message"><?= $data['failedPassword'] ?></span>
<?php endif; ?>
<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Mes annonces</h1>
</div>
<?php if (empty($announces)) : ?>
    <h4 class="text-dark text-center pt-4">Vous n'avez encore aucune annonce publiée.</h4>

<?php else : ?>
    <div class="form-popup" id="deleteAnnounceForm">
        <form action="deleteAnnounce.php" method="post" class="form-container">
            <label class="form-label" for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" required>
            <input id="idAnnounce" name="idAnnounce" type="hidden">
            <button type="submit" class="button1">Supprimer définitivement</button>
            <button type="button" class="button1 cancel" onclick="closeForm('deleteAnnounceForm')">Annuler</button>
        </form>
    </div>
    <?php foreach ($announces as &$announce) :
        loadAnnounce($announce, $userId, $announceService->isFav($announce->getId(), $userId));
    endforeach; ?>
<?php endif; ?>