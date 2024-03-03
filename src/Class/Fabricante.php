<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

class Fabricante
{

    public function __construct(
        private ?string $nome,
        private ?string $endereco,
        private ?string $documento,
    ) {

        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->documento = $documento;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}
