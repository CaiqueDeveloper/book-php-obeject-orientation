<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

use Caiqu\BookPhpObjectOrientation\Interface\Orcavel;

class Servico implements Orcavel
{
    public function __construct(
        private ?string $descricao,
        private ?float $preco
    ) {
        $this->descricao = $descricao;
        $this->preco = $preco;
    }
    public function getPreco(): float
    {
        return $this->preco;
    }
}
