<?php
require_once APP_SYS . 'BD.php';
require_once APP_SYS . 'ErrorBag.php';

class Projeto
{
    //-----------------------------------------------------
    //region ---- Var. de Instância

    protected int $id;
    protected string $nome;
    protected string $descricao;
    protected DateTime $dh_registo;
    /**
     * @var DateTime | string
     */
    protected $dh_terminado;
    /**
     * @var DateTime | string
     */
    protected $dh_desativado;

    protected int $reg_utilizador_id;
    protected int $qtd_tarefas;

    //endregion


    //-----------------------------------------------------
    //region ---- Construtor

    public function __construct(int    $id = 0,
                                string $nome = '', string $descricao = '',
                                string $dh_registo = '',
                                string $dh_terminado = '', string $dh_desativado = '',
                                int    $reg_utilizador_id = 0, int $qtd_tarefas = 0
    ) {

        $this->setId($id)
             ->setNome($nome)
             ->setDescricao($descricao)
             ->setDhRegisto($dh_registo)
             ->setDhTerminado($dh_terminado)
             ->setDhDesativado($dh_desativado)
             ->setRegistadoPorUtilizadorId($reg_utilizador_id)
             ->setQtdTarefas($qtd_tarefas);
    }

    //endregion


    //-----------------------------------------------------
    //region ---- Modificadores e interrogadores

    public function getId(): int { return $this->id; }

    public function setId(int $id): Projeto {
        $this->id = $id;
        return $this;
    }

    public function getNome(): string { return $this->nome; }

    public function setNome(string $str) {
        $this->nome = limpaEspacosDuplicados($str);
        return $this;
    }

    public function getDescricao(): string { return $this->descricao; }

    public function setDescricao(string $str): Projeto {
        $this->descricao = $str;
        return $this;
    }

    public function getDhRegistoAsStr($format = 'Y-m-d H:i:s'): string {
        return $this->dh_registo->format($format);
    }

    public function getDhRegisto(): DateTime { return $this->dh_registo; }

    public function setDhRegisto(string $dh_registo): Projeto {
        trygetDatetimeFromStr($dh_registo, $dataHoraValidada);
        $this->dh_registo = $dataHoraValidada;
        return $this;
    }

    public function getDhTerminadoAsStr($format = 'Y-m-d H:i:s'): string {
        if ($this->dh_terminado instanceof DateTime)
            return $this->dh_terminado->format($format);
        return '';
    }

    /**
     * @return DateTime|string
     */
    public function getDhTerminado() { return $this->dh_terminado; }

    public function setDhTerminado(string $dh): Projeto {
        if (trygetDatetimeFromStr($dh, $dataHoraValidada))
            $this->dh_terminado = $dataHoraValidada;
        else $this->dh_terminado = '';
        return $this;
    }

    public function isTerminado(): bool { return $this->dh_terminado instanceof DateTime; }

    public function setIsTerminado(): Projeto {
        $this->dh_terminado = agora();
        return $this;
    }


    public function getDhDesativadoAsStr($format = 'Y-m-d H:i:s'): string {
        if ($this->dh_desativado instanceof DateTime)
            return $this->dh_desativado->format($format);
        return '';
    }

    /**
     * @return DateTime|string
     */
    public function getDhDesativado() { return $this->dh_desativado; }

    public function setDhDesativado(string $dh): Projeto {
        if (trygetDatetimeFromStr($dh, $dataHoraValidada))
            $this->dh_desativado = $dataHoraValidada;
        else $this->dh_desativado = '';
        return $this;
    }

    public function isDesativado(): bool { return $this->dh_desativado instanceof DateTime; }

    public function setIsDesativado(): Projeto {
        $this->dh_desativado = agora();
        return $this;
    }

    public function getQtdTarefas(): int { return $this->qtd_tarefas; }

    public function setQtdTarefas(int $val): Projeto {
        $this->qtd_tarefas = $val;
        return $this;
    }

    public function getRegistadoPorUtilizadorId(): int { return $this->reg_utilizador_id; }

    public function setRegistadoPorUtilizadorId(int $userID): Projeto {
        $this->reg_utilizador_id = $userID;
        return $this;
    }

    public function getRegistadoPorUtilizador(): Utilizador {
        if (Utilizador::tryGetByID($this->reg_utilizador_id, $userObj))
            return $userObj;
        else return Utilizador::fromDBarray([]);
    }

    //endregion


