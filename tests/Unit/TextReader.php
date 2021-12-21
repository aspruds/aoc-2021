<?php

namespace Tests\Unit;

trait TextReader {
    function read_lines($fileName): array {
        $file = file_get_contents(__DIR__ . '/Fixtures/' . $fileName);
        return explode("\n", trim($file));
    }
}
