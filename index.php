<?php

// init autoload
require_once __DIR__ . '/vendor/autoload.php';

use Caiqu\BookPhpObjectOrientation\Class\Fabricante;
use Caiqu\BookPhpObjectOrientation\Class\Product;

$fabricante = new Fabricante('Faker Fabricante', 'Rua ali perto', '99123154654');
$product = new Product('Xiaomi Redmi Note 12 S', 1, 1080.99);

// criando associação
$product->setFabricante($fabricante);

//criando composição
$product->setCaracteristicas('cor', 'preto fosco');
$product->setCaracteristicas('tela', 'amoled');

echo "Produto: {$product->getDescricao()} - Fabricante {$product->getFabricante()->getNome()}" . PHP_EOL;

echo "<br>Caracteristicas do Produto<br>";

foreach ($product->getCarcteristicas() as $caracteristica) {

    echo "{$caracteristica->getNome()} - {$caracteristica->getValor()} <br>";
}
