<?php

declare(strict_types=1);

namespace Tijanieneye10\Playground;

final class NameFormatter
{
    private array $nameParts;

    public function __construct(private readonly string $fullname)
    {
        $this->nameParts = $this->parseName();
    }

    public static function make(string $fullname): self
    {
        return new self($fullname);
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

    private function firstname(): string
    {
        return $this->nameParts[0] ?? '';
    }

    private function lastname(): string
    {
        return $this->nameParts[array_key_last($this->nameParts)] ?? '';
    }

    private function middlename(): string
    {
        if (count($this->nameParts) <= 2) {
            return '';
        }

        return implode(' ', array_slice($this->nameParts, 1, -1));
    }

    public function capitalize(): string
    {
        return ucfirst($this->fullname);
    }

    public function lowerCaps(): string
    {
        return lcfirst($this->fullname);
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

        return array_filter($parts, fn ($part) => ! empty($part));
    }
}
