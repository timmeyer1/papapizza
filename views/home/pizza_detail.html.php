<?php use Core\Session\Session;
?>
<div class="return-arrow-div"><a href="/pizzas"><i class="return-arrow bi bi-arrow-left-square-fill"></i></a></div>
<h1 class="title title-detail"><?= $pizza->name ?></h1>
<div class="container-pizza-detail">
    <div class="box-image-detail">
        <img class="image-detail" src="/assets/images/pizza/<?= $pizza->image_path ?>" alt="image de la pizza <?= $pizza->name ?>">
        <div class="allergene">
            <?php if (in_array(true, array_column($pizza->ingredients, 'is_allergic'))) : ?>
                <h3 class="sub-title-allergene">Allergènes:</h3>
                <!-- j'affiche le label de l'ingrédient -->
                <?php foreach ($pizza->ingredients as $ingredient) : ?>
                    <?php if ($ingredient->is_allergic) : ?>
                        <div>
                            <span class="badge text-bg-danger"><?= $ingredient->label ?></span>
                        </div>

                    <?php endif ?>
                <?php endforeach ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="info-pizza-detail">
        <h3 class="sub-title sub-title-detail">Ingrédients:</h3>
        <div class="box-ingredient-detail">
            <?php foreach ($pizza->ingredients as $ingredient) : ?>
                <p class="detail-description">• <?= $ingredient->label ?></p>
            <?php endforeach; ?>
        </div>
        <h3 class="sub-title sub-title-detail">Nos prix:</h3>
        <table>
            <thead>
                <tr>
                    <th class="footer-description">Taille</th>
                    <th class="footer-description">Prix</th>
                    <th class="footer-description"><i class="bi bi-basket"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pizza->prices as $price) : ?>
                    <tr>
                        <td class="footer-description"><?= $price->size->label ?></td>
                        <td class="footer-description"><?= number_format($price->price, 2, ',', ' ') ?>€</td>
                        <td class="footer-description">
                            <form method="post" action="/account/basket/form">
                                <!-- <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id  ?>"> -->
                                <input type="hidden" name="price" value="<?= $price->price  ?>">
                                <input type="hidden" name="pizza_id" value="<?= $pizza->id ?>">
                                <input type="number" name="quantity" value=1 min=1 max=5>
                                <button class="call-action" type="submit"><i class="bi bi-plus-circle"></i></button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>