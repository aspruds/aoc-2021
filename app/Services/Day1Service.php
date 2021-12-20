<?php

namespace App\Services;

class Day1Service
{
    public function increases(array $input): int
    {
        $increases = 0;
        $prev = null;
        for($i=0; $i < count($input); $i++) {
            $curr = $input[$i];
            if($prev != null && $curr > $prev) {
                $increases++;
            }
            $prev = $curr;
        }
        return $increases;
    }

    public function increases_sliding_window(array $input, $window_length = 3): int
    {
        $windows = array();
        for($i=0; $i < count($input); $i++) {
            $windows[] = array_slice($input, $i, $window_length);
        }
        $sums = array_map('array_sum', $windows);
        return $this->increases($sums);
    }
}
