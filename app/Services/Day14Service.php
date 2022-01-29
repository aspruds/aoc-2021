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

    public function polymerTemplateChecksumFast(string $input): int
    {
        list($template, $replacementSpecs) = explode("\n\n", $input);
        $replacements = $this->parseReplacements($replacementSpecs);
        return 0;
    }

    private function replace($template, $replacements): string
    {
        $output = [];
        foreach ($this->pairs($template) as $pair) {
            $first = $pair[0];
            $replacement = $replacements[$pair] ?? "";
            $output[] = $first . $replacement;
        }
        return implode("", $output);
    }

    private function pairs($template): array
    {
        $output = [];
        for ($i = 0; $i < strlen($template); $i++) {
            $first = $template[$i];
            $second = $template[$i + 1] ?? "";
            $output[] = $first . $second;
        }
        return $output;
    }

    private function checksum($template): int
    {
        $frequencies = array_count_values(str_split($template));
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
