<form action="addUser.php" method="post">
  <div>
    <label for="prenom">Prénom :*</label>
    <input type="text" id="prenom" name="prenom" required />
  </div>
  <div>
    <label for="pseudo">Pseudo :</label>
    <input type="text" id="pseudo" name="pseudo" />
  </div>
  <div>
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required />
  </div>
  <div>
    <label for="email">Email :*</label>
    <input type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required />
    <?php if (isset($data['userAlreadyExist'])) : ?>
      <span class="error-message"><?= $data['userAlreadyExist'] ?></span>
    <?php endif; ?>
  </div>
  <div>
    <label for="telephone">Numéro de téléphone:*</label>
    <input type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" required>
    <small>Format: 0612345678</small>
  </div>
  <div>
    <label>Mot de passe :*</label>
    <input type="password" name="password" required />
  </div>
  <div>
    <label>Vérification du mot de passe :*</label>
    <input type="password" name="password_verify" required />
    <?php if (isset($data['passwordDoesNotMatch'])) : ?>
      <span class="error-message"><?= $data['passwordDoesNotMatch'] ?></span>
    <?php endif; ?>
  </div>
  <button type="submit">Valider</button>
</form>