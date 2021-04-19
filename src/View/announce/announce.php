<?php
$data = $announceRepository->getDataById($_POST['id']);
$user = $userRepository->getIdentity($data['idutilisateur']) ?>
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
<?php endif; ?>