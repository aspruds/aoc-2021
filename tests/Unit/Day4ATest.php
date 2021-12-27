<?php

namespace Tests\Unit;

use App\Services\Day4ServiceA;
use PHPUnit\Framework\TestCase;

class Day4ATest extends TestCase
{
    use TextReader;

    protected Day4ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day4ServiceA();
    }

    public function test_bingo_winning_score_to_sample(): void
    {
        $input = $this->read_lines('day4-sample.txt');
        $expected = 4512;
        $this->assertEquals($expected, $this->service->bingoScore($input));
    }

    public function test_bingo_winning_score_to_input(): void
    {
        $input = $this->read_lines('day4.txt');
        $expected = 23177;
        $this->assertEquals($expected, $this->service->bingoScore($input));
    }
}
