<?php

declare(strict_types=1);

namespace Tijanieneye10\Playground;

final class NameFormatter
{
    private array $nameParts;
    public ?string $firstname = null;
    public ?string $lastname = null;
    public ?string $middlename = null;

    public function __construct(private readonly string $fullname)
    {
        $this->nameParts = $this->parseName();
        $this->firstname = $this->firstname();
        $this->lastname = $this->lastname();
        $this->middlename = $this->middlename();
    }

    public static function make(string $fullname): self
    {
        
        return new self($fullname);
    }

    public function firstname(): string
    {
        return $this->nameParts[0] ?? '';
    }

    public function lastname(): string
    {
        return $this->nameParts[array_key_last($this->nameParts)] ?? '';
    }

    public function middlename(): string
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

    public function initials(): string
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
            'F' => $this->firstname(),
            'M' => $this->middlename(),
            'L' => $this->lastname(),
        ];

        $result = $format;

        // Use strtr for single-pass replacement to avoid corruption
        $result = strtr($result, $replacements);

        // Clean up extra spaces
        return preg_replace('/\s+/', ' ', trim($result));
    }

    private function parseName(): array
    {
        $parts = preg_split('/\s+/', trim($this->fullname));

        return array_filter($parts, fn($part) => ! empty($part));
    }
}
