<?php

// init autoload

use Caiqu\BookPhpObjectOrientation\Class\Orcamento;
use Caiqu\BookPhpObjectOrientation\Class\Product;
use Caiqu\BookPhpObjectOrientation\Class\Servico;
use Caiqu\BookPhpObjectOrientation\Singleton\Preferenceias;

require_once __DIR__ . '/vendor/autoload.php';

$p1 = Preferenceias::getInstance();
print 'A linguagem é '.$p1->getData('language'). "<br>\n";
$p1->setData('language', 'pt-br');
print 'A linguagem é '.$p1->getData('language'). "<br>\n";
