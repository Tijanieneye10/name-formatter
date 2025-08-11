<?php

declare(strict_types=1);

namespace Tijanieneye10\Playground;

final class NameFormatter
{
    private array $nameParts;
    private string $nameFormat;
    private array $nameMapping;

    public function __construct(private readonly string $fullname, string $format = 'LFM')
    {
        $this->nameFormat = strtoupper($format);
        $this->nameParts = $this->parseName();
        $this->nameMapping = $this->createNameMapping();
    }

    public static function make(string $fullname, string $format = 'LFM'): self
    {
        return new self($fullname, $format);
    }

    // Read-only properties that calculate values when accessed
    public function __get(string $name): string
    {
        return match ($name) {
            'firstname' => $this->firstname(),
            'lastname' => $this->lastname(),
            'middlename' => $this->middlename(),
            'initials' => $this->initials(),
            'avatar' => $this->avatar(),
            default => throw new \InvalidArgumentException("Property '$name' does not exist.")
        };
    }

    private function createNameMapping(): array
    {
        $parts = str_split($this->nameFormat);
        $mapping = [];

        foreach ($parts as $index => $part) {
            if (in_array($part, ['F', 'M', 'L'])) {
                $mapping[$part] = $index;
            }
        }

        return $mapping;
    }

    private function firstname(): string
    {
        $index = $this->nameMapping['F'] ?? 0;
        return $this->nameParts[$index] ?? '';
    }

    private function lastname(): string
    {
        $index = $this->nameMapping['L'] ?? array_key_last($this->nameParts);
        return $this->nameParts[$index] ?? '';
    }

    private function middlename(): string
    {
        $middleIndices = [];

        // Find all indices that are not F or L
        for ($i = 0; $i < count($this->nameParts); $i++) {
            if (!in_array($i, array_values($this->nameMapping))) {
                $middleIndices[] = $i;
            }
        }

        // If no middle indices found, check if M is explicitly defined
        if (empty($middleIndices) && isset($this->nameMapping['M'])) {
            $middleIndices[] = $this->nameMapping['M'];
        }

        if (empty($middleIndices)) {
            return '';
        }

        $middleParts = array_map(fn($index) => $this->nameParts[$index] ?? '', $middleIndices);
        return implode(' ', array_filter($middleParts, fn($part) => !empty($part)));
    }

    public function toUpperCase(): string
    {
        return ucfirst($this->fullname);
    }

    public function toLowerCase(): string
    {
        return strtolower($this->fullname);
    }

    public function format(string $format = 'F M L'): string
    {
        $replacements = [
            'F' => $this->firstname,
            'M' => $this->middlename,
            'L' => $this->lastname,
        ];

        $result = $format;

        // Use strtr for single-pass replacement to avoid corruption
        $result = strtr($result, $replacements);

        // Clean up extra spaces
        return preg_replace('/\s+/', ' ', trim($result));
    }

    private function initials(): string
    {
        $initials = '';

        foreach ($this->nameParts as $part) {
            if (! empty($part)) {
                $initials .= mb_substr($part, 0, 1);
            }
        }

        return strtoupper($initials);
    }

    public function avatar(int $size = 100, string $backgroundColor = '3B82F6', string $textColor = 'FFFFFF'): string
    {
        // Remove # from colors if present
        $backgroundColor = ltrim($backgroundColor, '#');
        $textColor = ltrim($textColor, '#');

        // Build UI Avatars URL
        $url = 'https://ui-avatars.com/api/';
        $url .= '?name=' . urlencode($this->fullname);
        $url .= '&size=' . $size;
        $url .= '&background=' . $backgroundColor;
        $url .= '&color=' . $textColor;
        $url .= '&bold=true';
        $url .= '&format=svg';

        return $url;
    }

    public function avatarUrl(int $size = 100, string $backgroundColor = '3B82F6', string $textColor = 'FFFFFF'): string
    {
        return $this->avatar($size, $backgroundColor, $textColor);
    }

    private function parseName(): array
    {
        $parts = preg_split('/\s+/', trim($this->fullname));

        return array_filter($parts, fn($part) => ! empty($part));
    }
}
