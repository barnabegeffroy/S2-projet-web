<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur): ?>
<p class="error"><?php echo $erreur; ?></p>
<?php
endif;
$announces = $announceRepository->findAll();
?>
<h1>La plateforme de prêt d'objets de l'ENSIIE <?php echo exec('whoami'); ?></h1>

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
    <?php endforeach; ?>
<?php endif; ?>