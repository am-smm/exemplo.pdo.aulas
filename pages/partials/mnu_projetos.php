<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="ProjetosDropdown"
       role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Projetos
    </a>
    <ul class="dropdown-menu" aria-labelledby="ProjetosDropdown">
        <li><a class="dropdown-item" href="<?= pageServer()->listProjetos() ?>" >Projetos</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="<?= pageServer()->novoProjeto() ?>">Novo Projeto</a></li>

    </ul>
</li>