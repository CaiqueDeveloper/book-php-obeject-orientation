<?php

namespace Caiqu\BookPhpObjectOrientation\Class;

class Conta
{

    public function __construct(
        protected ?string $agencia,
        protected ?string $conta,
        protected ?float $saldo,
    ) {
        $this->agencia = $agencia;
        $this->conta = $agencia;

        if ($saldo >= 0) {
            $this->saldo = $saldo;
        }
    }
    public function depositar(float $value): bool
    {
        if ($value > 0) {

            $this->saldo += $value;
            return true;
        }

        return false;
    }
    public function getInfo(): string
    {
        return "Agencia: {$this->agencia} - Conta: {$this->conta}";
    }
    public function getSaldo(): string
    {
        return "R$ " . number_format($this->saldo, 2, ',', '.');
    }
}
