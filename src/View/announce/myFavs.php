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

$favs = $announceRepository->findAllFavs($authenticatorService->getCurrentUserId());

?>

<h1 class="text-dark pt-4">Mes favoris</h1>
<?php if (empty($favs)) : ?>
    <div>Vous n'avez pas encore de favoris.</div>

<?php else : ?>
    <?php foreach ($favs as &$announce) :
        loadAnnounce($announce);
    ?>
        <form action="deleteFav.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
            <button class="button1" type="submit">Supprimer des favoris</button>
        </form>
    <?php endforeach; ?>

<?php endif; ?>