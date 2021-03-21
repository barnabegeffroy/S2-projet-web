<h1>Résultat </h1>

<div class="person-container">
  <div class="person-item">
    <p>
      Bonjour <?php echo $data->getFirstName(); ?> <?php echo $data->getLastName(); ?>
    </p>
    <p>
      Voici votre signe astrologique : <strong><?php echo $data->getZodiacSign(); ?></strong>
    </p>
    <!-- Afficher l'horoscope -->
    <div class="horoscope">
      <p>Voici votre horoscope : </p>
      <strong><?php include 'horoscope/' . $data->getZodiacSign() . '.txt' ?></strong>
    </div>

    <?php
    // Récupérer le nombre de personnes du même signe
    $sql =
      <<<SQL
    SELECT COUNT(element)
      FROM astro_signe A JOIN astro_personne B ON A.nom_signe_astro=B.nom_signe_astro
      WHERE B.nom_signe_astro=:sign ;
SQL;
    $stmt = $dbAdapter->prepare($sql);
    $stmt->bindValue(':sign', $data->getZodiacSign(), \PDO::PARAM_STR);
    $stmt->execute();
    $number = $stmt->fetch()['count'];

    // Récupérer l'élément lié au signe de la personne
    $sql =
      <<<SQL
    SELECT element FROM astro_signe WHERE nom_signe_astro =:sign ;
SQL;
    $stmt = $dbAdapter->prepare($sql);
    $stmt->bindValue(':sign', $data->getZodiacSign(), \PDO::PARAM_STR);
    $stmt->execute();
    $element = $stmt->fetch()['element'];
    ?>
    <p>
      Félicitations! Vous êtes la <?php echo $number ?>ème personne de type <strong><?php echo $element ?></strong> à vous être inscrit !
    </p>
  </div>
</div>

<?php
//envoie d'un mail à l'utilisateur pour le remercier
$to      = $data->getEMail();
$subject = 'Merci !';
$message = 'Merci d\'avoir participer à notre formulaire ! Nous espérons vous revoir très vite sur notre site http://pgsql.pedago.ensiie.fr/~barnabe.geffroy/mini-projet/public/ :)';
$headers = 'From: no-reply@astrologiie.ensiie' . "\r\n" .
  'Reply-To: no-reply@astrologiie.ensiie' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>