<?php

namespace App\Models\Day5;

class Board
{
    private array $board;
    public function __construct(
        array $lines
    ){
        $this->board = array();
        $this->initializeBoard($lines);
        foreach($lines as $line) {
            if($line->isHorizontal() || $line->isVertical()) {
                $this->markStraight($line);
            } else {
                $this->markDiagonal($line);
            }
        }
    }

    private function markStraight($line): void
    {
        $minX = min($line->from->x, $line->to->x);
        $maxX = max($line->from->x, $line->to->x);
        $minY = min($line->from->y, $line->to->y);
        $maxY = max($line->from->y, $line->to->y);
        for ($x = $minX; $x < $maxX + 1; $x++) {
            for ($y = $minY; $y < $maxY + 1; $y++) {
                $this->board[$y][$x] = $this->board[$y][$x] + 1;
            }
        }
    }

    private function markDiagonal($line): void
    {
        $x = $line->from->x;
        $y = $line->from->y;
        while(true) {
            $this->board[$y][$x] = $this->board[$y][$x] + 1;

            if($line->from->x < $line->to->x){
                $x++;
                if($x > $line->to->x) break;
            } else {
                $x--;
                if($x < $line->to->x) break;
            }

            if($line->from->y < $line->to->y){
                $y++;
                if($y > $line->to->y) break;
            } else {
                $y--;
                if($y < $line->to->y) break;
            }
        }
    }

    private function initializeBoard($lines) {
        $maxX = max(array_merge(...array_map(fn($line) => array($line->from->x, $line->to->x), $lines)));
        $maxY = max(array_merge(...array_map(fn($line) => array($line->from->y, $line->to->y), $lines)));
        for($x = 0; $x < $maxX + 1; $x++) {
            for($y = 0; $y < $maxY + 1; $y++) {
                $this->board[$y][$x] = 0;
            }
        }
    }

    public function printBoard(): string
    {
        $lines = array_map(fn($line) => implode("", $line), $this->board);
        return str_replace("0", ".", implode("\n", $lines));
    }

    public function overlappingPoints(): int
    {
        $flatBoard = array_merge(...$this->board);
        return count(array_filter($flatBoard, fn($v) => $v > 1));
    }
}
