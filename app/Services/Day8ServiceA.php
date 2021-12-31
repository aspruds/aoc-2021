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

    /**
     * @throws Exception
     */
    public function allDigits(array $input): int
    {
        $decodedAccumulator = array();
        foreach ($input as $line) {
            $parts = explode(" | ", $line);
            $observations = explode(" ", $parts[0]);
            $outputDigits = explode(" ", $parts[1]);

            $digitMapping = $this->decodeObservations($observations);
            $decodedDigits = $this->decodeDigits($outputDigits, $digitMapping);
            $decodedAccumulator[] = $decodedDigits;
        }
        return array_sum($decodedAccumulator);
    }

    /**
     * @throws Exception
     */
    function decodeDigits($outputDigits, $digitMapping): int
    {
        $result = array();
        foreach($outputDigits as $outputDigit) {
            for($i=0; $i < 10; $i++) {
                $mapping = $digitMapping[$i];
                if(strlen($outputDigit) == strlen($mapping)) {
                    if (strlen($this->different($outputDigit, $mapping)) == 0) {
                        $result[] = $i;
                    }
                }
            }
        }
        if(count($result) != 4) {
            throw new Exception("expecting 4 decoded digits!");
        }
        return (int)implode("", $result);
    }

    /**
     * @throws Exception
     */
    private function decodeObservations($observations): array
    {
        $one = $this->findByLength($observations, 2)[0];
        $seven = $this->findByLength($observations, 3)[0];
        $four = $this->findByLength($observations, 4)[0];
        $eight = $this->findByLength($observations, 7)[0];

        // 0, 1, 2, 3, 4, 5, 6, 7, 8, 9
        $bd = $this->different($four, $one);

        $cf = $one;

        $eg = $this->different($eight, $seven . $bd);

        $zeroSixOrNine = $this->findByLength($observations, 6);
        $nine = $this->findCommon($zeroSixOrNine, $seven . $bd);
        $zero = $this->findCommon($zeroSixOrNine, $seven . $eg);
        $six = array_values(array_filter($zeroSixOrNine, fn($el) => !in_array($el, array($nine, $zero))))[0];

        $e = $this->different($eight, $nine);

        $d = $this->different($eight, $zero);

        $b = $this->different($bd, $d);

        $c = $this->different($eight, $six);

        $f = $this->different($cf, $c);

        $five = $this->different($nine, $c);
        $two = $this->different($eight, $b . $f);
        $three = $this->different($eight, $e . $b);

        return array(
            $zero,
            $one,
            $two,
            $three,
            $four,
            $five,
            $six,
            $seven,
            $eight,
            $nine
        );
    }

    private function findCommon(array $candidates, string $b): string
    {
        $found = null;
        foreach ($candidates as $candidate) {
            if(strlen($this->common($candidate, $b)) == strlen($b)) {
                $found = $candidate;
                break;
            }
        }
        if($found == null) {
            throw new Exception("$b not found in $candidates");
        }
        return $found;
    }

    private function common(string $a, string $b): string
    {
        $aArray = str_split($a);
        $bArray = str_split($b);
        return implode("", array_intersect($aArray, $bArray));
    }

    private function different(string $a, string $b): string
    {
        $aArray = str_split($a);
        $bArray = str_split($b);
        return implode("", array_diff($aArray, $bArray));
    }

    /**
     * @throws Exception
     */
    private function findByLength(array $observations, int $length): array
    {
        $result = array_filter($observations, fn($el) => strlen($el) === $length);
        if(count($result) == 0) {
            throw new Exception("entry not found!");
        }
        return array_values($result);
    }

    function sortLetters($entry): string
    {
        $parts = str_split($entry);
        sort($parts);
        return implode("", $parts);
    }

    function sort($a,$b): int
    {
        return strlen($a) - strlen($b);
    }
}
