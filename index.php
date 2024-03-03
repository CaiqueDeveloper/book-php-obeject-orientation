<?php

// ini autoload
require_once __DIR__ . '/vendor/autoload.php';

use Caiqu\BookPhpObjectOrientation\Class\Fabricante;
use Caiqu\BookPhpObjectOrientation\Class\Product;

$fabricante = new Fabricante('Faker Fabricante', 'Rua ali perto', '99123154654');
$product = new Product('Xiaome', 1, 120);

// criando associação
$product->setFabricante($fabricante);

echo "Produto: {$product->getDescricao()} Fabricante {$product->getFabricante()->getNome()}" . PHP_EOL;
