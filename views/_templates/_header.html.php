<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papa Pizza</title>
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- import de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- import du fichier style -->
    <link rel="stylesheet" href="/style_homepage.css">
    <link rel="stylesheet" href="/style_pizza.css">
    <link rel="stylesheet" href="/style_auth.css">
</head>

<body>
    <!-- si l'utilisateur n'est pas en session on redirige sur connexion -->
    <?php

    // use App\AppRepoManager;

    use Core\Session\Session;

    if ($auth::isAuth()) $user_id = Session::get(Session::USER)->id;

    // if (!$auth::isAuth()) $auth::redirect('/connexion') 
    ?>
    <div id="container">

        <header>
            <!-- topbar  -->
            <div id="topbar">
                <div class="line1">
                    <div class="box-phone">
                        <i class="bi bi-telephone"> 04 68 89 65 22</i>
                    </div>
                    <div class="box-social-icons">
                        <a href="#"><img class="social-icons" src="/assets/images/icon/facebook-fill.svg" alt="icone facebook"></a>
                        <a href="#"><img class="social-icons" src="/assets/images/icon/instagram.svg" alt="icone instagram"></a>
                        <a href="#"><img class="social-icons" src="/assets/images/icon/twitter.svg" alt="icone twitter"></a>
                    </div>
                </div>
                <div class="line2">
                    <div class="nav-logo">
                        <a href="/">
                            <img class="logo-papapizza" src="/assets/images/homepage/papapizza.svg" alt="logo papapizza">
                        </a>
                    </div>
                    <div class="nav-list">
                        <nav class="custom-nav">
                            <ul class="custom-ul">
                                <li class="custom-link btn-header-accueil"><a href="/">Accueil</a></li>
                                <li class="custom-link"><a href="/pizzas">Carte</a></li>
                                <li class="custom-link"><a href="/news">Actualités</a></li>
                                <li class="custom-link"><a href="/contact">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nav-profil">
                        <nav class="custom-nav-profil">
                            <ul class="custom-ul-profil">
                                <li class="custom-link-profil">
                                    <!-- si je suis en session, on affiche mon compte -->
                                    <?php if ($auth::isAuth()) : ?>

                                        <a href="/account/<?= $user_id ?>">Mon compte
                                            <img class="custom-svg" src="/assets/images/icon/user.svg" alt="icone utilisateur">
                                        </a>

                                    <?php else : ?>

                                        <a href="/connexion">Se connecter
                                            <img class="custom-svg" src="/assets/images/icon/user.svg" alt="icone utilisateur">
                                        </a>

                                    <?php endif ?>
                                </li>
                                <li class="custom-link-profil end-link">
                                    <?php if ($auth::isAuth() && $auth::isAdmin()) : ?>

                                        <a href="/admin/home">
                                            <img class="custom-svg" src="/assets/images/icon/admin.svg" alt="icone admin">
                                        </a>

                                    <?php else : ?>
                                        <?php if ($auth::isAuth()) : ?>
                                        <a href="/account/basket/">
                                            <img class="custom-svg" src="/assets/images/icon/cart.svg" alt="icone panier">
                                        </a>
                                        <?php endif ?>

                                    <?php endif ?>
                                </li>
                                <?php if ($auth::isAuth()) : ?>
                                    <li class="custom-link-profil end-link">
                                        <a class="logout" href="/logout"><i class="bi bi-box-arrow-left"></i></a>
                                    </li>

                                <?php endif ?>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- navbar  -->
        </header>