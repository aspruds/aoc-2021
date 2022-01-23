<?php

namespace Tests\Unit;

use App\Services\Day14Service;
use PHPUnit\Framework\TestCase;

class Day14Test extends TestCase
{
    use TextReader;

    protected Day14Service $service;

    public function setUp():void {
        parent::setUp();
        $this->service = new Day14Service();
    }

    public function test_polymer_template_checksum_sample(): void
    {
        $input = $this->readAsString('day14-sample.txt');
        $expected = 1588;
        $this->assertEquals($expected, $this->service->polymerTemplateChecksum($input));
    }

    public function test_polymer_template_checksum_input(): void
    {
        $input = $this->readAsString('day14.txt');
        $expected = 2975;
        $this->assertEquals($expected, $this->service->polymerTemplateChecksum($input));
    }
}
