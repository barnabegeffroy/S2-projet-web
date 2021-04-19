<?php
if (!$authenticatorService->isAuthenticated()) {
  $error = "Vous devez vous connecter pour accéder à cette page";
  header('Location: index.php?erreur=' . $error);
  exit;
}
?>
<form action="updatePassword.php" method="post">
  <div>
    <label>Ancien mot de passe :</label>
    <input type="password" id="last_password" name="last_password" required />
  </div>
  <div>
    <label>Nouveau mot de passe :</label>
    <input type="password" id="password" name="password" required />
  </div>
  <div>
    <label>Vérification du mot de passe :</label>
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
  <?php if (isset($data['failedPassword'])) : ?>
    <span class="error-message"><?= $data['failedPassword'] ?></span>
  <?php endif; ?>
  <button type="submit">Valider</button>
</form>