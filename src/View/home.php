<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur): ?>
<p class="error"><?php echo $erreur; ?></p>
<?php
endif;?>
<h1>La plateforme de prêt d'objets de l'ENSIIE</h1>
