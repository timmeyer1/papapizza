<div class="return-arrow-div"><a href="/account/<?php echo $user->id ?>"><i class="return-arrow bi bi-arrow-left-square-fill"></i></a></div>
<div class="admin-container">
    <h1 class="title">Les clients</h1>

    <table class="table-user">
        <thead>
            <tr>
                <th class="footer-description">Nom</th>
                <th class="footer-description">Prénom</th>
                <th class="footer-description">Email</th>
                <th class="footer-description">Téléphone</th>
                <th class="footer-description">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td class="footer-description"><?= $user-> lastname ?></td>
                    <td class="footer-description"><?= $user-> firstname ?></td>
                    <td class="footer-description"><?= $user->email ?></td>
                    <td class="footer-description"><?= $user->phone ?></td>
                    <td class="footer-description">
                        <a onclick="return confirm('Êtes-vous certain de vouloir effectuer cette action ?')" class="button-delete" href="/admin/user/delete<?= $user->id ?>"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>