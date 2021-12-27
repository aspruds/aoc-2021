<?php

namespace App\Models\Day4;

use JetBrains\PhpStorm\Pure;

class BoardNumber
{
    private bool $marked;

    public function __construct(
        private int $number
    ){
        $this->marked = false;
    }

    public function getIsMarked(): bool
    {
        return $this->marked;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function markNumber(int $number): void
    {
        if($this->number == $number) {
            $this->marked = true;
        }
    }
}
