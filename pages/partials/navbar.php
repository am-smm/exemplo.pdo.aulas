<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <a class="navbar-brand" href="<?= pageServer()->homeLink() ?>">
            <img src="<?= ASSETS_URL ?>imgs/logo_80x50.png" alt="home">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg"
                aria-controls="navbarOffcanvasLg">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg"
             aria-labelledby="navbarOffcanvasLgLabel">

            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                    <img src="<?= ASSETS_URL ?>imgs/logo_80x50.png" alt="home">
                </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav flex-grow-1 pe-3">

                    <?php
                    require_once APP_PAGES.'partials/mnu_utilizadores.php';
                    require_once APP_PAGES.'partials/mnu_projetos.php';
                    require_once APP_PAGES.'partials/mnu_tarefas.php';
                    ?>

                    <li class="nav-item dropdown ms-auto ">
                        <a class="user-blk nav-link text-decoration-none dropdown-toggle" id="dropdownUser1"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="username">user</span>
                            <img src="<?= ASSETS_URL ?>imgs/user-black.png" alt="" width="20" height="20"
                                 class="rounded-circle ms-2">
                        </a>
                        <ul class="dropdown-menu text-small shadow dropdown-menu-end"
                            aria-labelledby="dropdownUser1">
                            <li class="dropdown-li">
                                <img src="<?= ASSETS_URL ?>imgs/user.png" alt="perfil" width="20">
                                <a class="dropdown-item" href="#">Perfil...</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-li">
                                <img src="<?= ASSETS_URL ?>imgs/logout.png" alt="logout" width="20">
                                <a class="dropdown-item" href="#">Sair</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>
    </div>
</nav>

