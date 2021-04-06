<?php if (isset($data['errorInCreation'])) : ?>
    <span class="error-message"><?= $data['errorInCreation'] ?></span>
  <?php endif; ?>
<form action="addAnnounce.php" method="post">
  <div>
    <label for="titre">Titre :*</label>
    <input type="text" id="titre" name="titre" required />
  </div>
  <div>
    <label for="duree">Durée de prêt maximum :</label>
    <input type="text" id="duree" name="duree" />
  </div>
  <div>
    <label for="description">Description :</label>
    <input type="text" id="description" name="description" required />
  </div>
  <div>
    <label for="lieu">Lieu :</label>
    <input type="text" id="lieu" name="lieu" required />
  </div>
  <button type="submit">Valider</button>
</form>