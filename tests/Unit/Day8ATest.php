<?php

namespace Tests\Unit;

use App\Services\Day7ServiceA;
use Exception;
use PHPUnit\Framework\TestCase;

class Day7ATest extends TestCase
{
    use TextReader;

    protected Day7ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day7ServiceA();
    }

    private function read($fileName): array
    {
        $input = $this->read_lines($fileName);
        return explode(",", $input[0]);
    }

    public function test_fuel_to_sample(): void
    {
        $input = $this->read('day7-sample.txt');
        $expected = 37;
        $this->assertEquals($expected, $this->service->fuelPartA($input));
    }

    /**
     * @throws Exception
     */
    public function test_median_to_sample(): void
    {
        $input = $this->read('day7-sample.txt');
        $expected = 2;
        $this->assertEquals($expected, $this->service->median($input));
    }

    public function test_fuel_to_input(): void
    {
        $input = $this->read('day7.txt');
        $expected = 345035;
        $this->assertEquals($expected, $this->service->fuelPartA($input));
    }

    /**
     * @throws Exception
     */
    public function test_median_to_input(): void
    {
        $input = $this->read('day7.txt');
        $expected = 350;
        $this->assertEquals($expected, $this->service->median($input));
    }
}
