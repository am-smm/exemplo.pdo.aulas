<?php
require_once '../../config.php';

require_once PAGE_HEADER;
require_once PAGE_NAVBAR;
require_once APP_CLASSES . 'Utilizador.php';
// obter parâmetro GET
$id = getInput('id', 0);
/** @var Utilizador $user */
$has_user = Utilizador::tryGetById($id, $user);
?>

<div class="container">
    <div class="row">
        <div class="col">
            <?php
            if ($has_user): ?>
                <h5>Utilizador</h5>
                <hr>
                <p><?= $user->getNome() ?></p>
            <?php
            else: ?>
                <div class="alert alert-danger">
                    <p>Utilizador inexistente!</p>
                    <p><a href="<?= WEBROOT . 'index.php' ?>">Home...</a></p>
                </div>
            <?php
            endif; ?>
        </div>
    </div>
</div>

<?php
require_once PAGE_FOOTER;
?>
