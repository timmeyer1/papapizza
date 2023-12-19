<?php

use App\AppRepoManager;
use Core\Session\Session; ?>


<main class="container-form">
    <h1 class="title">Nouvelle pizza</h1>
    <!-- on va afficher les erreurs s'il y en a -->
    <?php if ($form_result && $form_result->hasErrors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $form_result->getErrors()[0]->getMessage() ?>
        </div>
    <?php endif ?>
    <?php Session::remove(Session::FORM_RESULT); ?>


    <form class="auth-form" action="/pizza/create/form/<?php echo $user->id ?>" method="POST" enctype="multipart/form-data">
        <!-- on ajoute un input de type hidden pour envoyer l'id de l'utilisateur en session -->
        <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">

        <div class="box-auth-input">
            <label class="detail-description">Nom de ma pizza:</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="box-auth-input">
            <label class="detail-description">Mettez une image d'illustration</label>
            <input type="file" class="form-control" name="image_path">
        </div>
            <p class="text-footer">Choisissez vos ingrédients !</p>
            <p class="warning-ingredient">⚠️ Limite de 6 ingrédients.</p>
        <div class="box-auth-input list-ingredient">
            <!-- on affiche la liste des ingredients -->
            <?php foreach (AppRepoManager::getRm()->getIngredientRepository()->getIngredientActive() as $ingredient) : ?>
                <div class="form-check form-switch list-ingredient-input">
                    <input value="<?= $ingredient->id ?>" class="form-check-input" type="checkbox" role="switch" name="ingredients[]">
                    <label for="ingredients" class="form-check-label footer-description m-1"><?= $ingredient->label ?></label>
                </div>
            <?php endforeach ?>
        </div>
        <button type="submit" class="call-action">Créer ma pizza</button>
    </form>

</main>