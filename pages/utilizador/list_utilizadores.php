<?php
require_once '../../config.php';
require_once APP_PAGES . 'partials/header.php';
require_once APP_PAGES . 'partials/navbar.php';

require_once APP_CLASSES . 'Utilizador.php';
$users = Utilizador::all();
?>
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-end ">
                <a href="<?= pageServer()->novoUtilizador() ?>" class="btn btn-success btn-circle">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col pag-title">lista de tarefas</div>
        </div>

        <div class="row">
            <div class="col">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>USERNAME</td>
                        <td>EMAIL</td>
                        <td>GRP</td>
                        <td>LAST LOGIN</td>
                        <td>LOGGED?</td>
                        <td>DH REG.</td>
                        <td>#P</td>
                        <td>#T</td>
                        <td>OP</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /** @var Utilizador $user */
                    foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user->getId() ?></td>
                            <td><?= $user->getUsername() ?></td>
                            <td><?= $user->getEmail() ?></td>
                            <td><?= $user->getNomeGrupo() ?></td>
                            <td><?= $user->getDhLastLoginAsStr('d-m-Y H:i') ?></td>
                            <td><?= $user->isLogged() ?></td>
                            <td><?= $user->getDhRegistoAsStr('d-m-Y H:i') ?></td>
                            <td><?= $user->getQtdProjetos() ?></td>
                            <td><?= $user->getQtdTarefas() ?></td>
                            <td>
                                <?php
                                if ($user->getQtdProjetos() + $user->getQtdTarefas() == 0) : ?>
                                    <a href="<?= pageServer()->removerUtilizador($user->getId()) ?>">Remover</a>
                                <?php
                                endif; ?>
                                <a href="<?= pageServer()->editarUtilizador($user->getId()) ?>">Editar</a>
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