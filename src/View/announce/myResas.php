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

$resas = $announceRepository->findReservationsByUser($authenticatorService->getCurrentUserId());

?>

<h1>Mes reservations</h1>
<?php if (empty($resas)) : ?>
    <div>Vous n'avez pas encore de réservation.</div>

<?php else : ?>
    <?php foreach ($resas as &$resa) :
        $announce = $announceRepository->findOneById($resa['idannonce']);
        loadAnnounce($announce);
    ?>
        <div>
            Date de début : <?php echo $resa['datedebut']; ?>
        </div>
        <div>
            Date de fin : <?php echo $resa['datefin']; ?>
        </div>
        <form action="deleteResa.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
            <input type="hidden" name="start" value="<?php echo $resa['datedebut'] ?>">
            <input type="hidden" name="userId" value="<?php echo $authenticatorService->getCurrentUserId() ?>">
            <button class="button1" type="submit">Supprimer cette réservation</button>
        </form>
    <?php endforeach; ?>

<?php endif; ?>