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
        $input = $this->readLines('day8-sample.txt');
        $expected = 26;
        $this->assertEquals($expected, $this->service->simpleDigits($input));
    }

    public function test_all_numbers_to_sample(): void
    {
        $input = $this->readLines('day8-sample.txt');
        $expected = 61229;
        $this->assertEquals($expected, $this->service->allDigits($input));
    }

    public function test_simple_numbers_to_input(): void
    {
        $input = $this->readLines('day8.txt');
        $expected = 381;
        $this->assertEquals($expected, $this->service->simpleDigits($input));
    }

    public function test_all_numbers_to_input(): void
    {
        $input = $this->readLines('day8.txt');
        $expected = 1023686;
        $this->assertEquals($expected, $this->service->allDigits($input));
    }
}
