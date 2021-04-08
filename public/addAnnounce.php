<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);

$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);

$titre = !empty($_POST['titre']) ? $_POST['titre'] : null;
$description = !empty($_POST['description']) ? $_POST['description'] : null;
$duree = !empty($_POST['duree']) ? $_POST['duree'] : null;
$lieu = !empty($_POST['lieu']) ? $_POST['lieu'] : null;
$date = date('d/m/Y');
$viewData = [];

if (null !== $titre &&  null !== $date) {
  $log = $announceRepository->insert($titre, $_SESSION['user_id'], $date, $duree, $description, $lieu);
  ?> 
  <script>
  console.log("<?php echo $log ?>");
  </script>
  <?php
}
$viewData['errorInCreation'] = "Impossible de créer l'annonce";
