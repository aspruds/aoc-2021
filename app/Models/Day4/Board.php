<?php

namespace App\Models\Day4;

class Board
{
    private array $boardState;
    private int $id;

    public function __construct(
        string $input
    )
    {
        $lines = explode("\n", $input);
        $this->boardState = array_map(fn($line) => $this->constructLine($line), $lines);
    }

    private function constructLine($line): array
    {
        $numbers = preg_split('/\s+/', trim($line));
        return array_map(fn($number) => new BoardNumber((int)$number), $numbers);
    }

    public function markNumbers(int $number)
    {
        $flatBoard = array_merge(...$this->boardState);
        foreach($flatBoard as $boardNumber) {
            $boardNumber->markNumber($number);
        }
    }

    public function isWinning(): bool
    {
        $rowsMarked = array_map(fn($row) => $this->allMarked($row), $this->boardState);
        $boardStateTransposed = array_map(null, ...$this->boardState);
        $columnsMarked = array_map(fn($row) => $this->allMarked($row), $boardStateTransposed);
        return in_array(true, $rowsMarked) || in_array(true, $columnsMarked);
    }

    private function allMarked($elements): bool
    {
        $marked = array_map(fn($el) => $el->getIsMarked(), $elements);
        return !in_array(false, $marked);
    }

    public function sumUnmarked(): int
    {
        $flatBoard = array_merge(...$this->boardState);
        $flatBoard = array_filter($flatBoard, fn($el) => !$el->getIsMarked());
        return array_sum(array_map(fn($el) => $el->getNumber(), $flatBoard));
    }

    public function printState(): void {
        print_r($this->boardState);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
