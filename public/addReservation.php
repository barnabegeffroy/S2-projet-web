<?php
include_once '../src/utils/autoloader.php';
include_once '../src/View/template.php';

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$messageHydrator = new \Rediite\Model\Hydrator\MessageHydrator();
$chatRepository = new \Rediite\Model\Repository\ChatRepository($dbAdapter, $messageHydrator);
?>

<div class="">
    Bonjour, je souhaiterais emprunter votre objet du <?php echo $_POST['dates']; ?>.
    <form action="acceptResa.php" class="form-container">
        <input type="hidden" name="idAnnonce" value="<?php echo $_POST['idAnnounce']; ?>">
        <input type="hidden" name="" value="<?php echo $_POST['dates']; ?>">
        <button type="submit" class="btn btn-outline-dark btn-md my-1">Accepter</button>
    </form>
    <form action="declineResa.php" class="form-container">
        <input type="hidden" name="idAnnonce" value="<?php echo $_POST['idAnnounce']; ?>">
        <input type="hidden" name="" value="<?php echo $_POST['dates']; ?>">
        <button type="submit" class="btn btn-outline-dark btn-md my-1">Refuser</button>
    </form>
</div>
<div><?php echo $_POST['idAnnounce']; ?></div>
<div><?php echo $_POST['dates']; ?></div>