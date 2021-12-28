<?php

namespace App\Services;

use App\Models\Day5\Line;
use App\Models\Day5\Point;
use App\Models\Day5\Board;
use JetBrains\PhpStorm\Pure;

class Day5ServiceA
{
    public function numberOfPointsWhereTwoPointsOverlap(array $input): int
    {
        $lines = array_map(array($this, 'toLine'), $input);
        $hvLines = array_filter($lines, array($this, 'horizontalOrVertical'));
        $board = new Board($hvLines);
        return $board->overlappingPoints();
    }

    public function numberOfPointsWhereTwoPointsOverlapDiagonally(array $input): int
    {
        $lines = array_map(array($this, 'toLine'), $input);
        $board = new Board($lines);
        return $board->overlappingPoints();
    }

    private function horizontalOrVertical(Line $line): bool
    {
        return $line->from->x == $line->to->x || $line->from->y == $line->to->y;
    }

    #[Pure] private function notHorizontalOrVertical(Line $line): bool
    {
        return !$this->horizontalOrVertical($line);
    }

    #[Pure] private function toLine($lineDefinition): Line
    {
        [$from, $to] = explode(" -> ", $lineDefinition);
        $from = $this->toPoint($from);
        $to = $this->toPoint($to);
        return new Line($from, $to);
    }

    #[Pure] private function toPoint($pointDefinition): Point
    {
        return new Point(...explode(",", $pointDefinition));
    }
}
