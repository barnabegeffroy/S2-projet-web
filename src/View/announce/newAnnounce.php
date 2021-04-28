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
<div>
  <form action="<?php echo isset($data['titre']) ? "updateAnnounce.php" : "addAnnounce.php" ?>" method="post" enctype="multipart/form-data">
    <?php if (isset($data['id'])) : ?>
      <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
    <?php endif; ?>
    <div>
      <label for="titre">Titre :*</label>
      <input type="text" id="titre" name="titre" value="<?php echo isset($data['titre']) ? $data['titre'] : null ?>" required />
    </div>
    <div>
      <label for="duree">Durée de prêt maximale (en jours) :</label>
      <input type="number" id="duree" name="duree" min="1" value="<?php echo isset($data['duree']) ? $data['duree'] : null ?>" />
    </div>
    <div>
      <label for="description">Description :</label>
      <input type="text" id="description" name="description" value="<?php echo isset($data['description']) ? $data['description'] : null ?>" />
    </div>
    <div>
      <label for="cp">Adresse :</label>
      <input type="text" class="form-control" id="search_input" placeholder="Saisissez une adresse" />
    </div>
    <?php if (isset($data['photo']) ? !($data['photo'] == "f" ? false : true) : true) : ?>
      <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <label for="image">Image :</label>
        <input type="file" id="image" name="image" />
      </div>
    <?php endif; ?>
    <button type="submit">Valider</button>
  </form>
  <?php if (isset($data['photo']) ? ($data['photo'] == "f" ? false : true) : false) :
    $file = glob("../src/View/images/announces/" . $data['id'] . ".*"); ?>
    <div>
      <img src="<?php echo $file[0]; ?>" />
    </div>
    <form method="POST" action="deletePicture.php">
      <input type="hidden" name="filename" value="<?php echo $file[0] ?>">
      <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
      <button class="button1" type="submit">Supprimer l'image</button>
    </form>
    <form action="updatePicture.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="filename" value="<?php echo $file[0] ?>">
      <input type="hidden" name="idAnnounce" value="<?php echo $data['id'] ?>">
      <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
      <label for="image">Image :</label>
      <input type="file" id="newImage" name="newImage" />
      <button class="button1" type="submit">Changer l'image</button>
    </form>
  <?php endif; ?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../src/assets/scripts/autocompletion.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDabmvz7QF2a2kqCvs-yZjN-Uu54Ao3zbQ"></script>