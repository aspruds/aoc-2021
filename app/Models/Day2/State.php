<?php

namespace App\Models\Day2;

use JetBrains\PhpStorm\Pure;

class State
{
    public function __construct(
        public int $horizontal,
        public int $depth,
        public int $aim
    ){}

    #[Pure] public function withAim($aim):State {
        return new State($this->horizontal, $this->depth, $aim);
    }

    #[Pure] public function withHorizontal($horizontal):State {
        return new State($horizontal, $this->depth, $this->aim);
    }

    #[Pure] public function withDepth($depth):State {
        return new State($this->horizontal, $depth, $this->aim);
    }
}
