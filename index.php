<?php

// init autoload
require_once __DIR__ . '/vendor/autoload.php';

use Caiqu\BookPhpObjectOrientation\Class\Fabricante;
use Caiqu\BookPhpObjectOrientation\Class\Product;
use Caiqu\BookPhpObjectOrientation\Class\Cesta;

$fabricante = new Fabricante('Faker Fabricante', 'Rua ali perto', '99123154654');
$product = new Product('Xiaomi Redmi Note 12 S', 1, 1080.99);

// criando associação
$product->setFabricante($fabricante);

//criando composição
$product->setCaracteristicas('cor', 'preto fosco');
$product->setCaracteristicas('tela', 'amoled');

//criando agregação
$cesta = new Cesta;
$cesta->addItem(new Product('Xiaomi Redmi Note 12 S', 1, 1080.99));
$cesta->addItem(new Product('Samsung Galax', 1, 1080.99));
$cesta->addItem(new Product('Iphone', 1, 1080.99));

?>
<h3>Cesta de Itens</h3>
<ul>
    <?php foreach ($cesta->getItens() as $item) : ?>
        <li>
            <?= $item->getDescricao(); ?> - <?= 'R$ ' . number_format($item->getValor(), 2, ',', '.'); ?>
        </li>
    <?php endforeach; ?>
</ul>