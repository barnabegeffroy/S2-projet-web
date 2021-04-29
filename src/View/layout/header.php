<div class="navbar bg-light navbar-light narbar-expand-lg">
    <div class="container">
        <a href="index.php" class="navbar-brand"><img src="../src/View/images/logo.PNG" alt="Accueil" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div>
                <form method="GET" action="search.php">
                    <input type="search" name="q" placeholder="Rechercher un article" required />
                    <input class="button1" type="submit" value="Valider" />
                </form>
            </div>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if (!$authenticatorService->isAuthenticated()) : ?>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a href="signup.php" class="nav-link">S'inscrire</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a href="myFavs.php" class="nav-link">Mes favoris</a>
                    </li>
                    <li class="nav-item">
                        <a href="newAnnounce.php" class="nav-link">Ajouter une annonce</a>
                    </li>
                    <li class="nav-item">
                        <a href="myAnnounces.php" class="nav-link">Mes annonces</a>
                    </li>
                    <li class="nav-item">
                        <a href="myResas.php" class="nav-link">Mes réservations</a>
                    </li>
                    <li class="nav-item">
                        <a href="account.php" class="nav-link">Mon compte</a>
                    </li>
                    <li class="nav-item">
                        <a href="myLoans.php" class="nav-link">Mes entraiides</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Se déconnecter</a>
                    </li>
                <?php endif;
                if ($authenticatorService->isAdmin()) :
                ?>
                    <li class="nav-item">
                        <a href="users.php" class="nav-link">Espace Admin</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

</div>