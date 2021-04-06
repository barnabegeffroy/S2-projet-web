  <?php if (isset($data['errorInCreation'])) : ?>
    <span class="error-message"><?= $data['errorInCreation'] ?></span>
  <?php endif; ?>
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
    <label for="nom">Nom :*</label>
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
    <input type="password" id="password" name="password" required />
  </div>
  <div>
    <label>Vérification du mot de passe :*</label>
    <input type="password" name="password_verify" oninput="check(this)" required />
    <script language='javascript' type='text/javascript'>
      function check(input) {
        if (input.value != document.getElementById('password').value) {
          input.setCustomValidity('Les mots de passes ne sont pas identiques');
        } else {
          // input is valid -- reset the error message
          input.setCustomValidity('');
        }
      }
    </script>
  </div>
  <button type="submit">Valider</button>
</form>