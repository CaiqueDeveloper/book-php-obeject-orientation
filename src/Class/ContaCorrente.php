<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

class ContaCorrente extends Conta
{
    public function __construct(
        protected ?string $agencia,
        protected ?string $conta,
        protected ?float $saldo,
        protected ?float $limite,
    ) {

        parent::__construct($agencia, $conta, $limite);
        $this->limite = $limite;
    }
    public function sacar(float $valor)
    {
        if (($this->limite + $this->saldo) >= $valor) {
            $this->saldo -= $valor;
            return true;
        }
        return false;
    }
}
