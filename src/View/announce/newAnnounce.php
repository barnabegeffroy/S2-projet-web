<?php if (isset($data['errorInCreation'])) : ?>
  <span class="error-message"><?= $data['errorInCreation'] ?></span>
<?php endif; ?>
<form action="<?php echo isset($data['title']) ? "modifyAnnounce.php" : "addAnnounce.php" ?>" method="post">
  <div>
    <label for="titre">Titre :*</label>
    <input type="text" id="titre" name="titre" value="<?php echo isset($data['title']) ? $data['title'] : null ?>" required />
  </div>
  <div>
    <label for="duree">Durée de prêt maximum :</label>
    <input type="text" id="duree" name="duree" value="<?php echo isset($data['duree']) ? $data['duree'] : null ?>"/>
  </div>
  <div>
    <label for="description">Description :</label>
    <input type="text" id="description" name="description" value="<?php echo isset($data['description']) ? $data['description'] : null ?>"/>
  </div>
  <div>
    <label for="lieu">Lieu :</label>
    <input type="text" id="lieu" name="lieu" value="<?php echo isset($data['lieu']) ? $data['lieu'] : null ?>"/>
  </div>
  <button type="submit">Valider</button>
</form>