<?php

namespace Tests\Unit;

use App\Services\Day3ServiceA;
use PHPUnit\Framework\TestCase;

class Day3ATest extends TestCase
{
    use TextReader;

    protected Day3ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day3ServiceA();
    }

    public function test_power_consumption_according_to_sample(): void
    {
        $input = $this->read_lines('day3-sample.txt');
        $expected = 198;
        $this->assertEquals($expected, $this->service->power_consumption($input));
    }

    public function test_power_consumption_according_to_input(): void
    {
        $input = $this->read_lines('day3.txt');
        $expected = 3320834;
        $this->assertEquals($expected, $this->service->power_consumption($input));
    }
}
