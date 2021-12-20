<?php

namespace App\Services;

class Day2Service
{
    public function course(array $input): int
    {
        $horizontal = 0;
        $depth = 0;

        $commands = array_map(fn($i) => explode(" ", $i), $input);
        foreach($commands as $command) {
            list($horizontal, $depth) = $this->apply_command($command, $horizontal, $depth);
        }
        return $horizontal * $depth;
    }

    private function apply_command($command, $horizontal, $depth): array
    {
        list($move, $amount) = $command;
        return match ($move) {
            'forward' => array($horizontal + $amount, $depth),
            'down' => array($horizontal, $depth + $amount),
            'up' => array($horizontal, $depth - $amount)
        };
    }
}
