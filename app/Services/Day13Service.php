<?php

namespace App\Services;

class Day13Service
{
    public function dotsAfterFirstFold(string $input): int
    {
        list($coordinates, $foldInstructions) = explode("\n\n", $input);
        $coordinates = explode("\n", $coordinates);
        $foldInstructions = $this->parseFoldInstructions(explode("\n", trim($foldInstructions)));
        $foldInstructions = array($foldInstructions[0]);

        $fold = $this->createBoard($coordinates);
        foreach ($foldInstructions as $foldInstruction) {
            $fold = $this->fold($foldInstruction[0], $foldInstruction[1], $fold);
        }
        return count($fold);
    }

    public function dotsAfterAllFolds(string $input): int
    {
        list($coordinates, $foldInstructions) = explode("\n\n", $input);
        $coordinates = explode("\n", $coordinates);
        $foldInstructions = $this->parseFoldInstructions(explode("\n", trim($foldInstructions)));
        $fold = $this->createBoard($coordinates);
        foreach ($foldInstructions as $foldInstruction) {
            $fold = $this->fold($foldInstruction[0], $foldInstruction[1], $fold);
        }
        //$this->printBoard($this->expandBoard($fold));
        return 42;
    }

    private function createBoard(array $coordinates): array
    {
        return array_map(array($this, 'parseCoordinate'), $coordinates);
    }

    private function parseFoldInstructions(array $foldInstructions): array
    {
        return array_map(array($this, 'parseFoldInstruction'), $foldInstructions);
    }

    private function parseFoldInstruction(string $instruction): array
    {
        $instruction = str_replace("fold along ", "", $instruction);
        list($direction, $foldAlong) = explode("=", $instruction);
        return array($direction, $foldAlong);
    }

    private function expandBoard(array $board): array
    {
        $maxX = max(array_map(fn($el) => $el[0], $board));
        $maxY = max(array_map(fn($el) => $el[1], $board));
        $expandedBoard = array();
        for ($y = 0; $y < $maxY + 1; $y++) {
            $expandedBoard[$y] = array();
            for ($x = 0; $x < $maxX + 1; $x++) {
                $foundElements = array_filter($board, fn($el) => $el[0] == $x && $el[1] == $y);
                $expandedBoard[$y][$x] = count($foundElements);
            }
        }
        return $expandedBoard;
    }

    private function fold($direction, int $foldAlong, array $board): array
    {
        $expandedBoard = $this->expandBoard($board);
        if ($direction == 'x') {
            $expandedBoard = $this->transpose($expandedBoard);
        }

        $first = array_slice($expandedBoard, 0, $foldAlong);
        $second = array_slice($expandedBoard, $foldAlong + 1);

        if (count($first) < count($second)) {
            $this->swap($first, $second);
        }
        $second = array_reverse($second);

        for ($y = count($first) - count($second); $y < count($second); $y++) {
            for ($x = 0; $x < count($first[0]); $x++) {
                if ($first[$y][$x] || $second[$y][$x]) {
                    $first[$y][$x] = 1;
                } else {
                    $first[$y][$x] = 0;
                }
            }
        }
        if ($direction == 'x') {
            $first = $this->transpose($first);
        }
        return $this->compactBoard($first);
    }

    private function compactBoard(array $board): array
    {
        $compacted = array();
        for ($y = 0; $y < count($board); $y++) {
            for ($x = 0; $x < count($board[0]); $x++) {
                if ($board[$y][$x] > 0) {
                    $compacted[] = array($x, $y);
                }
            }
        }
        return $compacted;
    }

    private function transpose(array $array): array
    {
        return array_map(null, ...$array);
    }

    private function parseCoordinate(string $line): array
    {
        return explode(",", $line);
    }

    function swap(&$x, &$y)
    {
        $tmp = $x;
        $x = $y;
        $y = $tmp;
    }

    private function printBoard(array $board): void
    {
        print("board:\n");
        $lines = array_map(fn($row) => implode("", $row), $board);
        print(implode("\n", $lines));
        print("\n");
    }
}
