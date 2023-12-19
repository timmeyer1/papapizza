<div class="">
    <h1 class="title admin-container">Mon compte</h1>

    <div class="account-main">
        <div class="box-infos">
            <h2 class="sub-title-account">Mes infos</h2>
            <div class="header-description">
                <p>
                    <a class="btn-edit-infos" href="/account/lastname/<?= $user_id ?>">
                        <i class="bi bi-pen"></i>
                    </a>
                    Nom: <span class="donnees"> <?php echo $user->lastname ?></span>
                </p>

                <p>
                    <a class="btn-edit-infos" href="/account/firstname/<?= $user_id ?>">
                        <i class="bi bi-pen"></i>
                    </a>
                    Prénom: <span class="donnees"> <?php echo $user->firstname ?></span>
                </p>

                <p>
                    <a class="btn-edit-infos" href="/account/phone/<?= $user_id ?>">
                        <i class="bi bi-pen"></i>
                    </a>
                    Numéro de téléphone: <span class="donnees"> <?php echo $user->phone ?></span>
                </p>

                <p>
                    <a class="btn-edit-infos" href="/account/address/<?= $user_id ?>">
                        <i class="bi bi-pen"></i>
                    </a>
                    Adresse: <span class="donnees"> <?php echo $user->address ?></span>
                </p>
            </div>
        </div>


        <div class="box-parametres">
            <h2 class="sub-title-account">Votre compte</h2>
            <a class="call-action" href="/account/your-pizzas/<?= $user_id ?>"><i class="bi bi-circle"></i> Vos pizzas</a>
            <a class="call-action" href="/account/basket/<?= $user_id ?>"><i class="bi bi-cart2"></i> Votre panier</a>
            <a class="call-action" href="/pizzas"><i class="bi bi-map"></i> La carte</a>
        </div>
    </div>
</div>