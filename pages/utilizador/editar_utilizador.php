<?php
require_once '../../config.php';
require_once APP_PAGES . 'partials/header.php';
require_once APP_PAGES . 'partials/navbar.php';
require_once APP_CLASSES . 'Utilizador.php';

if (Utilizador::tryGetByID(getInput('id', 0), $utilizador)) :
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                    <h5>Utilizador: <?= $utilizador->getUsername(); ?></h5>
            </div>
        </div>
    </div>
<?php
else: ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h1>Utilizador inexistente</h1>

                <a href="<?= pageServer()->listUtilizadores() ?>">...voltar à lista de utilizadores</a>
            </div>
        </div>
    </div>

<?php
endif;

require_once APP_PAGES . 'partials/footer.php';
?>