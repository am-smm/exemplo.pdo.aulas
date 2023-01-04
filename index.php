<?php
require_once 'config.php';
require_once APP_CLASSES . 'Utilizador.php';

require_once PAGE_HEADER;
require_once PAGE_NAVBAR;

$u = new Utilizador();

d($u);


?>

<div class="container">

    <div class="row">
        <div class="col">
            Coluna 1
        </div>
        <div class="col">
            Coluna 2
        </div>
        <div class="col">
            Coluna 3
        </div>
    </div>

</div>

<?php
require_once PAGE_FOOTER;
?>
