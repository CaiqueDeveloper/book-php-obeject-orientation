<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

use Caiqu\BookPhpObjectOrientation\Interface\Orcavel;

class Orcamento
{
    private ?array $items = [];

    public function adicionar(Orcavel $item, $qty): void
    {
        $this->items[] = [$qty, $item];
    }
    public function cacularTotal(): string
    {
        return "R$ " . number_format(array_reduce($this->items, fn ($sum, $item) => $sum += ($item[0] * $item[1]->getPreco()), 0), 2, ',', '.');
    }
}
