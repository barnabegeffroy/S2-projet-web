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
        <link rel="stylesheet" href="../src/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../src/assets/css/style.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="../src/assets/scripts/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="../src/assets/scripts/form.js"></script>
        <script src="../src/assets/scripts/maps.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDabmvz7QF2a2kqCvs-yZjN-Uu54Ao3zbQ"></script>
    
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

function loadAnnounce($announce, $userId, $isFav)
{ ?>
    <div class="container mt-2">
        <div class="row rounded-3 border border-3 my-5">
            <div class="col my-auto">
                <h4 class="my-4"><?php echo $announce->getTitle() ?></h4>
                <h6>Date de publication :</h6>
                <p><?php echo $announce->getDate() ?></p>
                <?php if ($announce->getDescription() !== null) : ?>
                    <h6>Description :</h6>
                    <p><?php echo $announce->getDescription() ?></p>
                <?php endif; ?>
                <?php if ($announce->getPlace() !== null) : ?>
                    <h6>Lieu de prêt :</h6>
                    <p><?php echo $announce->getPlace() ?></p>
                <?php endif; ?>
                <?php if ($announce->getDuration() !== null) : ?>
                    <h6>Durée de prêt maximale en jours :</h6>
                    <p><?php echo $announce->getDuration() ?></p>
                <?php endif; ?>
            </div>

            <div class="col my-auto">
                <?php $file = glob("../src/View/images/announces/" . $announce->getId() . ".*"); ?>
                <img src=" <?php if (isset($file[0])) {
                                echo $file[0];
                            } else {
                                echo "../src/View/images/no_pic.jpg";
                            } ?>" class="w-100" />
            </div>

            <div class="col my-auto">
                <form action="announce.php" method="GET">
                    <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
                    <button class="btn btn-outline-dark btn-md my-1" type="submit">Voir l'annonce</button>
                </form>
                <?php if ($announce->getUserId() ==  $userId) : ?>
                    <button class="btn btn-outline-dark btn-md my-1" onclick="location.href = 'myAnnounces.php'">Voir toutes mes annonces</button>
                    <form action="newAnnounce.php" method="post">
                        <input type="hidden" name="idAnnounce" value="<?php echo $announce->getId() ?>">
                        <button class="btn btn-outline-dark btn-md my-1" type="submit">Modifier mon annonce</button>
                    </form>
                    <button class="btn btn-outline-dark btn-md my-1" onclick="openForm('deleteAnnounceForm'); change('idAnnounce','<?php echo $announce->getId() ?>')">Supprimer mon annonce</button>
                <?php elseif (!empty($userId)) :
                    $bool = ($isFav) ?>
                    <form action="<?php echo $bool ? "deleteFav.php" : "addToFav.php" ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $announce->getId() ?>">
                        <button class="btn btn-outline-dark btn-md my-1" type="submit"><?php echo $bool ? "Supprimer des" : "Ajouter aux"  ?> favoris</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
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
