<?php

namespace Tests\Unit;

use App\Services\Day1Service;
use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    use TextReader;

    protected Day1Service $day1Service;

    public function setUp():void {
        parent::setUp();
        $this->day1Service = new Day1Service();
    }

    public function test_one_sliding_window(): void
    {
        $input = array(199, 200, 208, 210, 200, 207, 240, 269, 260, 263);
        $expected = 5;
        $this->assertEquals($expected, $this->day1Service->increases_sliding_window($input));
    }

    public function test_provided_sliding_window(): void
    {
        $input = $this->read_lines('day1.txt');
        $expected = 1158;
        $this->assertEquals($expected, $this->day1Service->increases_sliding_window($input));
    }
}
