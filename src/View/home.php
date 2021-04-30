<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur) : ?>
    <p class="error"><?php echo $erreur; ?></p>
<?php
endif;
$announces = $announceRepository->findAll();
$userId = $authenticatorService->getCurrentUserId();
?>

<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">La plateforme de prêt d'objets de l'ENSIIE</h1>
</div>
<?php if (empty($announces)) : ?>
    <div>Aucune annonce publiée pour l'instant.</div>

<?php else : foreach ($announces as &$announce) :
        loadAnnounce($announce, $userId, $announceService->isFav($announce->getId(), $userId));
    endforeach; ?>
<?php endif; ?>