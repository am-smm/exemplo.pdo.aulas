<?php

class BD
{
    private $conexao;
    private string $error;

    //-----------------------------------------------------
    //region ---- Construtor

    public function __construct($user, $pass, $dbName, $host = "localhost", $charset = 'utf8mb4') {
        // string de conexão
        $strConexao = sprintf("mysql:dbname=%s;host=%s;charset=%s",
                              $dbName,
                              $host,
                              $charset
        );

        $this->conexao = null;
        $this->error = '';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            // $pdo — instância da classe PDO
            $this->conexao = new PDO($strConexao, $user, $pass, $options);
        } catch (PDOException $e) {
            $this->error = "Erro de conexão à DB: " . $e->getMessage();
        } catch (Exception $e) {
            $this->error = "erro genérico: " . $e->getMessage();
        }
    }
    //endregion


    /**
     * @return PDO|null
     */
    public function getConexao() { return $this->conexao; }

    public function getError(): string { return $this->error; }

    public function hasError(): bool { return !empty($this->getError()); }


    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetchQuery(string $sql, array $params = []): array {
        $ret = [];

        if ( !$this->hasError()) {

            $stmt = $this->getConexao()->prepare($sql);

            $stmt->execute($params);

            $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $ret;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function execQuery(string $sql, array $params = []): bool {
        $ret = false;
        if ( !$this->hasError()) {

            $stmt = $this->getConexao()->prepare($sql);

            $ret = $stmt->execute($params);
        }
        return $ret;
    }


}

/**
 * @return BD
 */
function bd() { return new BD(DB_USER, DB_PASS, DB_NAME, DB_HOST); }