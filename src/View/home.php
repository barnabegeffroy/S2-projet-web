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
    <div class="form-popup" id="deleteAnnounceForm">
        <form action="deleteAnnounce.php" method="post" class="form-container">
            <label class="form-label" for="password"><strong>Mot de passe</strong></label>
            <input type="password" placeholder="entrez votre mot de passe" name="password" id="password" required>
            <input id="idAnnounce" name="idAnnounce" type="hidden">
            <button type="submit" class="btn btn-outline-dark btn-md my-1">Supprimer définitivement</button>
            <button type="button" class="btn btn-outline-dark btn-md my-1 cancel" onclick="closeForm('deleteAnnounceForm')">Annuler</button>
        </form>
    </div>
<?php endif; ?>