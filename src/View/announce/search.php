<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur) : ?>
    <p class="error"><?php echo $erreur; ?></p>
<?php
endif;
$q = isset($_GET['q']) && !empty($_GET['q']) ? htmlspecialchars($_GET['q']) : null;
$userId = $authenticatorService->getCurrentUserId();
if ($q !== null) {
    $announces = $announceRepository->search($q);
}
?>
<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Résultat de votre recherche</h1>
</div>
<?php if (empty($announces)) : ?>
    <h4 class="text-dark text-center pt-4">Aucune annonce ne correspond à votre recherche.</h4>
    <?php else : foreach ($announces as &$announce) : ?>
    <?php
        loadAnnounce($announce, $userId, $announceService->isFav($announce->getId(), $userId));
    endforeach; ?>
<?php endif; ?>