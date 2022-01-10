<?php

namespace Tests\Unit;

use App\Services\Day13Service;
use PHPUnit\Framework\TestCase;

class Day13Test extends TestCase
{
    use TextReader;

    protected Day13Service $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day13Service();
    }

    public function test_count_dots_after_first_fold_to_sample(): void
    {
        $input = $this->readAsString('day13-sample.txt');
        $expected = 17;
        $this->assertEquals($expected, $this->service->dotsAfterFirstFold($input));
    }

    /*
    public function test_count_dots_after_first_fold_to_input(): void
    {
        $input = $this->readAsString('day13.txt');
        $expected = 689;
        $this->assertEquals($expected, $this->service->dotsAfterFirstFold($input));
    }

    public function test_count_dots_after_all_folds_to_input(): void
    {
        $input = $this->readAsString('day13.txt');
        $expected = 42;
        $this->assertEquals($expected, $this->service->dotsAfterAllFolds($input));
    }
    */
}
