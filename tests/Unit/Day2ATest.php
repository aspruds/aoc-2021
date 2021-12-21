<?php

namespace Tests\Unit;

use App\Services\Day2ServiceA;
use PHPUnit\Framework\TestCase;

class Day2ATest extends TestCase
{
    use TextReader;

    protected Day2ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day2ServiceA();
    }

    public function test_one_course(): void
    {
        $input = $input = $this->read_lines('day2-sample.txt');
        $expected = 150;
        $this->assertEquals($expected, $this->service->course($input));
    }

    public function test_provided_increases(): void
    {
        $input = $this->read_lines('day2.txt');
        $expected = 1698735;
        $this->assertEquals($expected, $this->service->course($input));
    }
}
