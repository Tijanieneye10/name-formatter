<?php

namespace Tijanieneye10\Playground;

class NameFormatter
{
    public string $initials;

    public function __construct(protected string $fullname) {}

    public static function make(string $fullname): self
    {
        return new static($fullname);
    }

    public function firstname(): string
    {
        return explode(' ', $this->fullname)[0];
    }

    public function lastname(): string
    {
        return explode(' ', $this->fullname)[1];
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
        $parts = preg_split('/\s+/', trim($this->fullname));

        $firstInitial = mb_substr($parts[0] ?? '', 0, 1);
        $lastInitial  = mb_substr($parts[1] ?? '', 0, 1);

        return strtoupper("{$firstInitial}{$lastInitial}");

    }
}
