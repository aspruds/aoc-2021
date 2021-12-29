<?php

namespace App\Services;

use Exception;
use JetBrains\PhpStorm\Pure;

class Day7ServiceA
{
    /**
     * @throws Exception
     */
    public function fuelPartA(array $numbers): int
    {
        $median = $this->median($numbers);
        $fuel = 0;
        foreach($numbers as $vpos) {
          $fuel = $fuel + abs($vpos - $median);
        }
        return $fuel;
    }

    public function fuelPartB(array $numbers, $mean = null) {
        $min = min($numbers);
        $max = max($numbers);
        $costs = array();
        for($i=$min; $i < $max; $i++) {
            $cost = $this->fuelPartBCost($numbers, $i);
            $costs[] = $cost;
        }
        return min($costs);
    }

    public function fuelPartBCost(array $numbers, $mean = null) {
        /*
        if(!$mean) {
            $mean = $this->mean($numbers);
        }
        */

        $fuel = 0;
        foreach($numbers as $vpos) {
            $fuel = $fuel + $this->fuelForMoveDiff($vpos, $mean);
        }
        return $fuel;
    }

    /**
     * @throws Exception
     */
    public function median(array $numbers) {
        print(count($numbers));
        if(count($numbers) % 2 != 0) {
            throw new Exception("this implementation of median only works for even numbers");
        }
        $copy = $numbers;
        sort($copy);
        return $copy[count($copy)/2];
    }

    public function mean(array $numbers): int {
        return round(array_sum($numbers) / count($numbers), 0, PHP_ROUND_HALF_DOWN);
    }

    #[Pure] public function fuelForMoveDiff(int $a, int $b): int {
        return $this->fuelForMove(abs($a - $b));
    }

    public function fuelForMove(int $difference): int {
        if($difference == 0) {
            return 0;
        }

        $sum = 0;
        for($i=1; $i < $difference + 1; $i++) {
            $sum = $sum + $i;
        }
        return $sum;
    }
}
