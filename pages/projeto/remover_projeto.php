<?php
require_once '../../config.php';
require_once APP_PAGES . 'partials/header.php';
require_once APP_PAGES . 'partials/navbar.php';
require_once APP_CLASSES . 'Projeto.php';

function showNaoExiste() {
    $link = pageServer()->listProjetos();
    $html = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h5>Projeto inexistente</h5>
                <br>
                <a href="$link">...voltar à lista de projetos</a>
            </div>
        </div>
    </div>
HTML;
    echo $html;
}

function showNaoPodeSerRemovido($prj, $erros) {
    $nome = $prj->getNome();
    $listaMsgsErro = '';
    foreach ($erros as $err) $listaMsgsErro .= "<li>$err</li>";
    $link = pageServer()->listProjetos();

    $html = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h5>O projeto <strong>$nome</strong> não pode ser removido.</h5>
                 <br>
                 <ul>$listaMsgsErro</ul>
                 <br>
                <a href="$link">...voltar à lista de projetos</a>
            </div>
        </div>
    </div>
HTML;
    echo $html;
}

function showConfirmadoComRedirect($prj) {
    $nome = $prj->getNome();
    $link = pageServer()->listProjetos();
    $prj->delete();

    $html = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h5>O projeto <strong>$nome</strong> foi removido!</h5>
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

function showConfirmaRemocao($prj) {
    $nome = $prj->getNome();
    $prj_id = $prj->getId();
    $action = pageServer()->removerProjeto($prj_id);
    $linkCancelar = pageServer()->listProjetos();
    $html = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <h5>Confirma a remoção do projeto <strong>$nome</strong>?</h5>
                    
                <div class="row">
                    <div class="col">
                        <form action="$action" method="post">
                            <button type="submit" 
                                    name="op_confirmar" value="$prj_id"
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


if ( !Projeto::tryGetByID(getInput('id', 0), $prj)) showNaoExiste();
elseif ( !$prj->podeSerRemovido($erros)) showNaoPodeSerRemovido($prj, $erros);
else {
    $confirmado = getInput('op_confirmar', 0);
    if ($confirmado == $prj->getId()) showConfirmadoComRedirect($prj);
    else showConfirmaRemocao($prj);
}

require_once APP_PAGES . 'partials/footer.php';
