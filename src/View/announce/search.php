<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur) : ?>
    <p class="error"><?php echo $erreur; ?></p>
<?php
endif;
$q = isset($_GET['q']) && !empty($_GET['q']) ? htmlspecialchars($_GET['q']) : null;
$userId = $authenticatorService->getCurrentUserId();
if ($q!== null) {
    $announces = $announceRepository->search($q);
}
?>
<h1 class="text-dark pt-4">Résultat de votre recherche</h1>

<?php if (empty($announces)) : ?>
    <div>Aucune annonce ne correspond à votre recherche.</div>

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