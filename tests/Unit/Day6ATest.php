<?php

namespace Tests\Unit;

use App\Services\Day6ServiceA;
use PHPUnit\Framework\TestCase;

class Day6ATest extends TestCase
{
    use TextReader;

    protected Day6ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day6ServiceA();
    }

    public function test_fish_to_sample(): void
    {
        $input = $this->read_lines('day6-sample.txt');
        $expected = 5934;
        $this->assertEquals($expected, $this->service->fishAfter80Days($input));
    }

    public function test_fish_to_input(): void
    {
        $input = $this->read_lines('day6.txt');
        $expected = 355386;
        $this->assertEquals($expected, $this->service->fishAfter80Days($input));
    }
}
