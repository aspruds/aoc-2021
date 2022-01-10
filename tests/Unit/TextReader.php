<?php

namespace Tests\Unit;

trait TextReader {
    function readLines($fileName): array {
        $file = file_get_contents(__DIR__ . '/Fixtures/' . $fileName);
        return explode("\n", trim($file));
    }

    function readAsString($fileName): string {
        return file_get_contents(__DIR__ . '/Fixtures/' . $fileName);
    }
}
