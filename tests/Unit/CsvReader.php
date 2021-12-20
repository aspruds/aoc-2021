<?php

namespace Tests\Unit;

trait CsvReader {
    function read_csv($fileName): array {
        $file = file_get_contents(__DIR__ . '/Fixtures/' . $fileName);
        return explode("\n", trim($file));
    }
}
