<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

class Caracteristica
{
    public function __construct(
        private ?string $nome,
        private ?string $valor
    ) {
        $this->nome = $nome;
        $this->valor = $valor;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
    public function getValor(): string
    {
        return $this->valor;
    }
}
