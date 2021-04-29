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
$resas = $announceRepository->findLoans($userId);

?>

<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Mes entraiides</h1>
</div>
<?php if (empty($resas)) : ?>
    <h4 class="text-dark text-center pt-4">Vous n'avez pas encore d'entraiides.</h4>

<?php else : ?>
    <?php foreach ($resas as &$resa) :
        $announce = $announceRepository->findOneById($resa['res_idannonce']);
    ?>
        <div class="border round">
            <p class="text-center"> Du <?php echo $resa['datedebut']; ?> au <?php echo $resa['datefin']; ?> :</p>
            <?php loadAnnounce($announce, $userId, $announceService->isFav($announce->getId(), $userId));
            ?>
            <form class="text-center" action="deleteResa.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
                <input type="hidden" name="start" value="<?php echo $resa['datedebut'] ?>">
                <input type="hidden" name="userId" value="<?php echo $announce->getUserId() ?>">
                <button class="btn btn-outline-dark btn-md" type="submit">Supprimer cette réservation</button>
            </form>
        </div>
    <?php endforeach; ?>

<?php endif; ?>