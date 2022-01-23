<?php

namespace App\Services;

class Day14Service
{
    public function polymerTemplateChecksum(string $input): int
    {
        list($template, $replacementSpecs) = explode("\n\n", $input);
        $replacements = $this->parseReplacements($replacementSpecs);

        for($n = 0; $n < 10; $n++) {
            $template = $this->replace($template, $replacements);
        }
        return $this->checksum($template);
    }

    private function replace($template, $replacements): string
    {
        $output = [];
        $first = null;
        $second = null;
        for ($i = 0; $i < strlen($template); $i++) {
            $first = $template[$i];
            $second = $template[$i + 1] ?? "";
            $key = $first . $second;
            if (isset($replacements[$key])) {
                $output[] = $first . $replacements[$key];
            } else {
                $output[] = $first . $second;
            }
        }
        return implode("", $output);
    }

    private function checksum($template): int
    {
        $frequencies = array_count_values(str_split($template));
        asort($frequencies);
        //print_r($frequencies);

        $first = reset($frequencies);
        $last = end($frequencies);
        return $last - $first;
    }

    private function parseReplacements(string $replacementSpecs): array
    {
        $lines = explode("\n", trim($replacementSpecs));
        $replacements = array_map(fn($line) => explode(" -> ", $line), $lines);
        $updated = [];
        foreach($replacements as $replacement) {
            $fromParts = str_split($replacement[0]);
            $updated[$replacement[0]] = $replacement[1];
        }
        return $updated;
    }
}
