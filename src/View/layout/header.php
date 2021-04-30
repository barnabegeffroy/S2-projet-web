<nav class="navbar-fixed-top navbar bg-light navbar-expand-xl navbar-light">
    <div class="container">
        <a href="index.php" class="navbar-brand"><img src="../src/View/images/logo.PNG" alt="Accueil" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <form class="navbar-form form-inline" method="GET" action="search.php">
                <div class="input-group search-box">
                    <div class="form-outline">
                        <input type="search" name="q" class="form-control" placeholder="Rechercher un article" />
                    </div>
                    <button type="button" class="btn btn-outline-dark btn-md my-1">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>

            <ul class="navbar-nav ml-auto">
                <?php if (!$authenticatorService->isAuthenticated()) : ?>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">
                            <i class="fa fa-sign-in"></i><span>Se connecter</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="signup.php" class="nav-link">
                            <i class="fa fa-user-plus"></i><span>S'inscrire</span></a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a href="chat.php" class="nav-link">
                            <i class="fa fa-envelope"></i><span>Messagerie</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="newAnnounce.php" class="nav-link">
                            <i class="fa fa-plus"></i><span>Ajouter une annonce</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action">Espace utilisateur<b class="caret"></b></a>
                        <div class="dropdown-menu">
                            <a href="account.php" class="dropdown-item">
                                <i class="fa fa-user-o"></i> Mon compte</a>
                            <a href="myFavs.php" class="dropdown-item">
                                <i class="fa fa-heart"></i><span> Mes favoris</span></a>
                            <a href="myAnnounces.php" class="dropdown-item">
                                <i class="fa fa-folder-open"></i> Mes annonces</a>
                            <a href="myLoans.php" class="dropdown-item">
                                <i class="fa fa-handshake-o"></i> Mes entraiides</a>
                            <a href="myResas.php" class="dropdown-item">
                                <i class="fa fa-calendar-check-o"></i> Mes réservations</a>
                            <div class="divider dropdown-divider"></div>
                            <?php if ($authenticatorService->isAdmin()) : ?>
                                <a href="users.php" class="dropdown-item">
                                    <i class="fa fa-cogs"></i> Espace Admin</a>
                            <?php endif; ?>
                            <a href="logout.php" class="dropdown-item">
                                <i class="fa fa-sign-out"></i> Se déconnecter</a>
                        </div>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>

</nav>