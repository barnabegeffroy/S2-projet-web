<?php
$data = $announceRepository->getDataById($_POST['id']);
$user = $userRepository->getIdentity($data['idutilisateur']);
?>
<h1><?php echo $data['titre']; ?></h1>

<div>
    Publié par <?php echo $user['prenom'] . (isset($user['pseudo']) ? ' \'' . $user['pseudo'] . '\' ' : ' ') . $user['nom'] ?>
</div>
<div>
    <?php echo $data['datepublication']; ?>
</div>

<?php if (isset($data['description'])) : ?>
    <div>
        <?php echo $data['description']; ?>
    </div>
<?php endif; ?>
<?php if (isset($data['duree'])) : ?>
    <div>
        Durée maximale de prêt<?php echo $data['duree']; ?>
    </div>

<?php endif; ?>

<?php $file = glob("../src/View/images/announces/" . $data['id'] . ".*");
if (isset($file[0])) : ?>
    <div>
        <img src="<?php echo $file[0] ?>" />
    </div>
<?php endif;
if ($data['idutilisateur'] == $_SESSION['user_id']) :
?>
    <form action="newAnnounce.php" method="post">
        <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
        <button class="button1" type="submit">Modifier mon annonce</button>
    </form>
    <button class="button1" onclick="openForm(); change('<?php echo $data['id'] ?>')">Supprimer mon annonce</button>
<?php endif; ?>
<script>
    function openForm() {
        document.getElementById("MyForm").style.display = "block";
    }

    function change(value) {
        document.getElementById("idAnnounce").setAttribute('value', value);
    }

    function closeForm() {
        document.getElementById("MyForm").style.display = "none";
    }
</script>