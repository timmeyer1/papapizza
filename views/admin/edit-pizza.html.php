<div class="return-arrow-div"><a href="/admin/pizza/list"><i class="return-arrow bi bi-arrow-left-square-fill"></i></a></div>
<div class="main-edit-pizza">
    <h1 class="title admin-container">Édition de la pizza</h1>

    <table class="table-pizza">
        <tr>
            <th class="footer-description">Nom</th>
            <th class="footer-description">Photo</th>
            <th class="footer-description">Prix</th>
            <th class="footer-description">Ingrédients</th>
        </tr>
        <tr>
            <td class="footer-description"><?= $pizza_id->name ?></td>
            <td class="footer-description">
                <img class="image-pizza" src="/assets/images/pizza/<?= $pizza_id->image_path ?>" alt="<?= $pizza_id->name ?>">
            </td>
            <td class="footer-description">
                <?php foreach ($pizza_id->prices as $price) : ?>
                    <p><?= $price->size->label ?> : <?= number_format($price->price, 2, ',', ' ') ?>€</p>
                <?php endforeach ?>
            </td>
            <td class="footer-description">
                <?php foreach ($pizza_id->ingredients as $ingredient) : ?>
                    <p><?= $ingredient->label ?></p>
                <?php endforeach ?>
            </td>
        </tr>
    </table>


    <h2 class="sub-title-pizza-name admin-container">Pizza: <span class="name-pizza"><?= $pizza_id->name ?></span></h2>
    <h2 class="sub-title-edit-pizza">Que souhaitez-vous modifier ?</h2>

    <div class="edit-pizza-btn">
        <div class="box-btn edit-pizza-name">
            <a class="call-action" href="/admin/pizza/edit/name/<?= $pizza_id->id ?>"><i class="bi bi-pen"></i> Le nom</a>
        </div>
        <div class="box-btn edit-pizza-image">
            <a class="call-action" href="/admin/pizza/edit/image/<?= $pizza_id->id ?>"><i class="bi bi-pen"></i> L'image</a>
        </div>
    </div>


    <div class="edit-pizza-btn">
        <div class="box-btn edit-pizza-ingredient">
            <a class="call-action" href="/admin/pizza/edit/ingredient/<?= $pizza_id->id ?>"><i class="bi bi-pen"></i> La composition</a>
        </div>
        <div class="box-btn edit-pizza-price">
            <a class="call-action" href="/admin/pizza/edit/price/<?= $pizza_id->id ?>"><i class="bi bi-pen"></i> Le prix par taille</a>
        </div>
    </div>
</div>