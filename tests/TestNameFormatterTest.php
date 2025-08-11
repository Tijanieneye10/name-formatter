<?php

declare(strict_types=1);

use Tijanieneye10\Playground\NameFormatter;

it('can get firstname', function () {
    $fullname = 'Tijani Usman Eneye';
    $firstname = 'Tijani';

    $firstnameFormatted = NameFormatter::make($fullname)->firstname;

    expect($firstnameFormatted)->toBe($firstname);
});

it('can get lastname', function () {
    $fullname = 'Tijani Usman Eneye';
    $lastname = 'Eneye';

    $lastnameFormatted = NameFormatter::make($fullname)->lastname;

    expect($lastnameFormatted)->toBe($lastname);
});

it('can get middlename', function () {
    $fullname = 'Tijani Usman Eneye';
    $middlename = 'Usman';

    $middlenameFormatted = NameFormatter::make($fullname)->middlename;

    expect($middlenameFormatted)->toBe($middlename);
});

it('returns empty string for middlename when not present', function () {
    $fullname = 'Tijani Eneye';

    $middlenameFormatted = NameFormatter::make($fullname)->middlename;

    expect($middlenameFormatted)->toBe('');
});

it('can get initials', function () {
    $fullname = 'Tijani Eneye';
    $initials = 'TE';

    $initialsFormatted = NameFormatter::make($fullname)->initials;

    expect($initialsFormatted)->toBe($initials);
});

it('can get initials with middle name', function () {
    $fullname = 'Tijani Usman Eneye';
    $initials = 'TUE';

    $initialsFormatted = NameFormatter::make($fullname)->initials;

    expect($initialsFormatted)->toBe($initials);
});

it('can format name with custom format', function () {
    $fullname = 'Tijani Usman Eneye';

    $formatted = NameFormatter::make($fullname)->format('L, F M');

    expect($formatted)->toBe('Eneye, Tijani Usman');
});

it('can format name with default format', function () {
    $fullname = 'Tijani Usman Eneye';

    $formatted = NameFormatter::make($fullname)->format();

    expect($formatted)->toBe('Tijani Usman Eneye');
});

it('handles single name', function () {
    $fullname = 'Tijani';

    $formatter = NameFormatter::make($fullname);

    expect($formatter->firstname)->toBe('Tijani');
    expect($formatter->lastname)->toBe('Tijani');
    expect($formatter->middlename)->toBe('');
    expect($formatter->initials)->toBe('T');
});

it('handles names with multiple spaces', function () {
    $fullname = '  Tijani   Usman   Eneye  ';

    $formatter = NameFormatter::make($fullname);

    expect($formatter->firstname)->toBe('Tijani');
    expect($formatter->middlename)->toBe('Usman');
    expect($formatter->lastname)->toBe('Eneye');
    expect($formatter->initials)->toBe('TUE');
});

it('can convert first letter to uppercase', function () {
    $fullname = 'tijani usman eneye';

    $formatted = NameFormatter::make($fullname)->toUpperCase();

    expect($formatted)->toBe('Tijani usman eneye');
});

it('can convert entire string to lowercase', function () {
    $fullname = 'TIJANI USMAN ENEYE';

    $formatted = NameFormatter::make($fullname)->toLowerCase();

    expect($formatted)->toBe('tijani usman eneye');
});

it('can generate avatar URL', function () {
    $fullname = 'Tijani Usman Eneye';

    $avatarUrl = NameFormatter::make($fullname)->avatar();

    expect($avatarUrl)->toContain('ui-avatars.com/api/');
    expect($avatarUrl)->toContain('name=' . urlencode($fullname));
    expect($avatarUrl)->toContain('size=100');
    expect($avatarUrl)->toContain('background=3B82F6');
    expect($avatarUrl)->toContain('color=FFFFFF');
});

it('can generate avatar URL with custom parameters', function () {
    $fullname = 'Tijani Usman Eneye';

    $avatarUrl = NameFormatter::make($fullname)->avatar(200, 'FF6B6B', '000000');

    expect($avatarUrl)->toContain('ui-avatars.com/api/');
    expect($avatarUrl)->toContain('name=' . urlencode($fullname));
    expect($avatarUrl)->toContain('size=200');
    expect($avatarUrl)->toContain('background=FF6B6B');
    expect($avatarUrl)->toContain('color=000000');
});

it('can generate avatar URL using avatarUrl alias', function () {
    $fullname = 'Tijani Usman Eneye';

    $avatarUrl = NameFormatter::make($fullname)->avatarUrl(150, '10B981', 'FFFFFF');

    expect($avatarUrl)->toContain('ui-avatars.com/api/');
    expect($avatarUrl)->toContain('name=' . urlencode($fullname));
    expect($avatarUrl)->toContain('size=150');
    expect($avatarUrl)->toContain('background=10B981');
    expect($avatarUrl)->toContain('color=FFFFFF');
});
