<?php

namespace Tests\Unit;

use Exception;
use App\Services\Day3ServiceA;
use PHPUnit\Framework\TestCase;

class Day3BTest extends TestCase
{
    use TextReader;

    protected Day3ServiceA $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day3ServiceA();
    }

    /**
     * @throws Exception
     */
    public function test_life_support_according_to_sample(): void
    {
        $input = $this->read_lines('day3-sample.txt');
        $expected = 230;
        $this->assertEquals($expected, $this->service->life_support_rating($input));
    }

    /**
     * @throws Exception
     */
    public function test_life_support_according_to_input(): void
    {
        $input = $this->read_lines('day3.txt');
        $expected = 4481199;
        $this->assertEquals($expected, $this->service->life_support_rating($input));
    }
}
