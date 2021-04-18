<?php

function loadView($view, $data)
{
    $dbfactory = new \Rediite\Model\Factory\dbFactory();
    $dbAdapter = $dbfactory->createService();
    $userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
    $userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
    $authenticatorService = new \Rediite\Model\Service\AuthenticatorService($userRepository);
    $announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
    $announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);
    $announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);
?>
    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>ENTRAiiDe</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.7.3/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    </head>

    <body>
        <?php include_once '../src/View/layout/header.php' ?>
        <div class="main-container">
            <?php include_once '../src/View/' . $view . '.php' ?>
        </div>
        <?php include_once '../src/View/layout/footer.php' ?>
    </body>

    </html>
<?php
}

function loadAnnounce($announce)
{ ?>
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
    <?php if ($announce->getPlace() !== null) : ?>
        <div>
            <div>Lieu de prêt :</div>
            <div><?php echo $announce->getPlace() ?></div>
        </div>
    <?php endif; ?>
    <?php if ($announce->getDuration() !== null) : ?>
        <div>
            <div>Durée de prêt maximale :</div>
            <div><?php echo $announce->getDuration() ?></div>
        </div>
    <?php endif; ?>
    <?php if ($announce->getPhoto()) : ?>
        <div>
            <img src="<?php glob("../src/View/images/announces/" . $announce->getId() . "*") ?>" />
        </div>
    <?php endif; ?>
    <form action="announce.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
        <button class="button1" type="submit">Voir l'annonce</button>
    </form>
<?php } ?>