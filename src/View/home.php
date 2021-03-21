<h1>Découvrez votre signe astrologique !</h1>

<?php
$erreur = !empty($_GET['erreur']) ? $_GET['erreur'] : null;
if (null != $erreur) : ?>
  <p class="error"><?php echo $erreur; ?></p>
<?php
endif; ?>

<form action="gestionSigne.php" method="post">
  <label for="prenom">Prénom :</label>
  <input type="text" id="prenom" name="prenom" required /><br>
  <label for="nom">Nom :</label>
  <input type="text" id="nom" name="nom" required /><br>
  <label for="email">Email :</label>
  <input type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required /><br>
  <label for="date">Date de naissance :</label>
  <input type="date" id="date" name="date" required  max="1970-01-01" /><br>
  <fieldset>
    <legend>Etes-vous un homme ou une femme?</legend>
    <label for="h">Homme</label>
    <input type="radio" id="h" value="h" name="sex" required><br>
    <label for="f">Femme</label>
    <input type="radio" id="f" value="f" name="sex" required><br>
    <label for="a">Autre</label>
    <input type="radio" id="a" value="a" name="sex" required><br>
  </fieldset>
  <button type="submit">Envoyer</button>
  <script src="../src/Assets/Script/script.js"></script>
</form>