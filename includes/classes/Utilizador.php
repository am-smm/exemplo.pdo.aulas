<?php
require_once APP_SYS . 'BD.php';

class Utilizador
{
    const ADMIN_GRP = '1';
    const GESTOR_GRP = '2';
    const USER_GRP = '10';

    protected static array $grupos = [
        self::ADMIN_GRP => 'Admin',
        self::GESTOR_GRP => 'Gestor',
        self::USER_GRP => 'Registado (sem privilégios)',
    ];

    //-----------------------------------------------------
    //region ---- Var. de Instância
    protected int $id;
    protected string $username;
    protected string $email;
    protected string $psw;
    protected int $grp;
    /**
     * @var DateTime | string
     */
    protected $dh_last_login;
    protected int $is_logged;
    protected DateTime $dh_registo;

    protected int $qtd_tarefas;
    protected int $qtd_projetos;

    //endregion


    //-----------------------------------------------------
    //region ---- Construtor

    public function __construct(int    $id = 0,
                                string $username = '', string $email = '', string $pass = '',
                                int    $grupo = 10,
                                string $dh_last_login = '', int $is_logged = 0,
                                string $dh_registo = '',
                                int    $qtd_tarefas = 0, int $qtd_projetos = 0
    ) {

        $this->setId($id)
             ->setUsername($username)
             ->setEmail($email)
             ->setPassword($pass)
             ->setGrupo($grupo)
             ->setDhLastLogin($dh_last_login)
             ->setIsLogged($is_logged)
             ->setDhRegisto($dh_registo)
             ->setQtdTarefas($qtd_tarefas)
             ->setQtdProjetos($qtd_projetos);
    }

    //endregion


    //-----------------------------------------------------
    //region ---- Modificadores e interrogadores

    public function getId(): int { return $this->id; }

    public function setId(int $id): Utilizador {
        $this->id = $id;
        return $this;
    }

    public function getUsername(): string { return $this->username; }

    public function setUsername(string $username) {
        $this->username = strtolower(removeEspacos($username));
        return $this;
    }

    public function getEmail(): string { return $this->email; }

