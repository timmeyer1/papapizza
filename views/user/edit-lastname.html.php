<div class="return-arrow-div"><a href="/account/<?php echo $user->id ?>"><i class="return-arrow bi bi-arrow-left-square-fill"></i></a></div>
<h1 class="title main-panier">Modifier votre nom</h1>
<div class="account-edit">
    <div class="edit-old">
        <h2 class="sub-title-account">Ancien nom:</h2>
        <h3 class="edit-donnees"><?= $user->lastname ?></h3>
        </form>
    </div>

    <div>
        <img class="papapizza_arrow" src="/assets/images/homepage/papapizza_arrow.png" alt="fleche papapizza">
    </div>

    <div class="edit-new">
        <h2 class="sub-title-account">Nouveau nom:</h2>
    <form class="edit-new" action="/account/edit-lastname/<?php echo $user->id ?>" method="POST">
            <div class="box-auth-input">
                <input type="text" class="form-control" name="lastname">
            </div>
            <input type="submit" class="call-action-success" value="✓ Valider">
        </form>
    </div>
</div>