<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

class Cesta
{
    private ?array $itens;
    private ?string $time;

    public function __construct()
    {
        $this->itens = [];
        $this->time = date('d/m/Y H:i:s');
    }
    public function addItem(Product $product): void
    {
        $this->itens[] = $product;
    }
    public function getItens(): array
    {
        return $this->itens;
    }
}
