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
$resas = $announceRepository->findReservationsByUser($userId);

?>

<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Mes reservations</h1>
</div>
<?php if (empty($resas)) : ?>
    <h4 class="text-dark text-center pt-4">Vous n'avez pas encore de réservation.</h4>
<?php else : ?>
    <?php foreach ($resas as &$resa) :
        $announce = $announceRepository->findOneById($resa['res_idannonce']); ?>
        <div class="border border-3 rounded-3 my-1">
            <p class="text-center my-2 font-weight-bold"> Du <?php echo $resa['datedebut']; ?> au <?php echo $resa['datefin']; ?> :</p>
            <?php loadAnnounce($announce, $userId, $announceService->isFav($announce->getId(), $userId));
            ?>
            <form class="text-center" action="deleteResa.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
                <input type="hidden" name="start" value="<?php echo $resa['datedebut'] ?>">
                <input type="hidden" name="userId" value="<?php echo $userId ?>">
                <button class="btn btn-outline-dark btn-md" type="submit">Supprimer cette réservation</button>
            </form>
        </div>

    <?php endforeach; ?>

<?php endif; ?>