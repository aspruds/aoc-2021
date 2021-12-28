<?php

namespace Tests\Unit;

use App\Services\Day7ServiceA;
use PHPUnit\Framework\TestCase;

class Day7ATest extends TestCase
{
    use TextReader;

    protected Day7ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day7ServiceA();
    }

    public function test_fuel_to_sample(): void
    {
        $input = $this->read_lines('day7-sample.txt');
        $expected = 37;
        $this->assertEquals($expected, $this->service->fuel($input, 2));
    }

    public function test_fuel_to_input(): void
    {
        $input = $this->read_lines('day7.txt');
        $expected = 345035;
        $this->assertEquals($expected, $this->service->fuel($input, 350));
    }
}
