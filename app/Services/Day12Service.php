<?php

namespace App\Services;

use App\Models\Day12\CaveSystem;
use JetBrains\PhpStorm\Pure;

class Day12Service
{
    // mutable variable
    private int $count = 0;

    public function smallCavePaths(array $input): int
    {
        $caveSystem = new CaveSystem($input);
        $this->uniquePathSearch($caveSystem, 'start', array(), $this->canVisitSimple(...));
        return $this->count;
    }

    public function advancedSmallCavePaths(array $input): int
    {
        $caveSystem = new CaveSystem($input);
        $this->uniquePathSearch($caveSystem, 'start', array(), $this->canVisit(...));
        return $this->count;
    }

    private function uniquePathSearch(
        CaveSystem $caveSystem,
        string $currentNode,
        array $discovered,
        $canVisit): void {

        if($this->isSmallCave($currentNode)) {
            $curr = $discovered[$currentNode] ?? 0;
            $discovered[$currentNode] = $curr + 1;
        }

        if($currentNode == 'end') {
            $this->count++;
        }

        $edges = $caveSystem->getEdges();
        foreach ($edges[$currentNode] ?? array() as $edge) {
            if($canVisit($edge, $discovered)) {
                $this->uniquePathSearch($caveSystem, $edge, $discovered, $canVisit);
            }
        }
    }

    #[Pure] private function canVisitSimple(string $edge, array $discovered): bool
    {
        return !array_key_exists($edge, $discovered);
    }

    #[Pure] private function canVisit(string $edge, array $discovered): bool
    {
        if($edge == 'start' || $edge == 'end') {
            return ($discovered[$edge] ?? 0) < 1;
        }

        if(!$this->isSmallCave($edge)) {
            return true;
        }

        $visitedTwice = count(array_filter($discovered, fn($el) => $el > 1)) > 0;
        if($visitedTwice) {
            return !array_key_exists($edge, $discovered);
        } else {
            return ($discovered[$edge] ?? 0) < 3;
        }
    }

    private function isSmallCave($name): bool
    {
        if(strtolower($name) == $name) {
            return true;
        }
        else {
            return false;
        }
    }
}
