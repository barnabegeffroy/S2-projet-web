<div class="header">
    <div>
        <span class="logo-container"><a href="index.php"><img src="../src/View/images/logo.PNG" alt="Accueil" /></a>
        </span>
    </div>

    <ul>

        <div>
            <form method="GET" action="search.php">
                <input type="search" name="q" placeholder="Rechercher un article" />
                <input class="button1" type="submit" value="Valider" />
            </form>
        </div>

        <div>
            <form method="get">
                <script src="../../assets/scripts/places.js"></script>
                <input type="search" id="address-input" placeholder="Saisissez une ville" />
            </form>
        </div>

    </ul>
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
                <button class="button1" onclick="location.href = 'myFavs.php'">Mes favoris</button>
            </li>
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'newAnnounce.php'">Ajouter une annonce</button>
            </li>
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'myAnnounces.php'">Mes annonces</button>
            </li>
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'account.php'">Mon compte</button>
            </li>
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'logout.php'">Se déconnecter</button>
            </li>
        <?php endif;
        if ($authenticatorService->isAdmin()) :
        ?>
            <li class="link-header-item">
                <button class="button1" onclick="location.href = 'users.php'">fonctions Admin</button>
            </li>
        <?php endif; ?>
    </ul>
</div>