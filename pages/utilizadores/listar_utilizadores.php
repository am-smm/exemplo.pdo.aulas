<?php
require_once '../../config.php';

require_once PAGE_HEADER;
require_once PAGE_NAVBAR;
require_once APP_CLASSES . 'Utilizador.php';
require_once APP_CLASSES . 'BD.php';

$users = Utilizador::todos();

?>

<div class="container">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Apelido</th>
            <th>Email</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        /** @var Utilizador $u */
        foreach ($users as $u):
            $link = PAGES_URL . "utilizadores/ver_utilizador.php?id=".$u->getId();
            ?>
            <tr>
                <td><?= $u->getNome() ?></td>
                <td><?= $u->getApelido() ?></td>
                <td><?= $u->getEmail() ?></td>
                <td><a href='<?= $link ?>'>Ver</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php
require_once PAGE_FOOTER;
?>
