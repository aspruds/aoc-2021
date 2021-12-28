<?php

namespace App\Models\Day5;

class Line
{
    public function __construct(
        public Point $from,
        public Point $to
    )
    {}

    public function isHorizontal(): bool
    {
        return $this->from->y === $this->to->y;
    }

    public function isVertical(): bool
    {
        return $this->from->x === $this->to->x;
    }
}
