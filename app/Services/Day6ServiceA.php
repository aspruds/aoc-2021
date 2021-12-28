<?php

namespace App\Services;

use App\Models\Day5\Line;
use App\Models\Day5\Point;
use App\Models\Day5\Board;
use JetBrains\PhpStorm\Pure;

class Day6ServiceA
{
    public function fishAfter80Days(array $input): int
    {
        return $this->fishAfterDays($input, 80);
    }

    public function fishAfter256Days(array $input): int
    {
        return $this->fishAfterDays($input, 256);
    }

    private function fishAfterDays(array $input, int $days): int
    {
        $fish = explode(",", $input[0]);
        $counts = array_count_values($fish);
        for($i=0; $i < $days; $i++) {
            $newCounts = array();
            for($key=1; $key < 9; $key++) {
                $value = $counts[$key] ?? 0;
                if($value > 0) {
                    $newCounts[$key - 1] = $value;
                }
            }
            $zeros = $counts[0] ?? 0;
            if($zeros > 0) {
                $newCounts[8] = $zeros;
                $newCounts[6] = ($newCounts[6] ?? 0) + $zeros;
            }
            $counts = $newCounts;
        }
        return array_sum($counts);
    }
}
