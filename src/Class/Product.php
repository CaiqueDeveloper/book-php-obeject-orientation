<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

class Product
{

    private ?object $fabricante;

    public function __construct(
        private ?string $descicao,
        private ?int $estoque,
        private ?float $preco,
    ) {

        $this->descicao = $descicao;
        $this->estoque = $estoque;
        $this->preco = $preco;
    }
    public function getDescricao(): string
    {
        return $this->descicao;
    }
    public function setFabricante(Fabricante $fabricante): void
    {
        $this->fabricante = $fabricante;
    }
    public function getFabricante(): object
    {
        return $this->fabricante;
    }
}
