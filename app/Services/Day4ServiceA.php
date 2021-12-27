<?php

namespace App\Services;

use App\Models\Day4\Board;
use Exception;

class Day4ServiceA
{
    public function bingoScore(array $input): int
    {
        $bingoNumbers = explode(",", $input[0]);
        $bingoBoards = $this->constructBoards($input);

        $bingoScore = 0;
        foreach($bingoNumbers as $calledNumber) {
            foreach($bingoBoards as $board) {
                $board->markNumbers($calledNumber);
                if($board->isWinning()) {
                    $bingoScore = $board->sumUnmarked() * $calledNumber;
                    break 2;
                }
            }
        }
        return $bingoScore;
    }

    public function lastBoardBingoScore(array $input): int
    {
        $bingoNumbers = explode(",", $input[0]);
        $bingoBoards = $this->constructBoards($input);

        $bingoScore = 0;
        $winningBoards = array();

        foreach($bingoNumbers as $calledNumber) {
            foreach($bingoBoards as $board) {
                $board->markNumbers($calledNumber);
                if($board->isWinning()) {
                    if(in_array($board->getId(), $winningBoards)) {
                        continue;
                    }
                    $winningBoards[] = $board->getId();

                    if(count($winningBoards) == count($bingoBoards)) {
                        $bingoScore = $board->sumUnmarked() * $calledNumber;
                        break 2;
                    }
                }
            }
        }
        return $bingoScore;
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
