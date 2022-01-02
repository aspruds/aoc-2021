<?php

namespace App\Services;

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

    public function flashCountSimultaneous(array $input): int
    {
        $board = $this->board($input);
        $maxSteps = 1000;

        for($i=0; $i < $maxSteps; $i++) {
            $board = $this->step($board)[0];
            $flatBoard = array_merge(...$board);
            if(array_sum($flatBoard) == 0) {
                return $i + 1;
            }
        }
        return $maxSteps;
    }

    private function step(array $board): array {
        $flashes = array();

        // increase all
        $board = $this->increaseAll($board);

        while($this->shouldFlash($board, $flashes)) {
            $flashCandidates = $this->largerThan9($board);
            foreach ($flashCandidates as $flashCandidate) {
                list($x, $y) = $flashCandidate;
                if (!$this->flashed($flashes, $x, $y)) {
                    $flashes[] = $flashCandidate;
                    $board = $this->updateNeighbours($board, $x, $y);
                }
            }
        }

        foreach($flashes as $flash) {
            list($x, $y) = $flash;
            $board[$y][$x] = 0;
        }
        return array($board, count($flashes));
    }

    private function updateNeighbours(array $board, int $x, int $y): array {
        $shifts = [
            [0, 1], // right
            [0, -1], // left
            [-1, 0], //top
            [1, 0], // down
            [-1, -1], // tl
            [-1, 1], // tr
            [1, -1], // bl
            [1, 1], // br
        ];
        foreach ($shifts as $shift) {
            list($deltaX, $deltaY) = $shift;
            if(isset($board[$y + $deltaY][$x + $deltaX])) {
                $board[$y + $deltaY][$x + $deltaX]++;
            }
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
