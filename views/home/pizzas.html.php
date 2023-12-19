<?php
use Core\Session\Session;
?>
<h1 class="title title-page">Notre carte</h1>
<div class="d-flex justify-content-center">
    <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-lg-10">
        <?php foreach ($pizzas as $pizza) : ?>
            <div class="card m-2" style="width: 18rem;">
                <a href="/pizzas/<?= $pizza->id ?>">
                    <img class="card-img-top img-fluid pizza-img" src="/assets/images/pizza/<?= $pizza->image_path ?>" alt="<?= $pizza->name ?>">
                </a>
                <div class="card-body">
                    <h3 class="card-title sub-title text-center"><?= $pizza->name ?></h3>
                </div>
                <!-- <a class="d-flex justify-content-center call-action-info" href="/account/basket/form">Ajouter au panier</a> -->
            </div>


        <?php endforeach ?>
    </div>
</div>

<div class="d-flex flex-column justify-content-center align-items-center">
    <h2 class="sub-title-account">Pas convaincu ?</h2>
    <h2 class="sub-title-account">Faites votre propre pizza !</h2>
    <h3 class="sub-title">Disponible dans votre compte</h3>
</div>