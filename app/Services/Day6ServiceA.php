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
        $fish = explode(",", $input[0]);
        for($i=0; $i < 80; $i++) {
            $zeros = array_filter($fish, fn($el) => $el == 0);
            $nextGen = array_map(function($el) {
                if($el == 0) {
                    return 6;
                } else {
                    return $el - 1;
                }
            }, $fish);
            foreach($zeros as $zero) {
                $nextGen[] = 8;
            }
            $fish = $nextGen;
        }
        return count($fish);
    }

    public function fishAfter256Days(array $input): int
    {
        $fish = explode(",", $input[0]);
        print_r($fish);
        for($i=0; $i < 80; $i++) {
            print($i . "\n");
            $zeros = array_filter($fish, fn($el) => $el == 0);
            $nextGen = array_map(function($el) {
                if($el == 0) {
                    return 6;
                } else {
                    return $el - 1;
                }
            }, $fish);
            foreach($zeros as $zero) {
                $nextGen[] = 8;
            }
            $fish = $nextGen;
            print_r($fish);
        }
        return count($fish);
    }
}
