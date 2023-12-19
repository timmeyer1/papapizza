<h1 class="title main-panier">Modifier le nom de la pizza</h1>
<div class="account-edit">
    <div class="edit-old">
        <h2 class="sub-title-account">Ancien nom:</h2>
        <h3 class="edit-donnees"><?= $pizza_id->name ?></h3>
    </div>

    <div>
        <img class="papapizza_arrow" src="/assets/images/homepage/papapizza_arrow.png" alt="fleche papapizza">
    </div>

    <div class="edit-new">
        <h2 class="sub-title-account">Nouveau nom:</h2>
    <form class="edit-new" action="/admin/pizza/edit/name/form/<?php echo $pizza_id->id ?>" method="POST">
            <div class="box-auth-input">
                <input type="text" class="form-control" name="name">
            </div>
            <button type="submit" class="call-action-success">✓ Valider</button>
        </form>
    </div>
</div>