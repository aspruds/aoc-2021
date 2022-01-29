<?php

namespace App\Services;

class Day14Service
{
    public function polymerTemplateChecksumFast(string $input, int $iterations): int
    {
        list($template, $replacementSpecs) = explode("\n\n", $input);
        $replacements = $this->parseReplacements($replacementSpecs);

        $pairCounts = array_count_values($this->pairs($template));
        $frequencies = array_count_values(str_split($template));

        for($n = 0; $n < $iterations; $n++) {
            $updatedCounts = [];
            foreach($pairCounts as $key => $count) {
                $replacement = $replacements[$key];

                $firstReplacement = $key[0] . $replacement;
                $updatedCounts[$firstReplacement] = ($updatedCounts[$firstReplacement] ?? 0) + $count;

                $secondReplacement = $replacement . $key[1];
                $updatedCounts[$secondReplacement] = ($updatedCounts[$secondReplacement] ?? 0) + $count;

                $frequencies[$replacement] = ($frequencies[$replacement] ?? 0) + $count;
            }
            $pairCounts = $updatedCounts;
        }
        return $this->checksumFromFrequencies($frequencies);
    }

    private function pairs($template): array
    {
        $output = [];
        for ($i = 0; $i < strlen($template) - 1; $i++) {
            $first = $template[$i];
            $second = $template[$i + 1] ?? "";
            $output[] = $first . $second;
        }
        return $output;
    }

    private function checksumFromFrequencies($frequencies): int {
        asort($frequencies);
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
            $updated[$replacement[0]] = $replacement[1];
        }
        return $updated;
    }
}
