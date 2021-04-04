<div class="header">
    <div>
        <span class="logo-container"><a href="index.php"><img src="../src/View/images/logo.PNG" alt="Accueil" /></a>
        </span>
    </div>
    <div>
        <form method="GET">
            <input type="search" name="q" placeholder="Rechercher un article" />
            <input class="button1" type="submit" value="Valider" />
        </form>
    </div>
    <ul class="link-header-container">

        <?php if (!$authenticatorService->isAuthenticated()) : ?>
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'login.php'">Se connecter</button>
            </li>
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'signup.php'">S'inscrire</button>
            </li>
        <?php else : ?>
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'logout.php'">Se déconnecter</button>
            </li>
        <?php endif; ?>
        <li class="link-header-item">
            <button class="button1" onclick="location.href = 'about.php'">À propos de nous</button>
        </li>
    </ul>
</div>

<?php


// create the database connection
$dbfactory = new \Rediite\Model\Factory\dbFactory();
$bdd = $dbfactory->createService();
$articles = $bdd->query('SELECT * FROM Annonce ORDER BY id DESC');
/*On peut ici $q_array = explode(' ', $q);
et faire une recherche sur $q_array, trié du plus long mot au plus court (on enlève l'obligation que les mots soient concaténés)*/
/*On regarde si q est defini et non vide */
if (isset($_GET['q']) and !empty($_GET['q'])) {
    $q = htmlspecialchars($_GET['q']);
    $articles = $bdd->query('SELECT * FROM Annonce WHERE nom LIKE "%' . $q . '%" ORDER BY id DESC');

    /* Si on trouve rien en cherchant dans le tire, on cherche dans la description de l'annonce*/
    if ($articles->rowCount() == 0) {
        $articles = $bdd->query('SELECT * FROM Annonce WHERE CONCAT(nom,contenu) LIKE "%' . $q . '%" ORDER BY id DESC');
    }
}

/*Si aucun résultat n'est trouvé, on affiche aucun résultat*/ elseif (isset($_GET['q'])) { ?>
    <div class="recherche_fail">
        Aucun résultat pour : "<?php echo $_GET['q'] ?>"
        <div>
        <?php
    }
        ?>