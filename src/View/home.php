<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur) : ?>
    <p class="error"><?php echo $erreur; ?></p>
<?php
endif;
$announces = $announceRepository->findAll();
$userId = $authenticatorService->getCurrentUserId();
?>
<h1 class="text-dark pt-4">La plateforme de prêt d'objets de l'ENSIIE</h1>

<?php if (empty($announces)) : ?>
    <div>Aucune annonce publiée pour l'instant.</div>

    <?php else : foreach ($announces as &$announce) :
        loadAnnounce($announce);
    ?>
        <?php if (isset($userId)) :
            if ($announce->getUserId() ==  $userId) : ?>
                <button class="button1" onclick="location.href = 'myAnnounces.php'">Voir toutes mes annonces</button>
            <?php else :
                $bool = ($announceService->isFav($announce->getId(), $userId)) ?>
                <form action="<?php echo $bool ? "deleteFav.php" : "addToFav.php" ?>" method="POST">
                    <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
                    <button class="button1" type="submit"><?php echo $bool ? "Supprimer des" : "Ajouter aux"  ?> favoris</button>
                </form>
    <?php endif;
        endif;
    endforeach; ?>
<?php endif; ?>