<?php

namespace Tests\Unit;

use App\Services\Day6ServiceA;
use PHPUnit\Framework\TestCase;

class Day6BTest extends TestCase
{
    use TextReader;

    protected Day6ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day6ServiceA();
    }

    public function test_fish_to_sample(): void
    {
        $input = $this->readLines('day6-sample.txt');
        $expected = 26984457539;
        $this->assertEquals($expected, $this->service->fishAfter256Days($input));
    }

    public function test_fish_to_input(): void
    {
        $input = $this->readLines('day6.txt');
        $expected = 1613415325809;
        $this->assertEquals($expected, $this->service->fishAfter256Days($input));
    }
}
