<?php

namespace Tests\Unit;

use App\Services\Day12Service;
use PHPUnit\Framework\TestCase;

class Day12Test extends TestCase
{
    use TextReader;

    protected Day12Service $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day12Service();
    }

    /*
    public function test_small_cave_paths_to_sample(): void
    {
        $input = $this->read_lines('day12-sample.txt');
        $expected = 10;
        $this->assertEquals($expected, $this->service->smallCavePaths($input));
    }

    public function test_advanced_small_cave_paths_to_sample(): void
    {
        $input = $this->read_lines('day12-sample.txt');
        $expected = 36;
        $this->assertEquals($expected, $this->service->advancedSmallCavePaths($input));
    }

    public function test_small_cave_paths_to_input(): void
    {
        $input = $this->read_lines('day12.txt');
        $expected = 3738;
        $this->assertEquals($expected, $this->service->smallCavePaths($input));
    }

    public function test_advanced_cave_paths_to_input(): void
    {
        $input = $this->read_lines('day12.txt');
        $expected = 120506;
        $this->assertEquals($expected, $this->service->advancedSmallCavePaths($input));
    }
    */
}
