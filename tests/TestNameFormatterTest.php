<?php

declare(strict_types=1);

use Tijanieneye10\Playground\NameFormatter;

it('can get firstname', function () {
    $fullname = 'John Doe';
    $firstname = 'John';

    $firstnameFormatted = NameFormatter::make($fullname)->firstname;

    expect($firstnameFormatted)->toBe($firstname);
});

it('can get lastname', function () {
    $fullname = 'John Doe';
    $lastname = 'Doe';

    $lastnameFormatted = NameFormatter::make($fullname)->lastname;

    expect($lastnameFormatted)->toBe($lastname);
});

it('can get middlename', function () {
    $fullname = 'John Michael Doe';
    $middlename = 'Michael';

    $middlenameFormatted = NameFormatter::make($fullname)->middlename;

    expect($middlenameFormatted)->toBe($middlename);
});

it('returns empty string for middlename when not present', function () {
    $fullname = 'John Doe';

    $middlenameFormatted = NameFormatter::make($fullname)->middlename;

    expect($middlenameFormatted)->toBe('');
});

it('can get initials', function () {
    $fullname = 'John Doe';
    $initials = 'JD';

    $initialsFormatted = NameFormatter::make($fullname)->initials;

    expect($initialsFormatted)->toBe($initials);
});

it('can get initials with middle name', function () {
    $fullname = 'John Michael Doe';
    $initials = 'JMD';

    $initialsFormatted = NameFormatter::make($fullname)->initials;

    expect($initialsFormatted)->toBe($initials);
});

it('can format name with custom format', function () {
    $fullname = 'John Michael Doe';

    $formatted = NameFormatter::make($fullname)->format('L, F M');

    expect($formatted)->toBe('Doe, John Michael');
});

it('can format name with default format', function () {
    $fullname = 'John Michael Doe';

    $formatted = NameFormatter::make($fullname)->format();

    expect($formatted)->toBe('John Michael Doe');
});

it('handles single name', function () {
    $fullname = 'John';

    $formatter = NameFormatter::make($fullname);

    expect($formatter->firstname)->toBe('John');
    expect($formatter->lastname)->toBe('John');
    expect($formatter->middlename)->toBe('');
    expect($formatter->initials)->toBe('J');
});

it('handles names with multiple spaces', function () {
    $fullname = '  John   Michael   Doe  ';

    $formatter = NameFormatter::make($fullname);

    expect($formatter->firstname)->toBe('John');
    expect($formatter->middlename)->toBe('Michael');
    expect($formatter->lastname)->toBe('Doe');
    expect($formatter->initials)->toBe('JMD');
});
