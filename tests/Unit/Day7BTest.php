<?php

namespace Tests\Unit;

use App\Services\Day7ServiceA;
use Exception;
use PHPUnit\Framework\TestCase;

class Day7BTest extends TestCase
{
    use TextReader;

    protected Day7ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day7ServiceA();
    }

    private function read($fileName): array
    {
        $input = $this->readLines($fileName);
        return explode(",", $input[0]);
    }

    public function test_fuel_to_sample(): void
    {
        $input = $this->read('day7-sample.txt');
        $expected = 168;
        $this->assertEquals($expected, $this->service->fuelPartB($input));
    }

    /**
     * @throws Exception
     */
    public function test_mean_to_sample(): void
    {
        $input = $this->read('day7-sample.txt');
        $expected = 5;
        $this->assertEquals($expected, $this->service->mean($input));
    }

    public function disabled_test_fuel_to_input(): void
    {
        $input = $this->read('day7.txt');
        $expected = 97038163;
        $this->assertEquals($expected, $this->service->fuelPartB($input));
    }

    public function test_fuel_for_move_1(): void
    {
        $input = 1;
        $expected = 1;
        $this->assertEquals($expected, $this->service->fuelForMove($input));
    }

    public function test_fuel_for_move_2(): void
    {
        $input = 4;
        $expected = 10;
        $this->assertEquals($expected, $this->service->fuelForMove($input));
    }

    public function test_fuel_for_move_3(): void
    {
        $input = 0;
        $expected = 0;
        $this->assertEquals($expected, $this->service->fuelForMove($input));
    }

    public function test_fuel_for_move_diff_1(): void
    {
        $input = array(0, 0);
        $expected = 0;
        $this->assertEquals($expected, $this->service->fuelForMoveDiff(...$input));
    }

    public function test_fuel_for_move_diff_2(): void
    {
        $input = array(16, 5);
        $expected = 66;
        $this->assertEquals($expected, $this->service->fuelForMoveDiff(...$input));
    }

    public function test_fuel_for_move_diff_3(): void
    {
        $input = array(1, 5);
        $expected = 10;
        $this->assertEquals($expected, $this->service->fuelForMoveDiff(...$input));
    }

    public function test_fuel_for_move_diff_4(): void
    {
        $input = array(2, 5);
        $expected = 6;
        $this->assertEquals($expected, $this->service->fuelForMoveDiff(...$input));
    }

    public function test_fuel_for_move_diff_5(): void
    {
        $input = array(0, 5);
        $expected = 15;
        $this->assertEquals($expected, $this->service->fuelForMoveDiff(...$input));
    }

    public function test_fuel_for_move_diff_6(): void
    {
        $input = array(4, 5);
        $expected = 1;
        $this->assertEquals($expected, $this->service->fuelForMoveDiff(...$input));
    }

    public function test_fuel_for_move_diff_7(): void
    {
        $input = array(7, 5);
        $expected = 3;
        $this->assertEquals($expected, $this->service->fuelForMoveDiff(...$input));
    }

    public function test_fuel_for_move_diff_8(): void
    {
        $input = array(14, 5);
        $expected = 45;
        $this->assertEquals($expected, $this->service->fuelForMoveDiff(...$input));
    }

    /**
     * @throws Exception
     */
    public function test_mean_to_input(): void
    {
        $input = $this->read('day7.txt');
        $expected = 479;
        $this->assertEquals($expected, $this->service->mean($input));
    }
}
