<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur) : ?>
    <p class="error"><?php echo $erreur; ?></p>
<?php
endif;
$announces = $announceRepository->findAll();
?>
<h1>La plateforme de prêt d'objets de l'ENSIIE</h1>

<?php if (empty($announces)) : ?>
    <div>Aucune annonce publiée pour l'instant.</div>

    <?php else : foreach ($announces as &$announce) :
    ?>
        <div>
            <div>Titre :</div>
            <div><?php echo $announce->getTitle() ?></div>
        </div>
        <div>
            <div>Date de publication :</div>
            <div><?php echo $announce->getDate() ?></div>
        </div>
        <?php if ($announce->getDescription() !== null) : ?>
            <div>
                <div>Description :</div>
                <div><?php echo $announce->getDescription() ?></div>
            </div>
        <?php endif; ?>
        <?php if ($announce->getDuration() !== null) : ?>
            <div>
                <div>Durée de prêt maximale :</div>
                <div><?php echo $announce->getDuration() ?></div>
            </div>
        <?php endif; ?>
        <form action="viewAnnounce.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
            <button class="button1" onclick="location.href = 'announce.php'">Voir l'annonce</button>
        </form>
        <?php if ($announce->getUserId() == isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null) : ?>
            <button class="button1" onclick="location.href = 'myAnnounces.php'">Voir toutes mes annonces</button>
        <?php else : ?>
            <button class="button1" onclick="location.href = 'addToFav.php'">Ajouter aux favoris</button>
    <?php endif;
    endforeach; ?>
<?php endif; ?>