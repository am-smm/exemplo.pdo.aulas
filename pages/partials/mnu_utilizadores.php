<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="UtilizadoresDropdown"
       role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Utilizadores
    </a>
    <ul class="dropdown-menu" aria-labelledby="UtilizadoresDropdown">
        <li><a class="dropdown-item" href="<?= pageServer()->listUtilizadores() ?>">Lista de Utilizadores</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="<?= pageServer()->novoUtilizador() ?>" >Novo Utilizador</a></li>

    </ul>
</li>