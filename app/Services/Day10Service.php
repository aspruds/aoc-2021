<?php

namespace App\Services;

use Exception;

class Day10Service
{
    public function totalSyntaxErrorScore(array $input, bool $considerIncompleteLines = false): int
    {
        $lineErrorScores = array_map(/**
         * @throws Exception
         */ fn($line) => $this->syntaxErrorScore($line, $considerIncompleteLines), $input);
        if($considerIncompleteLines) {
            $values = array_values(array_filter($lineErrorScores, fn($el) => $el != -1));
            sort($values);
            $idx = floor((count($values)-1) / 2);
            return $values[$idx];
        } else {
            return array_sum($lineErrorScores);
        }
    }

    /**
     * @throws Exception
     */
    private function syntaxErrorScore(string $line, bool $considerIncompleteLines = false): int
    {
        $stack = array();
        $openingChars = array('(', '[', '{', '<');
        $closingChars = array(')', ']', '}', '>');
        foreach (str_split($line )as $character) {
            if(in_array($character, $openingChars)) {
                array_push($stack, $character);
            }

            if(in_array($character, $closingChars)) {
                $openingChar = $this->openingChar($character);
                $charFromStack = array_pop($stack);
                if($charFromStack != $openingChar) {
                    if($considerIncompleteLines) {
                        return -1;
                    } else {
                        return $this->invalidScore($character);;
                    }
                }
            }
        }
        if($considerIncompleteLines) {
            return $this->autoCompleteScore($stack);
        } else {
            return 0;
        }
    }

    /**
     * @throws Exception
     */
    private function invalidScore($character): int
    {
        return match ($character) {
            ")" => 3,
            "]" => 57,
            "}" => 1197,
            ">" => 25137,
            default => throw new Exception("unexpected closing char: $character")
        };
    }

    /**
     * @throws Exception
     */
    private function autoCompleteScore($stack): int
    {
        $stack = array_reverse($stack);
        $totalScore = 0;
        foreach($stack as $openingChar) {
            $totalScore = 5 * $totalScore;
            $closingChar = $this->closingChar($openingChar);
            $totalScore = $totalScore + $this->autoCompleteScoreForChar($closingChar);
        }
        return $totalScore;
    }

    /**
     * @throws Exception
     */
    private function autoCompleteScoreForChar($closingChar): int
    {
        return match ($closingChar) {
            ")" => 1,
            "]" => 2,
            "}" => 3,
            ">" => 4,
            default => throw new Exception("unexpected closing char: $closingChar")
        };
    }

    /**
     * @throws Exception
     */
    private function openingChar($closingChar): string
    {
        return match ($closingChar) {
            ")" => "(",
            "]" => "[",
            "}" => "{",
            ">" => "<",
            default => throw new Exception("unexpected closing char: $closingChar")
        };
    }

    /**
     * @throws Exception
     */
    private function closingChar($openingChar): string
    {
        return match ($openingChar) {
            "(" => ")",
            "[" => "]",
            "{" => "}",
            "<" => ">",
            default => throw new Exception("unexpected closing char: $openingChar")
        };
    }
}
