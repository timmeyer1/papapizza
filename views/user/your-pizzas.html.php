<div class="main-panier">
    <h1 class="title">Vos création(s):</h1>
    <a class="call-action" href="/pizza/create/<?= $user->id ?>">+ Nouvelle pizza</a>
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

                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>