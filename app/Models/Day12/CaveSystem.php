<?php

namespace App\Models\Day12;

class CaveSystem
{
    private array $nodes;
    private array $edges;

    public function __construct(array $input)
    {
        $nodes = array();
        foreach ($input as $line) {
            list($a, $b) = explode("-", $line);
            $nodes[$a] = 1;
            $nodes[$b] = 1;
            if(isset($this->edges[$a])) {
                array_push($this->edges[$a], $b);
            } else {
                $this->edges[$a] = array($b);
            }

            if(isset($this->edges[$b])) {
                array_push($this->edges[$b], $a);
            } else {
                $this->edges[$b] = array($a);
            }
        }
        $this->nodes = array_keys($nodes);
    }

    public function getNodes():array
    {
        return $this->nodes;
    }

    public function getEdges():array
    {
        return $this->edges;
    }
}
