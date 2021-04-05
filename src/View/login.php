<form action="authenticate.php" method="post">
  <div>
    <label for="email">Email :</label>
    <input type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required />

  </div>
  <div>
    <label>Mot de passe :</label>
    <input type="password" name="password" required />
  </div>
  <?php if (isset($data['failedAuthent'])) : ?>
    <span class="error-message"><?= $data['failedAuthent'] ?></span>
  <?php endif; ?>
  <button type="submit">Valider</button>
</form>