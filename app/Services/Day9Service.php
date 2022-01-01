<?php

namespace App\Services;

class Day9Service
{
    private array $visited;

    public function lowPoints(array $input): array
    {
        $board = $this->board($input);
        $lowPoints = array();
        for($x=0; $x < count($board[0]); $x++) {
            for($y=0; $y < count($board); $y++) {
                $value = $board[$y][$x];
                $neighbours = array(
                    $board[$y-1][$x] ?? PHP_INT_MAX,
                    $board[$y+1][$x] ?? PHP_INT_MAX,
                    $board[$y][$x-1] ?? PHP_INT_MAX,
                    $board[$y][$x+1] ?? PHP_INT_MAX
                );
                if($value < min($neighbours)) {
                    $lowPoints[]=array($x, $y, $value);
                }
            }
        }
        return $lowPoints;
    }

    private function board($input): array
    {
        $board = array();
        foreach ($input as $line) {
            $board[]=str_split($line);
        }
        return $board;
    }

    public function riskLevel(array $input): int
    {
        $lowPoints = $this->lowPoints($input);
        $riskLevels = array_map(fn($el) => $el[2] + 1, $lowPoints);
        return array_sum($riskLevels);
    }

    public function basinTotal(array $input): int
    {
        $board = $this->board($input);
        $lowPoints = $this->lowPoints($input);
        $basinSizes = array();
        foreach ($lowPoints as $lowPoint) {
            // ugly global variable
            $this->visited = array();
            $basinSize = $this->basinSize($lowPoint[0], $lowPoint[1], $board, 0, 0);
            $basinSizes[]=$basinSize;
        }
        sort($basinSizes);
        $basinSizes = array_reverse($basinSizes);
        return $basinSizes[0] * $basinSizes[1] * $basinSizes[2];
    }

    public function basinSize(int $x, int $y, array $board, int $accumulatedCount, int $level): int
    {
        // check if already visited
        foreach($this->visited as $el) {
            if($el[0] == $x && $el[1] == $y) {
                return 0;
            }
        }
        $this->visited[] = array($x, $y);

        // check if outside of board
        if(!isset($board[$y][$x])) {
            return 0;
        }

        // check if value is 9
        $value = $board[$y][$x];
        if($value == 9) {
            return 0;
        }

        $accumulatedCount++;
        $up = $this->basinSize($x, $y - 1, $board, 0, $level + 1);
        $down = $this->basinSize($x, $y + 1, $board, 0, $level + 1);
        $left = $this->basinSize($x - 1, $y, $board, 0, $level + 1);
        $right = $this->basinSize($x + 1, $y, $board, 0,$level + 1);
        return $accumulatedCount + $up + $down + $left + $right;
    }
}
