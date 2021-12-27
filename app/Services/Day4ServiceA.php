<?php

namespace App\Services;

use App\Models\Day4\Board;
use Exception;

class Day4ServiceA
{
    /**
     * @throws Exception
     */
    public function firstBingoScore(array $input): int
    {
        $scores = $this->bingoScores($input);
        return reset($scores);
    }

    /**
     * @throws Exception
     */
    public function lastBoardBingoScore(array $input): int
    {
        $scores = $this->bingoScores($input);
        return end($scores);
    }

    /**
     * @throws Exception
     */
    private function bingoScores($input): array
    {
        $bingoNumbers = explode(",", $input[0]);
        $bingoBoards = $this->constructBoards($input);

        $bingoScores = array();
        $winningBoards = array();

        foreach($bingoNumbers as $calledNumber) {
            foreach($bingoBoards as $board) {
                $board->markNumbers($calledNumber);
                if($board->isWinning()) {
                    if(in_array($board->getId(), $winningBoards)) {
                        continue;
                    }
                    $winningBoards[] = $board->getId();
                    $bingoScores[] = $board->sumUnmarked() * $calledNumber;
                }
            }
        }

        if(count($bingoScores) == 0) {
            throw new Exception("there are no winning boards");
        }
        return $bingoScores;
    }

    private function constructBoards($input): array {
        $input = array_splice($input, 2);
        $input = implode("\n", $input);
        $boardDefinitions = explode("\n\n", $input);
        $boards = array_map(fn($definition) => new Board($definition), $boardDefinitions);
        for($i=0; $i < count($boards); $i++) {
            $boards[$i]->setId($i);
        }
        return $boards;
    }
}
