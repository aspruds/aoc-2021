<?php

namespace App\Services;

use Exception;

class Day11Service
{
    public function flashCount(array $input): int
    {
        $board = $this->board($input);
        $totalFlashes = 0;

        for($i=0; $i < 100; $i++) {
            list($board, $flashes) = $this->step($board);
            $totalFlashes = $totalFlashes + $flashes;
        }

        return $totalFlashes;
    }

    private function step(array $board): array {
        $flashes = array();

        // increase all
        $board = $this->increaseAll($board);

        while($this->shouldFlash($board, $flashes)) {
            $flashCandidates = $this->largerThan9($board);
            foreach ($flashCandidates as $flashCandidate) {
                $x = $flashCandidate[0];
                $y = $flashCandidate[1];
                if (!$this->flashed($flashes, $x, $y)) {
                    $flashes[] = $flashCandidate;
                    $board = $this->updateNeighbours($board, $x, $y);
                }
            }
        }

        foreach($flashes as $flash) {
            $x = $flash[0];
            $y = $flash[1];
            $board[$y][$x] = 0;
        }
        return array($board, count($flashes));
    }

    private function updateNeighbours(array $board, int $x, int $y): array {
        // right
        if(isset($board[$y][$x + 1])) {
            $board[$y][$x + 1]++;
        }
        // left
        if(isset($board[$y][$x - 1])) {
            $board[$y][$x - 1]++;
        }
        // top
        if(isset($board[$y - 1][$x])) {
            $board[$y - 1][$x]++;
        }
        // down
        if(isset($board[$y + 1][$x])) {
            $board[$y + 1][$x]++;
        }
        // tl
        if(isset($board[$y - 1][$x - 1])) {
            $board[$y - 1][$x - 1]++;
        }
        // tr
        if(isset($board[$y - 1][$x + 1])) {
            $board[$y - 1][$x + 1]++;
        }
        // bl
        if(isset($board[$y + 1][$x - 1])) {
            $board[$y + 1][$x - 1]++;
        }
        // br
        if(isset($board[$y + 1][$x + 1])) {
            $board[$y + 1][$x + 1]++;
        }
        return $board;
    }

    private function shouldFlash(array $board, array $flashes): bool
    {
        return count($this->largerThan9($board)) > count($flashes);
    }

    private function largerThan9(array $board): array {
        $values = array();
        for ($y = 0; $y < count($board); $y++) {
            for ($x = 0; $x < count($board[0]); $x++) {
                if ($board[$y][$x] > 9) {
                    $values[] = array($x, $y);
                }
            }
        }
        return $values;
    }

    private function increaseAll(array $board): array {
        return $this->forEachElement($board, function($board, $x, $y) {
            $board[$y][$x] = $board[$y][$x] + 1;
            return $board;
        });
    }

    private function forEachElement(array $board, $action): array
    {
        for($y = 0; $y < count($board); $y++) {
            for($x = 0; $x < count($board[0]); $x++) {
                $board = $action($board, $x, $y);
            }
        }
        return $board;
    }

    private function flashed(array $flashes, int $x, int $y): bool {
        foreach($flashes as $el) {
            if($el[0] == $x && $el[1] == $y) {
                return true;
            }
        }
        return false;
    }

    private function board($input): array
    {
        $board = array();
        foreach ($input as $line) {
            $board[]=str_split($line);
        }
        return $board;
    }

    private function printBoard(array $board): void
    {
        print("board:\n");
        $lines = array_map(fn($row) => implode("", $row), $board);
        print(implode("\n", $lines));
        print("\n");
    }
}
