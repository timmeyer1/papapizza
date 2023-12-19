<?php

use Core\Session\Session; ?>
<div class="return-arrow-div"><a href="/admin/home"><i class="return-arrow bi bi-arrow-left-square-fill"></i></a></div>
<div class="admin-container">
    <h1 class="title">Les pizzas</h1>
    <!-- Boutton pour ajouter un nouveau membre -->
    <div class="admin-box-add">
        <a class="call-action" href="/admin/pizza/add">Ajouter une pizza</a>
    </div>

    <table class="table-pizza">
        <thead>
            <tr>
                <th class="footer-description">Nom</th>
                <th class="footer-description">Photo</th>
                <th class="footer-description">Prix</th>
                <th class="footer-description">Ingrédients</th>
                <th class="footer-description">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pizzas as $pizza) : ?>
                <tr>
                    <td class="footer-description"><?= $pizza->name ?></td>
                    <td class="footer-description">
                        <img class="image-pizza" src="/assets/images/pizza/<?= $pizza->image_path ?>" alt="<?= $pizza->name ?>">
                    </td>
                    <td class="footer-description">
                        <?php foreach ($pizza->prices as $price) : ?>
                            <p><?= $price->size->label ?> : <?= number_format($price->price, 2, ',', ' ') ?>€</p>
                        <?php endforeach ?>
                    </td>
                    <td class="footer-description">
                        <?php foreach ($pizza->ingredients as $ingredient) : ?>
                            <p><?= $ingredient->label ?></p>
                        <?php endforeach ?>
                    </td>
                    <td class="footer-description button-pizza">

                        <a onclick="return confirm('Êtes-vous certain de vouloir faire cette action ?')" class="button-delete" href="/admin/pizza/delete/<?= $pizza->id ?>">
                            <i class="bi bi-trash"></i>
                        </a>
                        <a class="button-edit" href="/admin/pizza/edit/<?= $pizza->id ?>">
                            <i class="bi bi-pen"></i>
                        </a>


                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>