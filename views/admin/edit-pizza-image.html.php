<h1 class="title main-panier">Modifier l'image de la pizza</h1>
<div class="account-edit">
    <div class="edit-old">
        <h2 class="sub-title-account">Ancienne image:</h2>
        <h3 class="edit-donnees"><img class="image-pizza" src="/assets/images/pizza/<?= $pizza_id->image_path ?>" alt="<?= $pizza_id->name ?>"></h3>
    </div>

    <div>
        <img class="papapizza_arrow" src="/assets/images/homepage/papapizza_arrow.png" alt="fleche papapizza">
    </div>

    <div class="edit-new">
        <h2 class="sub-title-account">Nouvelle image:</h2>
        <form class="edit-new" action="/admin/pizza/edit/image/form/<?php echo $pizza_id->id ?>" method="POST" enctype="multipart/form-data">
            <div class="box-auth-input">
                <input type="file" class="form-control" name="image_path">
            </div>
            <button type="submit" class="call-action-success">✓ Valider</button>
        </form>
    </div>
</div>