<?php

namespace Tests\Unit;

use App\Services\Day11Service;
use PHPUnit\Framework\TestCase;

class Day11Test extends TestCase
{
    use TextReader;

    protected Day11Service $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day11Service();
    }

    public function test_flash_count_to_sample(): void
    {
        $input = $this->readLines('day11-sample.txt');
        $expected = 1656;
        $this->assertEquals($expected, $this->service->flashCount($input));
    }

    public function test_flash_count_simultaneous_to_sample(): void
    {
        $input = $this->readLines('day11-sample.txt');
        $expected = 195;
        $this->assertEquals($expected, $this->service->flashCountSimultaneous($input));
    }

    public function test_flash_count_to_input(): void
    {
        $input = $this->readLines('day11.txt');
        $expected = 1585;
        $this->assertEquals($expected, $this->service->flashCount($input));
    }

    public function test_flash_count_simultaneous_to_input(): void
    {
        $input = $this->readLines('day11.txt');
        $expected = 382;
        $this->assertEquals($expected, $this->service->flashCountSimultaneous($input));
    }
}
