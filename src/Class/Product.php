<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

class Product
{

    private ?object $fabricante;
    private ?array $caracteristicas;

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
    public function getValor(): float
    {
        return $this->preco;
    }
    //associação
    public function setFabricante(Fabricante $fabricante): void
    {
        $this->fabricante = $fabricante;
    }
    public function getFabricante(): object
    {
        return $this->fabricante;
    }
    //composição
    public function setCaracteristicas(string $nome, string $valor): void
    {
        $this->caracteristicas[] = new Caracteristica($nome, $valor);
    }
    public function getCarcteristicas(): array
    {
        return $this->caracteristicas;
    }
}
