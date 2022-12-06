<?php

class ErrorBag
{
    private array $valores_campos;
    private array $erros;
    private bool $posted;

    public static function errorBag(): ErrorBag { return new static(); }

    public function __construct() { $this->clear(); }

    public function clear(): ErrorBag {
        $this->valores_campos = [];
        $this->erros = [];
        $this->posted = false;
        return $this;
    }

    public function getValoresCampos(): array { return $this->valores_campos; }

    public function setValoresCampos(array $valores): ErrorBag {
        $this->valores_campos = $valores;
        $this->posted = true;
        return $this;
    }

    public function getErros(): array { return $this->erros; }

    public function qtdErros(): int { return count($this->getErros()); }

    public function hasErros(): bool { return $this->qtdErros() > 0; }

    public function addErroCampo(string $campo_dados, string $msgErro): ErrorBag {
        $this->erros[$campo_dados] = $msgErro;
        return $this;
    }

    public function hasErroCampo(string $campo_dados): bool {
        return ! !($this->erros[$campo_dados] ?? false);
    }

    /**
     * @param string $campo_dados
     * @return false|string
     */
    public function getErroCampo(string $campo_dados) {
        if ($this->erros[$campo_dados] ?? false)
            return $this->erros[$campo_dados];
        return false;
    }

    public function getValidTagClass(string $campo_dados): string {
        if(!$this->posted) return '';
        return (
        $this->hasErroCampo($campo_dados)
            ? 'is-invalid'
            : 'is-valid'
        );
    }
}
