<?php

use App\AppRepoManager;
use Core\Session\Session; ?>

<div class="return-arrow-div"><a href="/admin/pizza/edit/<?php echo $pizza_id->id ?>"><i class="return-arrow bi bi-arrow-left-square-fill"></i></a></div>
<main class="container-form">
    <h1 class="title">Modifier la composition</h1>


    <form class="auth-form" action="/admin/pizza/edit/ingredient/form/{id}" method="POST" enctype="multipart/form-data">
        <div class="box-auth-input list-ingredient">
            <!-- on affiche la liste des ingredients -->
            <?php foreach (AppRepoManager::getRm()->getIngredientRepository()->getIngredientActive() as $ingredient) : ?>
                <div class="form-check form-switch list-ingredient-input">
                    <input value="<?= $ingredient->id ?>" class="form-check-input" type="checkbox" role="switch" name="ingredients[]">
                    <label for="ingredients" class="form-check-label footer-description m-1"><?= $ingredient->label ?></label>
                </div>
            <?php endforeach ?>
        </div>
        <button type="submit" class="call-action">Modifier la pizza</button>
    </form>

</main>