<div class="main-panier">
    <h1 class="title">Votre panier</h1>
    <h2 class="sub-title-panier">Élément(s) dans votre commande: </h2>
</div>

<div class="admin-container">
    <!-- Boutton pour ajouter un nouveau membre -->
    <a class="call-action" href="/pizzas">Ajouter une pizza</a>

    <table class="table-user">
        <thead>
            <tr>
                <th class="footer-description">Pizza</th>
                <th class="footer-description">Prix</th>
                <th class="footer-description">Quantité</th>
                <th class="footer-description">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pizzas as $pizza) : ?>
                <tr>
                    <td class="footer-description"><?= $pizza->name ?></td>
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
                        <a onclick="return confirm('Êtes-vous certain de vouloir faire cette action ?')" class="button-delete" href="">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-5"><a class="call-action-success" href="/account/basket">✓ Passer commande</a></div>

</div>