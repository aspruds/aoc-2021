<?php

namespace Tests\Unit;

use App\Services\Day9Service;
use PHPUnit\Framework\TestCase;

class Day9Test extends TestCase
{
    use TextReader;

    protected Day9Service $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day9Service();
    }

    public function test_risk_level_to_sample(): void
    {
        $input = $this->read_lines('day9-sample.txt');
        $expected = 15;
        $this->assertEquals($expected, $this->service->riskLevel($input));
    }

    public function test_basin_total_to_sample(): void
    {
        $input = $this->read_lines('day9-sample.txt');
        $expected = 1134;
        $this->assertEquals($expected, $this->service->basinTotal($input));
    }

    public function test_risk_level_to_input(): void
    {
        $input = $this->read_lines('day9.txt');
        $expected = 633;
        $this->assertEquals($expected, $this->service->riskLevel($input));
    }

    public function test_basin_total_to_input(): void
    {
        $input = $this->read_lines('day9.txt');
        $expected = 1134;
        $this->assertEquals($expected, $this->service->basinTotal($input));
    }
}
