<?php
require_once '../../config.php';

require_once PAGE_HEADER;
require_once PAGE_NAVBAR;
require_once APP_CLASSES . 'Utilizador.php';

$users = Utilizador::lista();

?>

<div class="container">

    <div class="row">
        <div class="col">
            listar utilizadores
            <br>
            <a href="https://generatedata.com/generator">link para gerar dados</a>
        </div>
    </div>

</div>

<?php
require_once PAGE_FOOTER;
?>
