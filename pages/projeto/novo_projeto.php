<?php
require_once '../../config.php';
require_once APP_PAGES . 'partials/header.php';
require_once APP_PAGES . 'partials/navbar.php';
require_once APP_CLASSES . 'Projeto.php';
require_once APP_CLASSES . 'Utilizador.php';
$users = Utilizador::all();

$guardado = false;
$erros = ErrorBag::errorBag();
/** @var Projeto $elem */
$submetido = hasInputKey('op_confirmar');
if ($submetido) {
    $elem = Projeto::validaPostData($erros);

    if ( !$erros->hasErros()) {
        $guardado = $elem->save();
    }
} else
    $elem = Projeto::fromDBarray([]);
?>
    <div class="container editar editar-projeto">

        <?php
        if ($guardado): ?>
        <div class="row">
            <div class="col-sm-10 offset-sm-1 mb-3">
                <div class="alert alert-success" role="alert">
                    Projeto <strong><?= $elem->getNome() ?></strong> registado.
                </div>
                <script>
                    setTimeout(() => {
                        window.location.replace("<?= pageServer()->listProjetos() ?>");
                    }, 2000) // 2 segundos
                </script>
            </div>
        </div>
        <?php
        endif; ?>

        <div class="row mb-4">
            <div class="col pag-title">Novo Projeto</div>
        </div>

        <div class="row">
            <div class="col">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $elem->getId() ?>"/>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control <?= $erros->getValidTagClass('nome') ?>"
                                       id="nome" aria-describedby="nomeFeedback"
                                       name="nome" value="<?= $elem->getNome() ?>">
                                <?php
                                if ($erros->getErroCampo('nome')): ?>
                                    <div id="nomeFeedback"
                                         class="invalid-feedback"><?= $erros->getErroCampo('nome') ?></div>
                                <?php
                                endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <label for="reg_utilizador_id" class="form-label">Responsável do Projeto</label>
                            <select class="form-select <?= $erros->getValidTagClass('reg_utilizador_id') ?>"
                                    id="reg_utilizador_id" name="reg_utilizador_id"
                                    aria-describedby="reg_utilizador_idFeedback" required>
                                <?php
                                if ($elem->getRegistadoPorUtilizadorId() == 0): ?>
                                    <option selected disabled value="0">Escolher o Responsável do Projeto...</option>
                                <?php
                                endif; ?>
                                <?php
                                /** @var Utilizador $user */
                                foreach ($users as $user) {
                                    $selected = '';
                                    if ($elem->getRegistadoPorUtilizadorId() == $user->getId())
                                        $selected = 'selected';
                                    echo "<option $selected value='{$user->getId()}'>{$user->getUsername()}</option>";
                                }
                                ?>
                            </select>
                            <?php
                            if ($erros->getErroCampo('nome')): ?>
                                <div id="reg_utilizador_idFeedback"
                                     class="invalid-feedback"><?= $erros->getErroCampo('nome') ?></div>
                            <?php
                            endif; ?>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control <?= $erros->getValidTagClass('descricao') ?>"
                                          id="descricao" aria-describedby="descricaoFeedback"
                                          name="descricao"><?= $elem->getDescricao() ?></textarea>
                                <?php
                                if ($erros->getErroCampo('descricao')): ?>
                                    <div id="descricaoFeedback"
                                         class="invalid-feedback"><?= $erros->getErroCampo('descricao') ?></div>
                                <?php
                                endif; ?>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-8"></div>
                        <div class="col-2">
                            <a href="<?= pageServer()->listProjetos() ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-success"
                                    name="op_confirmar" value="<?= $elem->getId() ?>"><i
                                        class="fas fa-check"></i></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php
require_once APP_PAGES . 'partials/footer.php';
?>