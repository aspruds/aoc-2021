<?php

namespace Tests\Unit;

use App\Services\Day8ServiceA;
use Exception;
use PHPUnit\Framework\TestCase;

class Day8ATest extends TestCase
{
    use TextReader;

    protected Day8ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day8ServiceA();
    }

    public function test_simple_numbers_to_sample(): void
    {
        $input = $this->read_lines('day8-sample.txt');
        $expected = 26;
        $this->assertEquals($expected, $this->service->simpleDigits($input));
    }

    public function test_simple_numbers_to_input(): void
    {
        $input = $this->read_lines('day8.txt');
        $expected = 26;
        $this->assertEquals($expected, $this->service->simpleDigits($input));
    }
}
