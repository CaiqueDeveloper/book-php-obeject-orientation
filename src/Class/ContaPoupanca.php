<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

class ContaPoupanca extends Conta
{

    public function sacar(float $value): bool
    {
        if ($this->saldo > 0) {

            $this->saldo -= $value;
            return true;
        }

        return false;
    }
}
