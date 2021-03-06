<?php

namespace Tests\Unit;

use App\Services\Day1Service;
use PHPUnit\Framework\TestCase;

class Day1ATest extends TestCase
{
    use TextReader;

    protected Day1Service $day1Service;

    public function setUp():void {
        parent::setUp();
        $this->day1Service = new Day1Service();
    }

    public function test_one_increase(): void
    {
        $input = array(1, 2, 1, 2);
        $expected = 2;
        $this->assertEquals($expected, $this->day1Service->increases($input));
    }

    public function test_provided_increases(): void
    {
        $input = $this->readLines('day1.txt');
        $expected = 1184;
        $this->assertEquals($expected, $this->day1Service->increases($input));
    }
}
