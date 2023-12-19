<div class="return-arrow-div"><a href="/account/<?php echo $user->id ?>"><i class="return-arrow bi bi-arrow-left-square-fill"></i></a></div>
<h1 class="title main-panier">Modifier votre adresse</h1>
<div class="account-edit">
    <div class="edit-old">
        <h2 class="sub-title-account">Ancienne adresse:</h2>
        <h3 class="edit-donnees"><?php echo $user->address ?></h3>
        </form>
    </div>

    <div>
        <img class="papapizza_arrow" src="/assets/images/homepage/papapizza_arrow.png" alt="fleche papapizza">
    </div>

    <div class="edit-new">
        <h2 class="sub-title-account">Nouvelle adresse:</h2>
    <form class="edit-new" action="/account/edit-address/<?php echo $user->id ?>" method="POST">
            <div class="box-auth-input">
                <input type="text" class="form-control" name="address">
            </div>
            <button type="submit" class="call-action-success">✓ Valider</button>
        </form>
    </div>
</div>