<?php

namespace App\Services;

use App\Models\Day2\Command;
use App\Models\Day2\State;
use JetBrains\PhpStorm\Pure;

class Day3ServiceA
{
    public function power_consumption(array $input): int
    {
        $gamma_rate = $this->gamma_rate($input);
        $epsilon_rate = $this->epsilon_rate($gamma_rate);
        return $gamma_rate * $epsilon_rate;
    }

    private function gamma_rate(array $input): int
    {
        $bit_arrays = array_map('str_split', $input);
        $flat_bit_array = array_reduce($bit_arrays, array($this, 'bit_reducer'));
        $sums = array_map('array_sum', $flat_bit_array);
        $bits = array_map(fn($count) => $count > count($input) / 2 ? 1 : 0, $sums);
        $binary = implode("", $bits);
        return bindec($binary);
    }

    private function bit_reducer($carry, $item) {
        if(!$carry) {
            $carry = array();
        }
        for($pos=0; $pos < count($item); $pos++){
            if(!isset($carry[$pos])) {
                $carry[$pos] = array();
            }
            $carry[$pos][] = $item[$pos];
        }
        return $carry;
    }

    private function epsilon_rate(int $gamma_rate): int
    {
        $gamma_bits = decbin($gamma_rate);
        $epsilon_bits = strtr($gamma_bits,[1,0]);
        return bindec($epsilon_bits);
    }
}
