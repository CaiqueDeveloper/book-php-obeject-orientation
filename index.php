<?php

// init autoload

use Caiqu\BookPhpObjectOrientation\Class\Orcamento;
use Caiqu\BookPhpObjectOrientation\Class\Product;
use Caiqu\BookPhpObjectOrientation\Class\Servico;

require_once __DIR__ . '/vendor/autoload.php';

$orcamento = new Orcamento;
$orcamento->adicionar(new Product('Máquina de café', 10, 200), 1);
$orcamento->adicionar(new Product('Barbeador', 5, 100), 3);
$orcamento->adicionar(new Servico('Corta Grama', 350), 1);

print $orcamento->cacularTotal();
