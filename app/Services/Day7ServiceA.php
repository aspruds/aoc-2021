<?php

namespace App\Services;

class Day7ServiceA
{
    public function fuel(array $input, $median): int
    {
        $input = explode(",", $input[0]);
        $fuel = 0;
        foreach($input as $vpos) {
          $fuel = $fuel + abs($vpos - $median);
        }
        return $fuel;
    }
}
