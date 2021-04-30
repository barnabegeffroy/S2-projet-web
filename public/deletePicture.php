<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);

$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);

$id = $_POST['idAnnounce'];
$filename = $_POST['filename'];
$announceRepository->changePhoto($id, false);
unlink($filename);

header('Location: announce.php?id=' . $id);
exit;
?>
<!-- <form id="tmpForm" action="announce.php" method="get"> -->
<!-- <input type="hidden" name="id" value="<?php echo $id ?>"> -->
<!-- </form> -->
<!-- <script type="text/javascript"> -->
// document.getElementById('tmpForm').submit();
<!-- </script> -->
<!--  -->