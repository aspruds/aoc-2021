<?php

namespace Tests\Unit;

use App\Services\Day10Service;
use PHPUnit\Framework\TestCase;

class Day10Test extends TestCase
{
    use TextReader;

    protected Day10Service $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day10Service();
    }

    public function test_total_syntax_error_score_to_sample(): void
    {
        $input = $this->read_lines('day10-sample.txt');
        $expected = 26397;
        $this->assertEquals($expected, $this->service->totalSyntaxErrorScore($input));
    }

    public function test_total_syntax_error_score_with_incomplete_to_sample(): void
    {
        $input = $this->read_lines('day10-sample.txt');
        $expected = 288957;
        $this->assertEquals($expected, $this->service->totalSyntaxErrorScore($input, true));
    }

    public function test_total_syntax_error_score_to_input(): void
    {
        $input = $this->read_lines('day10.txt');
        $expected = 216297;
        $this->assertEquals($expected, $this->service->totalSyntaxErrorScore($input));
    }

    public function test_total_syntax_error_score_with_incomplete_to_input(): void
    {
        $input = $this->read_lines('day10.txt');
        $expected = 2165057169;
        $this->assertEquals($expected, $this->service->totalSyntaxErrorScore($input, true));
    }
}
