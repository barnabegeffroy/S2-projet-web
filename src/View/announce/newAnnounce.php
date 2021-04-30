<?php
if (!$authenticatorService->isAuthenticated()) {
  $error = "Vous devez vous connecter pour accéder à cette page";
  header('Location: index.php?erreur=' . $error);
  exit;
}

$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$announceHydrator = new \Rediite\Model\Hydrator\AnnounceHydrator();
$announceRepository = new \Rediite\Model\Repository\AnnounceRepository($dbAdapter, $announceHydrator);
$announceService = new \Rediite\Model\Service\AnnounceService($announceRepository);
if (!empty($_POST['idAnnounce'])) {
  $data = $announceRepository->getDataById($_POST['idAnnounce']);
}
if (isset($data['errorInCreation'])) : ?>
  <span class="error-message"><?= $data['errorInCreation'] ?></span>
<?php endif; ?>
<div class="col-3">
  <h4 class="text-dark text-center pt-4">Entrez les informations de votre annonce.</h4>

  <form action="<?php echo isset($data['titre']) ? "updateAnnounce.php" : "addAnnounce.php" ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <?php if (isset($data['id'])) : ?>
        <input class="form-control" type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
      <?php endif; ?>
      <div>
        <label class="form-label" for="titre">Titre :*</label>
        <input class="form-control" type="text" id="titre" name="titre" value="<?php echo isset($data['titre']) ? $data['titre'] : null ?>" required />
      </div>
      <div>
        <label class="form-label" for="duree">Durée de prêt maximale (en jours) :</label>
        <input class="form-control" type="number" id="duree" name="duree" min="1" value="<?php echo isset($data['duree']) ? $data['duree'] : null ?>" />
      </div>
      <div>
        <label class="form-label" for="description">Description :</label>
        <input class="form-control" type="text" id="description" name="description" value="<?php echo isset($data['description']) ? $data['description'] : null ?>" />
      </div>
      <div>
        <label class="form-label" for="cp">Adresse :</label>
        <input class="form-control" type="text" class="form-control" id="search_input" placeholder="Saisissez une adresse" />
      </div>
      <?php if ((isset($data['photo']) && $data['photo'] == "f") || !isset($data['photo'])) : ?>
        <div>
          <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
          <label class="form-label" for="image">Image :</label>
          <input class="form-control" type="file" id="image" name="image" />
        </div>
      <?php endif; ?>
      <button class="btn btn-outline-dark btn-md my-1" type="submit">Valider</button>
    </div>
  </form>
  <?php if (isset($data['photo']) && $data['photo'] !== "f") :
    $file = glob("../src/View/images/announces/" . $data['id'] . ".*");?>
    <div>
      <img src="<?php echo $file[0]; ?>" />
    </div>
    <form method="POST" action="deletePicture.php">
      <div class="form-group">
        <input type="hidden" name="filename" value="<?php echo $file[0] ?>">
        <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
        <button class="btn btn-outline-dark btn-md my-1" type="submit">Supprimer l'image</button>
      </div>
    </form>
    <form action="updatePicture.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <input type="hidden" name="filename" value="<?php echo $file[0] ?>">
        <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <label class="form-label" for="image">Image :</label>
        <input class="custom-file-input" type="file" id="newImage" name="newImage" />
        <button class="btn btn-outline-dark btn-md my-1" type="submit">Changer l'image</button>
      </div>
    </form>
  <?php endif; ?>
</div>