<?php

namespace Tests\Unit;

use App\Services\Day4ServiceA;
use PHPUnit\Framework\TestCase;

class Day4BTest extends TestCase
{
    use TextReader;

    protected Day4ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day4ServiceA();
    }

    public function test_last_board_bingo_winning_score_to_sample(): void
    {
        $input = $this->read_lines('day4-sample.txt');
        $expected = 1924;
        $this->assertEquals($expected, $this->service->lastBoardBingoScore($input));
    }

    public function test_last_board_bingo_winning_score_to_input(): void
    {
        $input = $this->read_lines('day4.txt');
        $expected = 6804;
        $this->assertEquals($expected, $this->service->lastBoardBingoScore($input));
    }
}
