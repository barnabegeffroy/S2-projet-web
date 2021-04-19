<?php
$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);
$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);

if (!$authenticatorService->isAuthenticated()) {
  $error = "Vous devez vous connecter pour accéder à cette page";
  header('Location: index.php?erreur=' . $error);
  exit;
}
if (!empty($_POST['idAnnounce'])) {
  $data = $announceRepository->getDataById($_POST['idAnnounce']);
}
if (isset($data['errorInCreation'])) : ?>
  <span class="error-message"><?= $data['errorInCreation'] ?></span>
<?php endif; ?>
<form action="<?php echo isset($data['titre']) ? "updateAnnounce.php" : "addAnnounce.php" ?>" method="post" enctype="multipart/form-data">
  <?php if (isset($data['idAnnounce'])) : ?>
    <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
  <?php endif; ?>
  <div>
    <label for="titre">Titre :*</label>
    <input type="text" id="titre" name="titre" value="<?php echo isset($data['titre']) ? $data['titre'] : null ?>" required />
  </div>
  <div>
    <label for="duree">Durée de prêt maximum :</label>
    <input type="text" id="duree" name="duree" value="<?php echo isset($data['duree']) ? $data['duree'] : null ?>" />
  </div>
  <div>
    <label for="description">Description :</label>
    <input type="text" id="description" name="description" value="<?php echo isset($data['description']) ? $data['description'] : null ?>" />
  </div>
  <div>
    <label for="cp">Adresse :</label>
    <input name="cp" id="cp" type="text" placeholder="CP">
    <input name="ville" id="ville" type="text" placeholder="Ville" required>
    <input name="adresse" id="adresse" type="text" placeholder="Adresse">
    <input name="coordonnees" id="coordonnees" type="hidden">
  </div>
  <?php if (!isset($data['image'])) : ?>
    <div>
      <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
      <label for="image">Image :</label>
      <input type="file" id="image" name="image" />
    </div>
  <?php endif; ?>
  <button type="submit">Valider</button>
</form>
<?php if (isset($data['image'])) :
  $file = glob("../src/View/images/announces/" . $data['id'] . ".*"); ?>
  <div>
    <img src="<?php echo $file[0]; ?>" />
  </div>
  <form method="POST">
    <button class="button1" name="delete" type="submit" value="Supprimer l'image">
  </form>
  <?php
  if (isset($_POST['delete'])) {
    $announceRepository->changePhoto($data['id'], false);
    unlink($file[0]);
  }
  ?>
  </div>
  <form action="updatePicture.php" method="POST">
    <input type="hidden" id="filename" value="<?php echo $file[0] ?>">
    <input type="hidden" id="id" value="<?php echo $data['id'] ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
    <label for="image">Image :</label>
    <input type="file" id="image" name="image" />
    <button class="button1" type="submit">Changer l'image</button>
  </form>
<?php endif; ?>

<script src="../src/assets/scripts/autocompletion.js"></script>