    //-----------------------------------------------------
    //region ---- Métodos auxiliares

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'descricao' => $this->getDescricao(),
            'dh_registo' => $this->getDhRegistoAsStr(),
            'dh_terminado' => $this->getDhTerminadoAsStr(),
            'dh_desativado' => $this->getDhDesativadoAsStr(),
            'reg_utilizador_id' => $this->getRegistadoPorUtilizadorId(),
            'qtd_tarefas' => $this->getQtdTarefas(),
        ];
    }

    public function podeSerRemovido(&$erros): bool {
        $erros = [];

        return count($erros) == 0;
    }

    //endregion


    //-----------------------------------------------------
    //region Métodos CRUD

    public function delete(): bool {
        return bd()->execQuery(
            "DELETE FROM projeto WHERE id = :id_prj",
            ['id_prj' => $this->getId()]
        );
    }

    public function save(): bool {
        $id = $this->getId();

        // ID == 0 ? => INSERT
        if ($id == 0) {
            $sql = "INSERT INTO projeto (nome, descricao, reg_utilizador_id) VALUES (:nome, :desc, :user_id);";
            $params = [
                'nome' => $this->getNome(),
                'desc' => $this->getDescricao(),
                'user_id' => $this->getRegistadoPorUtilizadorId(),
            ];
        } // tem ID? => UPDATE
        else {
            $sql = "UPDATE projeto SET nome = :nome, descricao = :desc, reg_utilizador_id = :user_id WHERE (id = :prj_id);";
            $params = [
                'nome' => $this->getNome(),
                'desc' => $this->getDescricao(),
                'user_id' => $this->getRegistadoPorUtilizadorId(),
                'prj_id' => $id,
            ];
        }
        return bd()->execQuery($sql, $params);
    }

    //endregion


    //-----------------------------------------------------
    //region Métodos auxiliares STATIC

    /*
        CREATE TABLE `projeto` (
          `id` int unsigned NOT NULL AUTO_INCREMENT,
          `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `descricao` text COLLATE utf8mb4_unicode_ci,
          `dh_registo` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
          `dh_terminado` timestamp NULL DEFAULT NULL,
          `dh_desativado` timestamp NULL DEFAULT NULL,
          `reg_utilizador_id` int unsigned NOT NULL,
          PRIMARY KEY (`id`),
          KEY `fk_projeto_utilizador_idx` (`reg_utilizador_id`),
          CONSTRAINT `fk_projeto_utilizador` FOREIGN KEY (`reg_utilizador_id`) REFERENCES `utilizador` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=51
          DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
     */
    public static function fromDBarray($array): Projeto {
        if ( !is_array($array)) return new Projeto();

        return new Projeto(array_get('id', $array, 0),
                           array_get('nome', $array, ''),
                           array_get('descricao', $array, ''),
                           array_get('dh_registo', $array, ''),
                           array_get('dh_terminado', $array, ''),
                           array_get('dh_desativado', $array, ''),
                           array_get('reg_utilizador_id', $array, 0),
                           array_get('qtd_tarefas', $array, 0)
        );
    }

    public static function validaPostData(ErrorBag &$erros): Projeto {
        $erros = ErrorBag::errorBag();
        $prj = Projeto::fromDBarray($_POST);
        $erros->setValoresCampos($prj->toArray());

        if ($prj->getNome() == '') $erros->addErroCampo('nome', "O nome deve ser indicado.");
        if ($prj->getRegistadoPorUtilizadorId() == 0) $erros->addErroCampo('reg_utilizador_id', "Deve ser indicado o gestor do projeto.");

        return $prj;
    }

    /**
     * @return Projeto[]
     */
    public static function all(): array {

        $sql = <<<SQL
SELECT 
	p.*,
    (SELECT count(*) FROM tarefa t WHERE t.projeto_id = p.id)  qtd_tarefas  
FROM projeto p;
SQL;

        $arrayRegistos = bd()->fetchQuery($sql);
        $result = [];
        foreach ($arrayRegistos as $registo) {
            $result[] = Projeto::fromDBarray($registo);
        }

        return $result;
    }

    public static function tryGetByID($id_projeto, &$projetoObject): bool {

        $sql = <<<SQL
SELECT 
	p.*,
    (SELECT count(*) FROM tarefa t WHERE t.projeto_id = p.id)  qtd_tarefas  
FROM projeto p WHERE p.id = :id_prj;
SQL;

        $arrayRegistos = bd()->fetchQuery($sql, ['id_prj' => $id_projeto]);

        $projetoObject = false;

        if (count($arrayRegistos) > 0) // encontrou!
        {
            $projetoObject = Projeto::fromDBarray($arrayRegistos[0]);
            return true;
        }

        return false;
    }

    //endregion
}

