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
        $this->smallPathSearch($caveSystem, 'start', array(), array());
        return $this->count;
    }

    public function advancedSmallCavePaths(array $input): int
    {
        $caveSystem = new CaveSystem($input);
        $this->advancedSmallPathSearch($caveSystem, 'start', array(), array(), 0);
        return $this->count;
    }

    private function smallPathSearch(CaveSystem $caveSystem, string $currentNode, array $discovered, array $path): void {
        $path[] = $currentNode;

        if($this->isSmallCave($currentNode)) {
            $discovered[] = $currentNode;
        }

        if($currentNode == 'end') {
            $this->count++;
        }

        $edges = $caveSystem->getEdges();
        if(isset($edges[$currentNode])) {
            foreach ($edges[$currentNode] as $edge) {
                if(!in_array($edge, $discovered)) {
                    $this->smallPathSearch($caveSystem, $edge, $discovered, $path);
                }
            }
        }
    }

    private function advancedSmallPathSearch(CaveSystem $caveSystem, string $currentNode, array $discovered, array $path, $level): void {
        $path[] = $currentNode;

        if($this->isSmallCave($currentNode)) {
            $curr = $discovered[$currentNode] ?? 0;
            $discovered[$currentNode] = $curr + 1;
        }

        if($currentNode == 'end') {
            $this->count++;
        }

        $edges = $caveSystem->getEdges();
        if(isset($edges[$currentNode])) {
            foreach ($edges[$currentNode] as $edge) {
                if($this->canVisit($edge, $discovered)) {
                    $this->advancedSmallPathSearch($caveSystem, $edge, $discovered, $path, $level++);
                }
            }
        }
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
