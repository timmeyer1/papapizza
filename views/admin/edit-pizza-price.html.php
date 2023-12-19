<?php
use App\AppRepoManager;
use Core\Session\Session; ?>
 
 
<main class="container-form">
    <h1 class="title">Modifier le prix</h1>
 
    <form class="auth-form" action="/admin/pizza/edit/price/form/<?php echo $pizza->id ?>" method="POST" enctype="multipart/form-data">
        <!-- on ajoute un input de type hidden pour envoyer l'id de l'utilisateur en session -->
        <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">

        <div class="box-auth-input list-size">
            <label class="header-description">Prix par taille</label>
            <?php foreach ($pizza->prices as $size) : ?>
                <div class="list-size-input">
                    <input type="hidden" name="size_id[]" value="<?= $size->size->id ?>">
                    <label class="footer-description"> <?= $size->size->label ?></label>
                    <input type="number" step="0.01" class="form-control" name="price[]" value="<?php echo $size->price ?>">
                </div>
            <?php endforeach ?>
        </div>
        <button type="submit" class="call-action">Créer la pizza</button>
    </form>
 
</main>