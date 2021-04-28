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
<h1>Les annonces de cet entraiideur</h1>
<?php if (empty($announces)) : ?>
    <div>Aucune annonce publiée pour l'instant.</div>

    <?php else : foreach ($announces as &$announce) :
        loadAnnounce($announce);
        if ($announce->getUserId() ==  $userSessionId) : ?>
            <button class="button1" onclick="location.href = 'myAnnounces.php'">Voir toutes mes annonces</button>
        <?php elseif (!empty($userSessionId)) :
            $bool = ($announceService->isFav($announce->getId(), $userId)) ?>
            <form action="<?php echo $bool ? "deleteFav.php" : "addToFav.php" ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
                <button class="button1" type="submit"><?php echo $bool ? "Supprimer des" : "Ajouter aux"  ?> favoris</button>
            </form>
    <?php endif;
    endforeach; ?>
<?php endif; ?>