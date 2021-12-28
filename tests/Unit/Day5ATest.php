<?php

namespace Tests\Unit;

use App\Services\Day5ServiceA;
use PHPUnit\Framework\TestCase;

class Day5ATest extends TestCase
{
    use TextReader;

    protected Day5ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day5ServiceA();
    }

    public function test_number_of_points_where_two_points_overlap_to_sample(): void
    {
        $input = $this->read_lines('day5-sample.txt');
        $expected = 5;
        $this->assertEquals($expected, $this->service->numberOfPointsWhereTwoPointsOverlap($input));
    }

    public function stest_number_of_points_where_two_points_overlap_to_input(): void
    {
        $input = $this->read_lines('day5.txt');
        $expected = 7085;
        $this->assertEquals($expected, $this->service->numberOfPointsWhereTwoPointsOverlap($input));
    }
}
