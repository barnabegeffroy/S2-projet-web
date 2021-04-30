<?php if (isset($data['errorInCreation'])) : ?>
  <span class="error-message"><?= $data['errorInCreation'] ?></span>
<?php endif; ?>
<div class="col-35>
  <h4 class="text-dark text-center pt-4">Entrez vos informations pour créer votre compte.</h4>
  <form action="addUser.php" method="post">
    <div class="form-group">
      <div>
        <label class="form-label" for="prenom">Prénom :*</label>
        <input class="form-control" type="text" id="prenom" name="prenom" required />
      </div>
      <div>
        <label class="form-label" for="pseudo">Pseudo :</label>
        <input class="form-control" type="text" id="pseudo" name="pseudo" />
      </div>
      <div>
        <label class="form-label" for="nom">Nom :*</label>
        <input class="form-control" type="text" id="nom" name="nom" required />
      </div>
      <div>
        <label class="form-label" for="email">Email :*</label>
        <input class="form-control" type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required />
        <?php if (isset($data['userAlreadyExist'])) : ?>
          <span class="error-message"><?= $data['userAlreadyExist'] ?></span>
        <?php endif; ?>
      </div>
      <div>
        <label class="form-label" for="telephone">Numéro de téléphone:*</label>
        <input class="form-control" type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" required>
        <small>Format: 0612345678</small>
      </div>
      <div>
        <label class="form-label">Mot de passe :*</label>
        <input class="form-control" type="password" id="password" name="password" required />
      </div>
      <div>
        <label class="form-label">Vérification du mot de passe :*</label>
        <input class="form-control" type="password" name="password_verify" oninput="check(this)" required />
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
      <button class="btn btn-outline-dark btn-md my-1" type="submit">Valider</button>
    </div>
  </form>
</div>