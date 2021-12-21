<?php

namespace App\Services;

use App\Models\Day2\Command;
use App\Models\Day2\State;
use JetBrains\PhpStorm\Pure;

class Day2ServiceB
{
    public function course(array $input): int
    {
        $state = new State(0, 0, 0);
        $commands = array_map(array($this, 'createCommand'), $input);
        foreach($commands as $command) {
            $state = $this->apply_command($command, $state);
        }
        return $state->horizontal * $state->depth;
    }

    #[Pure] private function createCommand(string $line): Command
    {
        $parts = explode(" ", $line);
        return new Command($parts[0], $parts[1]);
    }

    private function apply_command(Command $command, $oldState): State
    {
        return match ($command->move) {
            'forward' => $oldState
                ->withHorizontal($oldState->horizontal + $command->amount)
                ->withDepth($oldState->depth + $oldState->aim * $command->amount),
            'down' => $oldState->withAim($oldState->aim + $command->amount),
            'up' => $oldState->withAim($oldState->aim - $command->amount)
        };
    }
}
