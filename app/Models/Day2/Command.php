<?php

namespace App\Models\Day2;

class Command
{
    public function __construct(
        public string $move,
        public int $amount
    ){}
}
