<?php

namespace Tests\Unit;

use App\Services\Day5ServiceA;
use PHPUnit\Framework\TestCase;

class Day5BTest extends TestCase
{
    use TextReader;

    protected Day5ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day5ServiceA();
    }

    public function test_number_of_points_where_two_points_overlap_to_sample(): void
    {
        $input = $this->readLines('day5-my.txt');
        $expected = 12;
        $this->assertEquals($expected, $this->service->numberOfPointsWhereTwoPointsOverlapDiagonally($input));
    }

    public function test_number_of_points_where_two_points_overlap_to_input(): void
    {
        $input = $this->readLines('day5.txt');
        $expected = 20271;
        $this->assertEquals($expected, $this->service->numberOfPointsWhereTwoPointsOverlapDiagonally($input));
    }
}
