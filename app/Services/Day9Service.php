<?php

namespace App\Services;

use Exception;

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
            $this->visited = array();
            $basinSize = $this->basinSize($lowPoint[0], $lowPoint[1], $board, 0, 0);
            print("basin size: $basinSize\n");
            $basinSizes[]=$basinSize;
        }
        print("basin sizes\n");
        sort($basinSizes);
        $basinSizes = array_reverse($basinSizes);
        return $basinSizes[0] * $basinSizes[1] * $basinSizes[1];
    }

    public function basinSize(int $x, int $y, array $board, int $accumulatedCount, int $level): int
    {
        $val = $board[$y][$x] ?? 'none';
        for($i=0; $i < $level; $i++) {
            print("  ");
        }
        print("checking x=$x, y=$y, value=$val, level=$level, acc=$accumulatedCount\n");

        foreach($this->visited as $el) {
            if($el[0] == $x && $el[1] == $y) {
                for($i=0; $i < $level; $i++) {
                    print("  ");
                }
                print("returning, already visited\n");
                return 0;
            }
        }

        $this->visited[] = array($x, $y);

        if($level > 10) {
            for($i=0; $i < $level; $i++) {
                print("  ");
            }
            print("returning, max level reached\n");
            return 0;
        }

        if(!isset($board[$y][$x])) {
            for($i=0; $i < $level; $i++) {
                print("  ");
            }
            print("returning, out of board\n");
            return 0;
        }

        $value = $board[$y][$x];
        if($value == 9) {
            for($i=0; $i < $level; $i++) {
                print("  ");
            }
            print("returning, 9 found\n");
            return 0;
        }
        else {
            $accumulatedCount++;
            $up = $this->basinSize($x, $y - 1, $board, 0, $level + 1);
            $down = $this->basinSize($x, $y + 1, $board, 0, $level + 1);
            $left = $this->basinSize($x - 1, $y, $board, 0, $level + 1);
            $right = $this->basinSize($x + 1, $y, $board, 0,$level + 1);

            if($level < 2) {
                for($i=0; $i < $level; $i++) {
                    print("  ");
                }
                print("up: $up, down: $down, left: $left, right: $right\n");
            }
            return $accumulatedCount + $up + $down + $left + $right;
        }
    }
}
