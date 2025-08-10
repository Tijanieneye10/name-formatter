<?php

use Tijanieneye10\Playground\NameFormatter;

it('can get firstname', function () {
    $fullname = "John Doe";
    $firstname = "John";

    $firstnameFormatted = NameFormatter::make($fullname)->firstname();

    expect($firstnameFormatted)->toBe($firstname);
});


it('can get initials', function () {
    $fullname = "John Doe";
    $initials = NameFormatter::make($fullname)->initials();

    expect($initials)->toBe('JD');
});
