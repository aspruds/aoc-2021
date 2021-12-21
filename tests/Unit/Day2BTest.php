<?php

namespace Tests\Unit;

use App\Services\Day2ServiceB;
use PHPUnit\Framework\TestCase;

class Day2BTest extends TestCase
{
    use TextReader;

    protected Day2ServiceB $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day2ServiceB();
    }

    public function test_one_course(): void
    {
        $input = $this->read_lines('day2-sample.txt');
        $expected = 900;
        $this->assertEquals($expected, $this->service->course($input));
    }

    public function test_provided_increases(): void
    {
        $input = $this->read_lines('day2.txt');
        $expected = 1594785890;
        $this->assertEquals($expected, $this->service->course($input));
    }
}
