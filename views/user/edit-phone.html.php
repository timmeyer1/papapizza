<h1 class="title main-panier">Modifier votre numéro de téléphone</h1>
<div class="account-edit">
    <div class="edit-old">
        <h2 class="sub-title-account">Ancien numéro:</h2>
        <h3 class="edit-donnees"><?= $user->phone ?></h3>
        </form>
    </div>

    <div>
        <img class="papapizza_arrow" src="/assets/images/homepage/papapizza_arrow.png" alt="fleche papapizza">
    </div>

    <div class="edit-new">
        <h2 class="sub-title-account">Nouveau numéro:</h2>
    <form class="edit-new" action="/account/edit-phone/<?php echo $user->id ?>" method="POST">
            <div class="box-auth-input">
                <input type="text" class="form-control" name="phone">
            </div>
            <button type="submit" class="call-action-success">✓ Valider</button>
        </form>
    </div>
</div>