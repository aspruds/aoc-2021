<?php

namespace Tests\Unit;

trait CsvReader {
    function read_csv($fileName): array {
        return explode("\n", file_get_contents(__DIR__ . '/Fixtures/' . $fileName));
    }
}
