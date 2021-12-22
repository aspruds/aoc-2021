<?php

namespace App\Services;

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
        $bit_arrays_transposed = array_map(null, ...$bit_arrays);
        $sums = array_map('array_sum', $bit_arrays_transposed);
        $most_common_bits = array_map(fn($count) => $count > count($input) / 2 ? 1 : 0, $sums);
        $gamma_rate_binary = implode("", $most_common_bits);
        return bindec($gamma_rate_binary);
    }

    private function epsilon_rate(int $gamma_rate): int
    {
        $gamma_rate_binary = decbin($gamma_rate);
        $epsilon_rate_binary = strtr($gamma_rate_binary,[1,0]);
        return bindec($epsilon_rate_binary);
    }
}
