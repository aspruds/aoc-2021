<?php

namespace App\Services;

use Exception;
use JetBrains\PhpStorm\Pure;

class Day8ServiceA
{
    /**
     * @throws Exception
     */
    public function simpleDigits(array $input): int
    {
        $simpleDigits = 0;
        foreach ($input as $line) {
            $outputPart = explode(" | ", $line);
            $outputDigits = explode(" ", $outputPart[1]);
            foreach($outputDigits as $outputDigit) {
                if(strlen($outputDigit) == 2) {
                    $simpleDigits++;
                }
                if(strlen($outputDigit) == 3) {
                    $simpleDigits++;
                }
                if(strlen($outputDigit) == 4) {
                    $simpleDigits++;
                }
                if(strlen($outputDigit) == 7) {
                    $simpleDigits++;
                }
            }
        }
        return $simpleDigits;
    }
}
