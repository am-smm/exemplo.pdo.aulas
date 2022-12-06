<?php
require_once '../../config.php';
require_once APP_PAGES . 'partials/header.php';
require_once APP_PAGES . 'partials/navbar.php';
require_once APP_CLASSES . 'Utilizador.php';

function showNaoExiste() {
    $link = pageServer()->listUtilizadores();
    $html = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h5>Utilizador inexistente</h5>
                <br>
                <a href="$link">...voltar à lista de utilizadores</a>
            </div>
        </div>
    </div>
HTML;
    echo $html;
}

function showNaoPodeSerRemovido($utilizador, $erros) {
    $username = $utilizador->getUsername();
    $listaMsgsErro = '';
    foreach ($erros as $err) $listaMsgsErro .= "<li>$err</li>";
    $link = pageServer()->listUtilizadores();

    $html = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h5>O utilizador <strong>$username</strong> não pode ser removido.</h5>
                 <br>
                 <ul>$listaMsgsErro</ul>
                 <br>
                <a href="$link">...voltar à lista de utilizadores</a>
            </div>
        </div>
    </div>
HTML;
    echo $html;
}

function showConfirmado($utilizador) {
    $username = $utilizador->getUsername();
    $link = pageServer()->listUtilizadores();
    $utilizador->delete();

    $html = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h5>O utilizador <strong>$username</strong> removido!</h5>
                 <br>
                <a href="$link">...voltar à lista de utilizadores</a>
            </div>
        </div>
    </div>
HTML;
    echo $html;
}

function showConfirmadoComRedirect($utilizador) {
    $username = $utilizador->getUsername();
    $link = pageServer()->listUtilizadores();
    $utilizador->delete();

    $html = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h5>O utilizador <strong>$username</strong> foi removido!</h5>
                <br>
                <script>
setTimeout(() => {
window.location.replace("$link");
}, 2000) // 2 segundos
                </script>  
            </div>
        </div>
    </div>
HTML;
    echo $html;
}

function showConfirmaRemocao($utilizador) {
    $username = $utilizador->getUsername();
    $utilizador_id = $utilizador->getId();
    $action = pageServer()->removerUtilizador($utilizador_id);
    $linkCancelar = pageServer()->listUtilizadores();
    $html = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h5>Confirma a remoção do utilizador <strong>$username</strong>?</h5>
                    
                <div class="row">
                    <div class="col">
                        <form action="$action" method="post">
                            <button type="submit" 
                                    name="op_confirmar" value="$utilizador_id"
                                    class="btn btn-sm btn-danger">Confirmar
                            </button>
                        </form>
                    </div>
                    <div class="col">
                        <a href="$linkCancelar"
                           class="btn btn-light">Cancelar</a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
HTML;
    echo $html;
}


if ( !Utilizador::tryGetByID(getInput('id', 0), $utilizador)) showNaoExiste();
elseif ( !$utilizador->podeSerRemovido($erros)) showNaoPodeSerRemovido($utilizador, $erros);
else {
    $confirmado = getInput('op_confirmar', 0);
    if ($confirmado == $utilizador->getId()) showConfirmadoComRedirect($utilizador); // OU showConfirmado($utilizador);
    else showConfirmaRemocao($utilizador);
}

require_once APP_PAGES . 'partials/footer.php';
