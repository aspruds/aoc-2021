<?php

namespace App\Services;

use Exception;

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
        $most_common_bits = $this->most_common_bits($input);
        $gamma_rate_binary = implode("", $most_common_bits);
        return bindec($gamma_rate_binary);
    }

    private function most_common_bits(array $input): array
    {
        $bit_arrays = array_map('str_split', $input);
        $bit_arrays_transposed = array_map(null, ...$bit_arrays);
        $sums = array_map('array_sum', $bit_arrays_transposed);
        return array_map(fn($count) => $count >= count($input) / 2 ? 1 : 0, $sums);
    }

    private function least_common_bits(array $input): array
    {
        return array_map(fn($el) => 1 - $el, $this->most_common_bits($input));
    }

    private function epsilon_rate(int $gamma_rate): int
    {
        $gamma_rate_binary = decbin($gamma_rate);
        $epsilon_rate_binary = strtr($gamma_rate_binary,[1,0]);
        return bindec($epsilon_rate_binary);
    }

    /**
     * @throws Exception
     */
    public function life_support_rating(array $input): int
    {
        $oxygen_generator_rating = $this->oxygen_generator_rating($input);
        $co2_scrubber_rating = $this->co2_scrubber_rating($input);
        return $oxygen_generator_rating * $co2_scrubber_rating;
    }

    /**
     * @throws Exception
     */
    private function oxygen_generator_rating(array $input): int
    {
        return $this->calculate_rating($input, $this->most_common_bits(...));
    }

    /**
     * @throws Exception
     */
    private function co2_scrubber_rating(array $input): int
    {
        return $this->calculate_rating($input, $this->least_common_bits(...));
    }

    /**
     * @throws Exception
     */
    private function calculate_rating(array $input, $bit_counter_function): int
    {
        $bit_length = strlen($input[0]);
        $filtered = $input;
        for($i=0; $i < $bit_length; $i++) {
            $most_common_bits = $bit_counter_function($filtered);
            $bit = $most_common_bits[$i];
            $filtered = array_filter($filtered, fn($el) => substr($el, $i, 1) == $bit);
            if(count($filtered) == 1) break;
        }

        if(count($filtered) != 1) {
            throw new Exception("filter returned more than one entry");
        }
        $binary_value = array_values($filtered)[0];
        return bindec($binary_value);
    }
}
