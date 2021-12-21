<?php

namespace App\Services;

class Day2ServiceB
{
    public function course(array $input): int
    {
        $horizontal = 0;
        $depth = 0;
        $aim = 0;

        $commands = array_map(fn($i) => explode(" ", $i), $input);
        foreach($commands as $command) {
            list($horizontal, $depth, $aim) = $this->apply_command($command, $horizontal, $depth, $aim);
        }
        return $horizontal * $depth;
    }

    private function apply_command($command, $horizontal, $depth, $aim): array
    {
        list($move, $amount) = $command;
        return match ($move) {
            'forward' => array($horizontal + $amount, $depth + $aim * $amount, $aim),
            'down' => array($horizontal, $depth, $aim + $amount),
            'up' => array($horizontal, $depth, $aim - $amount)
        };
    }
}