    public function setEmail(string $email): Utilizador {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) $this->email = $email;
        else $this->email = '';
        return $this;
    }

    public function getPassword(): string { return $this->psw; }

    public function setPassword(string $pass): Utilizador {
        $this->psw = $pass;
        return $this;
    }

    public function getGrupo(): int { return $this->grp; }

    public function setGrupo(int $grp): Utilizador {
        if ($this->existeGrupo($grp)) $this->grp = $grp;
        else $this->grp = 0;
        return $this;
    }


    public function getDhLastLoginAsStr($format = 'Y-m-d H:i:s'): string {
        if ($this->dh_last_login instanceof DateTime)
            return $this->dh_last_login->format($format);
        return '';
    }

    /**
     * @return DateTime|string
     */
    public function getDhLastLogin() { return $this->dh_last_login; }

    public function setDhLastLogin(string $dh_last_login): Utilizador {
        if (trygetDatetimeFromStr($dh_last_login, $dataHoraValidada))
            $this->dh_last_login = $dataHoraValidada;
        else $this->dh_last_login = '';
        return $this;
    }

    public function isLogged(): int { return $this->is_logged; }

    public function setIsLogged(int $tf): Utilizador {
        $this->is_logged = $tf;
        return $this;
    }

    public function getDhRegistoAsStr($format = 'Y-m-d H:i:s'): string {
        return $this->dh_registo->format($format);
    }

    public function getDhRegisto(): DateTime { return $this->dh_registo; }

    public function setDhRegisto(string $dh_registo): Utilizador {
        trygetDatetimeFromStr($dh_registo, $dataHoraValidada);
        $this->dh_registo = $dataHoraValidada;
        return $this;
    }

    public function getQtdTarefas(): int { return $this->qtd_tarefas; }

    public function setQtdTarefas(int $val): Utilizador {
        $this->qtd_tarefas = $val;
        return $this;
    }

    public function getQtdProjetos(): int { return $this->qtd_projetos; }

    public function setQtdProjetos(int $val): Utilizador {
        $this->qtd_projetos = $val;
        return $this;
    }


    //endregion


    //-----------------------------------------------------
    //region ---- Métodos auxiliares

    /**
     * @return string[]
     */
    public function getGrupos(): array { return self::$grupos; }

    /**
     * @return int[]
     */
    public function getCodigosGrupos(): array {
        $arr = [];
        foreach (array_keys($this->getGrupos()) as $val) $arr[] = intval($val);
        return $arr;
    }

    public function existeGrupo(int $grp): bool { return in_array($grp, $this->getCodigosGrupos()); }

    public function getNomeGrupo(): string {
        $myGrp = $this->getGrupo();
        if ($this->existeGrupo($myGrp)) {
            $arr = $this->getGrupos();
            return $arr[$myGrp . ''];
        } else
            return 'ND';
    }

    public function isAdmin(): bool { return $this->getGrupo() == self::ADMIN_GRP; }

    public function isGestor(): bool {
        return $this->isAdmin()
            || $this->getGrupo() == self::GESTOR_GRP;
    }

    public function isRegistado(): bool {
        return $this->isAdmin()
            || $this->isGestor()
            || $this->getGrupo() == self::USER_GRP;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'psw' => $this->getPassword(),
            'grp' => $this->getGrupo(),
            'dh_last_login' => $this->getDhLastLogin(),
            'is_logged' => $this->isLogged(),
            'dh_registo' => $this->getDhRegisto(),
            'qtd_projetos' => $this->getQtdProjetos(),
            'qtd_tarefas' => $this->getQtdTarefas(),
        ];
    }

    public function podeSerRemovido(&$erros): bool {
        $erros = [];

        if ($this->getId() == 1) $erros[] = 'O Administrador não pode ser removido!';

        $qtdTarefas = $this->getQtdTarefas();

        if ($qtdTarefas > 0) $erros[] = "O Utilizador tem $qtdTarefas tarefa/s associada/s, não pode ser removido!";

        $qtdProjetos = $this->getQtdProjetos();

        if ($qtdProjetos > 0) $erros[] = "O Utilizador tem $qtdProjetos projeto/s associado/s, não pode ser removido!";

        return count($erros) == 0;
    }

    //endregion


    //-----------------------------------------------------
    //region Métodos CRUD

    public function delete(): bool {
        return bd()->execQuery(
            "DELETE FROM utilizador WHERE id = :id_user",
            ['id_user' => $this->getId()]
        );
    }

    //endregion


    //-----------------------------------------------------
    //region Métodos auxiliares STATIC

    /*
        CREATE TABLE IF NOT EXISTS `smm_tarefas`.`utilizador` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(30) NULL DEFAULT NULL,
            `email` VARCHAR(255) NULL DEFAULT NULL,
            `psw` VARCHAR(64) NULL DEFAULT NULL,
            `grp` TINYINT UNSIGNED NOT NULL DEFAULT '0',
            `dh_last_login` TIMESTAMP NULL DEFAULT NULL,
            `is_logged` TINYINT UNSIGNED NOT NULL DEFAULT '0',
            `dh_registo` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        )
     */
    public static function fromDBarray($array): Utilizador {
        if ( !is_array($array)) return new Utilizador();

        return new Utilizador(array_get('id', $array, 0),
                              array_get('username', $array, ''),
                              array_get('email', $array, ''),
                              array_get('psw', $array, ''),
                              array_get('grp', $array, 0),
                              array_get('dh_last_login', $array, ''),
                              array_get('is_logged', $array, 0),
                              array_get('dh_registo', $array, ''),
                              array_get('qtd_projetos', $array, 0),
                              array_get('qtd_tarefas', $array, 0)
        );
    }

    /**
     * @return Utilizador[]
     */
    public static function all(): array {

        $sql = <<<SQL
SELECT 
	u.*,
    (SELECT count(*) FROM projeto p WHERE p.reg_utilizador_id = u.id)  qtd_projetos,
    (SELECT count(*) FROM tarefa t WHERE t.reg_utilizador_id = u.id)  qtd_tarefas  
FROM utilizador u
ORDER BY u.username;
SQL;

        $arrayRegistos = bd()->fetchQuery($sql);
        $arrayUtilizadores = [];
        foreach ($arrayRegistos as $registo) {
            $arrayUtilizadores[] = Utilizador::fromDBarray($registo);
        }

        return $arrayUtilizadores;
    }

    public static function tryGetByID($id_utilizador, &$userObject): bool {

        $sql = <<<SQL
SELECT 
	u.*,
    (SELECT count(*) FROM projeto p WHERE p.reg_utilizador_id = u.id)  qtd_projetos,
    (SELECT count(*) FROM tarefa t WHERE t.reg_utilizador_id = u.id)  qtd_tarefas  
FROM utilizador u WHERE u.id = :id_user;
SQL;

        $arrayRegistos = bd()->fetchQuery($sql, ['id_user' => $id_utilizador]);

        $userObject = false;

        if (count($arrayRegistos) > 0) // encontrou!
        {
            $userObject = Utilizador::fromDBarray($arrayRegistos[0]);
            return true;
        }

        return false;
    }

    //endregion
}

