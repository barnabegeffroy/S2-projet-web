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
        <link rel="stylesheet" type="text/css" href="../src/assets/css/style.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="../src/assets/scripts/form.js"></script>
        <script src="../src/assets/scripts/maps.js"></script>
        
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDabmvz7QF2a2kqCvs-yZjN-Uu54Ao3zbQ&callback=initMap&libraries=&v=weekly" async></script> -->
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
            <div>Durée de prêt maximale en jours :</div>
            <div><?php echo $announce->getDuration() ?></div>
        </div>
    <?php endif; ?>
    <?php $file = glob("../src/View/images/announces/" . $announce->getId() . ".*");
    if (isset($file[0])) : ?>
        <div>
            <img src="<?php echo $file[0] ?>" />
        </div>
    <?php endif; ?>
    <form action="announce.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
        <button class="button1" type="submit">Voir l'annonce</button>
    </form>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry,places&key=AIzaSyDabmvz7QF2a2kqCvs-yZjN-Uu54Ao3zbQ&callback=initMap"></script>
<?php }

function upload_image($announceRepository, $viewData, $image, $id)
{
    if ($image !== null) {
        $dossier = '../src/View/images/announces/';
        $fichier = basename($image['name']);
        $taille_maxi = 1000000;
        $taille = filesize($image['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($image['name'], '.');
        //Début des vérifications de sécurité...
        if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $viewData['errorInCreation'] = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg';
        } else if ($taille > $taille_maxi) {
            $viewData['errorInCreation'] = 'Le fichier est trop gros...';
        } else {
            $id = $announceRepository->getDataById($id)['id'];
            $fichier = $id . $extension;
            if (move_uploaded_file($image['tmp_name'], $dossier . $fichier)) {
                $announceRepository->changePhoto($id, true);
            } else {
                $viewData['errorInCreation'] = 'Echec de l\'upload !';
            }
            return $viewData;
        }
    }
    $viewData['errorInCreation'] = 'fichier introuvable !';
    return $viewData;
}
