<?php
require_once '../../config.php';
require_once APP_PAGES . 'partials/header.php';
require_once APP_PAGES . 'partials/navbar.php';

require_once APP_CLASSES . 'Projeto.php';
$prjs = Projeto::all();
?>

    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-end ">
                <a href="<?= pageServer()->novoProjeto() ?>" class="btn btn-success btn-circle">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col pag-title">lista de projetos</div>
        </div>

        <div class="row">
            <div class="col">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>NOME</td>
                        <td>DH REG.</td>
                        <td>Terminado?</td>
                        <td>Desativado?</td>
                        <td>#T</td>
                        <td>OP</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /** @var Projeto $p */
                    foreach ($prjs as $p) : ?>
                        <tr>
                            <td><?= $p->getId() ?></td>
                            <td><?= $p->getNome() ?></td>
                            <td><?= $p->getDhRegistoAsStr('d-m-Y H:i') ?></td>
                            <td><?= $p->getDhTerminado('d-m-Y H:i') ?></td>
                            <td><?= $p->getDhDesativadoAsStr('d-m-Y H:i') ?></td>
                            <td><?= $p->getQtdTarefas() ?></td>
                            <td>
                                <?php
                                if ($p->getQtdTarefas() == 0) : ?>
                                    <a href="<?= pageServer()->removerProjeto($p->getId()) ?>">Remover</a>
                                <?php
                                endif; ?>
                                <a href="<?= pageServer()->editarProjeto($p->getId()) ?>">Editar</a>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
require_once APP_PAGES . 'partials/footer.php';
?>