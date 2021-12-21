<?php

namespace Tests\Unit;

use App\Services\Day2ServiceB;
use PHPUnit\Framework\TestCase;

class Day2BTest extends TestCase
{
    use CsvReader;

    protected Day2ServiceB $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day2ServiceB();
    }

    public function test_one_course(): void
    {
        $input = array(
            "forward 5",
            "down 5",
            "forward 8",
            "up 3",
            "down 8",
            "forward 2"
        );
        $expected = 900;
        $this->assertEquals($expected, $this->service->course($input));
    }

    public function test_provided_increases(): void
    {
        $input = $this->read_csv('day2.csv');
        $expected = 1698735;
        $this->assertEquals($expected, $this->service->course($input));
    }
}
