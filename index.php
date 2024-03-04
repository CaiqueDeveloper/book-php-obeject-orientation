<?php

// init autoload

require_once __DIR__ . '/vendor/autoload.php';

use Caiqu\BookPhpObjectOrientation\Class\ContaCorrente;
use Caiqu\BookPhpObjectOrientation\Class\ContaPoupanca;

$contas = [];
$contas[] = new ContaPoupanca('P0001', '12313213', 135.50);
$contas[] = new ContaCorrente('C0001', '12313213', 135.50, 890.99);

foreach ($contas as $conta) {

    print $conta->getInfo() . "<br>";
    print "Saldo: {$conta->getSaldo()}" . "<br><br>";
    print "Deposito de 700 <br><br>";
    $conta->depositar(700);

    print $conta->getInfo() . "<br>";
    print "Saldo: {$conta->getSaldo()} <br><br>";
    print "Saque de 389.99 <br><br>";
    $conta->sacar(389.90);

    print $conta->getInfo() . "<br>";
    print "Saldo: {$conta->getSaldo()} <br><br>";
}
