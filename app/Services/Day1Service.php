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
}
