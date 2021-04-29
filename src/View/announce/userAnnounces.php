<?php
$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);
$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);

$userId = isset($_GET['userId']) ? isset($_GET['userId']) : null;
$announces = $announceRepository->findAllByUserId($userId);
$userSessionId = $authenticatorService->getCurrentUserId();
?>

<?php if (isset($data['failedPassword'])) : ?>
    <span class="error-message"><?= $data['failedPassword'] ?></span>
<?php endif; ?>

<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Les annonces de cet entraiideur</h1>
</div>

<?php if (empty($announces)) : ?>
    <h4 class="text-dark text-center pt-4">Aucune annonce publiée pour l'instant.</h4>

    <?php else : foreach ($announces as &$announce) : ?>
    <?php
        loadAnnounce($announce, $userSessionId, $announceService->isFav($announce->getId(), $userSessionId));
    endforeach; ?>
<?php endif; ?>