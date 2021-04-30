<div class="col-3">
  <h4 class="text-dark text-center pt-4">Entrez vos indentifiants.</h4>
  <form action="authenticate.php" method="post">
    <div class="form-group">
      <div>
        <label class="form-label" for="email">Email :</label>
        <input class="form-control" type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required />

      </div>
      <div>
        <label class="form-label">Mot de passe :</label>
        <input class="form-control" type="password" name="password" required />
      </div>
      <?php if (isset($data['failedAuthent'])) : ?>
        <span class="error-message"><?= $data['failedAuthent'] ?></span>
      <?php endif; ?>
      <button class="btn btn-outline-dark btn-md my-1" type="submit">Valider</button>
    </div>
  </form>
</div>