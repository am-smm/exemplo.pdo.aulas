<?php

class Utilizador
{
    private int $id;
    private string $nome;
    private string $apelido;
    private string $username;
    private string $email;
    private string $psw;
    // estrutura tipo dos valores na BD:
    //  -> 2022-12-24 => string
    private string $dh_registo;

    //region __construct

    // ------------------------------------------------
    public function __construct(
        int    $id = 0, string $nome = '',
        string $apelido = '', string $username = '',
        string $email = '', string $psw = '',
        string $dh_registo = '') {

        $this->setId($id)
             ->setNome($nome)
             ->setApelido($apelido)
             ->setUsername($username)
             ->setEmail($email)
             ->setPsw($psw)
             ->setDhRegisto($dh_registo);
    }
    //endregion

    // ------------------------------------------------
    //region Interrogadores e Modificadores

    public function getId(): int { return $this->id; }

    public function setId(int $id): Utilizador {
        $this->id = $id;
        return $this;
    }

    public function getNome(): string { return $this->nome; }

    public function setNome(string $nome): Utilizador {
        $this->nome = $nome;
        return $this;
    }

    public function getApelido(): string { return $this->apelido; }

    public function setApelido(string $apelido): Utilizador {
        $this->apelido = $apelido;
        return $this;
    }

    public function getUsername(): string { return $this->username; }

    public function setUsername(string $username): Utilizador {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): string { return $this->email; }

    public function setEmail(string $email): Utilizador {
        $this->email = $email;
        return $this;
    }

    public function getPsw(): string { return $this->psw; }

    public function setPsw(string $psw): Utilizador {
        $this->psw = $psw;
        return $this;
    }

    public function getDhRegisto(): string { return $this->dh_registo; }

    public function setDhRegisto(string $dh_registo): Utilizador {
        $this->dh_registo = $dh_registo;
        return $this;
    }

    //endregion

}