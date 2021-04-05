<?php
include_once '../src/Model/Service/AuthenticatorService.php';

function loadView($view, $data)
{
    $dbfactory = new \Rediite\Model\Factory\dbFactory();
    $dbAdapter = $dbfactory->createService();
    $userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
    $userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
    $authenticatorService = new \Rediite\Model\Service\AuthenticatorService($userRepository);
?>
    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Votre Horoscope</title>
        <link rel="stylesheet" href="style.css">

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
?>