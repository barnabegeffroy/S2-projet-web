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

<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Mes favoris</h1>
</div>
    <?php if (empty($favs)) : ?>
        <h4 class="text-dark pt-4 text-center">Vous n'avez pas encore de favoris.</h4>

<?php else : ?>
    <?php foreach ($favs as &$announce) :
            loadAnnounce($announce, $authenticatorService->getCurrentUserId(), true);
        endforeach; ?>

<?php endif; ?>