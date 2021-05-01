<?php
if (!$authenticatorService->isAuthenticated()) {
  $error = "Vous devez vous connecter pour accéder à cette page";
  header('Location: index.php?erreur=' . $error);
  exit;
}
?>
<div class="col-5">
  <h4 class="text-dark text-center pt-4">Modifiez votre mot de passe.</h4>

  <form action="updatePassword.php" method="post">
    <div class="form-group">
      <div>
        <label class="form-label">Ancien mot de passe :</label>
        <input class="form-control" type="password" id="last_password" name="last_password" required />
      </div>
      <div>
        <label class="form-label">Nouveau mot de passe :</label>
        <input class="form-control" type="password" id="password" name="password" required />
      </div>
      <div>
        <label class="form-label">Vérification du mot de passe :</label>
        <input class="form-control" type="password" name="password_verify" oninput="check(this)" required />
      </div>
      <?php if (isset($data['failedPassword'])) : ?>
        <span class="error-message"><?= $data['failedPassword'] ?></span>
      <?php endif; ?>
      <button class="btn btn-outline-dark btn-md my-1" type="submit">Valider</button>
    </div>
  </form>
</div>