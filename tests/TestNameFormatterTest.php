<?php

declare(strict_types=1);

use Tijanieneye10\NameFormatter\NameFormatter;

describe('NameFormatter - Basic Functionality', function () {
    it('can create instance with constructor', function () {
        $formatter = new NameFormatter('Eneye Tijani Usman');

        expect($formatter)->toBeInstanceOf(NameFormatter::class);
        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->lastname)->toBe('Eneye');
    });

    it('can create instance with static make method', function () {
        $formatter = NameFormatter::make('Eneye Tijani Usman');

        expect($formatter)->toBeInstanceOf(NameFormatter::class);
        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->lastname)->toBe('Eneye');
    });

    it('can create instance with custom format', function () {
        $formatter = NameFormatter::make('Tijani Usman Eneye', 'FML');

        expect($formatter)->toBeInstanceOf(NameFormatter::class);
        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->lastname)->toBe('Eneye');
    });
});

describe('NameFormatter - Name Format System', function () {
    it('uses LFM as default format', function () {
        $formatter = NameFormatter::make('Eneye Tijani Usman');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('Usman');
        expect($formatter->lastname)->toBe('Eneye');
        expect($formatter->initials)->toBe('ETU');
    });

    it('can parse names with FML format', function () {
        $formatter = NameFormatter::make('Tijani Usman Eneye', 'FML');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('Usman');
        expect($formatter->lastname)->toBe('Eneye');
        expect($formatter->initials)->toBe('TUE');
    });

    it('can parse names with LMF format', function () {
        $formatter = NameFormatter::make('Eneye Usman Tijani', 'LMF');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('Usman');
        expect($formatter->lastname)->toBe('Eneye');
        expect($formatter->initials)->toBe('EUT');
    });

    it('can parse names with FL format (no middle name)', function () {
        $formatter = NameFormatter::make('Tijani Eneye', 'FL');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('');
        expect($formatter->lastname)->toBe('Eneye');
        expect($formatter->initials)->toBe('TE');
    });

    it('can parse names with LF format (no middle name)', function () {
        $formatter = NameFormatter::make('Eneye Tijani', 'LF');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('');
        expect($formatter->lastname)->toBe('Eneye');
        expect($formatter->initials)->toBe('ET');
    });

    it('can parse names with FML format using constructor', function () {
        $formatter = new NameFormatter('Tijani Usman Eneye', 'FML');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('Usman');
        expect($formatter->lastname)->toBe('Eneye');
    });

    it('can parse names with custom format using constructor', function () {
        $formatter = new NameFormatter('Eneye Usman Tijani', 'LMF');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('Usman');
        expect($formatter->lastname)->toBe('Eneye');
    });
});

describe('NameFormatter - Name Extraction', function () {
    it('can get firstname with default LFM format', function () {
        $fullname = 'Eneye Tijani Usman';
        $firstname = 'Tijani';

        $firstnameFormatted = NameFormatter::make($fullname)->firstname;

        expect($firstnameFormatted)->toBe($firstname);
    });

    it('can get lastname with default LFM format', function () {
        $fullname = 'Eneye Tijani Usman';
        $lastname = 'Eneye';

        $lastnameFormatted = NameFormatter::make($fullname)->lastname;

        expect($lastnameFormatted)->toBe($lastname);
    });

    it('can get middlename with default LFM format', function () {
        $fullname = 'Eneye Tijani Usman';
        $middlename = 'Usman';

        $middlenameFormatted = NameFormatter::make($fullname)->middlename;

        expect($middlenameFormatted)->toBe($middlename);
    });

    it('returns empty string for middlename when not present in LFM format', function () {
        $fullname = 'Eneye Tijani';

        $middlenameFormatted = NameFormatter::make($fullname)->middlename;

        expect($middlenameFormatted)->toBe('');
    });

    it('can get initials with middle name in LFM format', function () {
        $fullname = 'Eneye Tijani Usman';
        $initials = 'ETU';

        $initialsFormatted = NameFormatter::make($fullname)->initials;

        expect($initialsFormatted)->toBe($initials);
    });

    it('can get initials with no middle name', function () {
        $fullname = 'Eneye Tijani';
        $initials = 'ET';

        $initialsFormatted = NameFormatter::make($fullname)->initials;

        expect($initialsFormatted)->toBe($initials);
    });
});

describe('NameFormatter - Name Formatting', function () {
    it('can format name with custom format in LFM order', function () {
        $fullname = 'Eneye Tijani Usman';

        $formatted = NameFormatter::make($fullname)->format('L, F M');

        expect($formatted)->toBe('Eneye, Tijani Usman');
    });

    it('can format name with default format in LFM order', function () {
        $fullname = 'Eneye Tijani Usman';

        $formatted = NameFormatter::make($fullname)->format();

        expect($formatted)->toBe('Tijani Usman Eneye');
    });

    it('can format name with FML format', function () {
        $formatter = NameFormatter::make('Tijani Usman Eneye', 'FML');

        $formatted = $formatter->format('L, F M');
        expect($formatted)->toBe('Eneye, Tijani Usman');

        $formatted = $formatter->format();
        expect($formatted)->toBe('Tijani Usman Eneye');
    });

    it('can format name with custom template', function () {
        $formatter = NameFormatter::make('Eneye Tijani Usman');

        $formatted = $formatter->format('F. M. L.');
        expect($formatted)->toBe('Tijani. Usman. Eneye.');

        $formatted = $formatter->format('L, F');
        expect($formatted)->toBe('Eneye, Tijani');
    });

    it('handles empty middlename in formatting', function () {
        $formatter = NameFormatter::make('Eneye Tijani');

        $formatted = $formatter->format('F M L');
        expect($formatted)->toBe('Tijani Eneye');

        $formatted = $formatter->format('L, F M');
        expect($formatted)->toBe('Eneye, Tijani');
    });
});

describe('NameFormatter - Text Case Formatting', function () {
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

    it('handles mixed case input', function () {
        $fullname = 'TiJaNi UsMaN EnEyE';

        $upperFirst = NameFormatter::make($fullname)->toUpperCase();
        expect($upperFirst)->toBe('TiJaNi UsMaN EnEyE');

        $lowerAll = NameFormatter::make($fullname)->toLowerCase();
        expect($lowerAll)->toBe('tijani usman eneye');
    });
});

describe('NameFormatter - Avatar Generation', function () {
    it('can generate avatar URL with default settings', function () {
        $fullname = 'Eneye Tijani Usman';

        $avatarUrl = NameFormatter::make($fullname)->avatar();

        expect($avatarUrl)->toContain('ui-avatars.com/api/');
        expect($avatarUrl)->toContain('name=' . urlencode($fullname));
        expect($avatarUrl)->toContain('size=100');
        expect($avatarUrl)->toContain('background=3B82F6');
        expect($avatarUrl)->toContain('color=FFFFFF');
        expect($avatarUrl)->toContain('bold=true');
        expect($avatarUrl)->toContain('format=svg');
    });

    it('can generate avatar URL with custom parameters', function () {
        $fullname = 'Eneye Tijani Usman';

        $avatarUrl = NameFormatter::make($fullname)->avatar(200, 'FF6B6B', '000000');

        expect($avatarUrl)->toContain('ui-avatars.com/api/');
        expect($avatarUrl)->toContain('name=' . urlencode($fullname));
        expect($avatarUrl)->toContain('size=200');
        expect($avatarUrl)->toContain('background=FF6B6B');
        expect($avatarUrl)->toContain('color=000000');
    });

    it('can generate avatar URL using avatarUrl alias', function () {
        $fullname = 'Eneye Tijani Usman';

        $avatarUrl = NameFormatter::make($fullname)->avatarUrl(150, '10B981', 'FFFFFF');

        expect($avatarUrl)->toContain('ui-avatars.com/api/');
        expect($avatarUrl)->toContain('name=' . urlencode($fullname));
        expect($avatarUrl)->toContain('size=150');
        expect($avatarUrl)->toContain('background=10B981');
        expect($avatarUrl)->toContain('color=FFFFFF');
    });

    it('handles color parameters with hash symbols', function () {
        $fullname = 'Eneye Tijani Usman';

        $avatarUrl = NameFormatter::make($fullname)->avatar(100, '#FF6B6B', '#000000');

        expect($avatarUrl)->toContain('background=FF6B6B');
        expect($avatarUrl)->toContain('color=000000');
    });
});

describe('NameFormatter - Edge Cases and Special Handling', function () {
    it('handles single name in any format', function () {
        $fullname = 'Tijani';

        $formatter = NameFormatter::make($fullname, 'LFM');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->lastname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('');
        expect($formatter->initials)->toBe('T');
    });

    it('handles names with multiple spaces', function () {
        $fullname = '  Eneye   Tijani   Usman  ';

        $formatter = NameFormatter::make($fullname);

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('Usman');
        expect($formatter->lastname)->toBe('Eneye');
        expect($formatter->initials)->toBe('ETU');
    });

    it('handles empty string input', function () {
        $formatter = NameFormatter::make('');

        expect($formatter->firstname)->toBe('');
        expect($formatter->lastname)->toBe('');
        expect($formatter->middlename)->toBe('');
        expect($formatter->initials)->toBe('');
    });

    it('handles names with only spaces', function () {
        $formatter = NameFormatter::make('   ');

        expect($formatter->firstname)->toBe('');
        expect($formatter->lastname)->toBe('');
        expect($formatter->middlename)->toBe('');
        expect($formatter->initials)->toBe('');
    });

    it('handles names with special characters', function () {
        $fullname = 'O\'Connor Tijani Usman';

        $formatter = NameFormatter::make($fullname, 'LFM');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('Usman');
        expect($formatter->lastname)->toBe('O\'Connor');
        expect($formatter->initials)->toBe('OTU');
    });

    it('handles unicode characters', function () {
        $fullname = 'José María García';

        $formatter = NameFormatter::make($fullname, 'FML');

        expect($formatter->firstname)->toBe('José');
        expect($formatter->middlename)->toBe('María');
        expect($formatter->lastname)->toBe('García');
        expect($formatter->initials)->toBe('JMG');
    });
});

describe('NameFormatter - Property Access', function () {
    it('can access properties via magic __get', function () {
        $formatter = NameFormatter::make('Eneye Tijani Usman');

        expect($formatter->firstname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('Usman');
        expect($formatter->lastname)->toBe('Eneye');
        expect($formatter->initials)->toBe('ETU');
    });

    it('throws exception for invalid property access', function () {
        $formatter = NameFormatter::make('Eneye Tijani Usman');

        expect(fn() => $formatter->invalid_property)->toThrow(InvalidArgumentException::class);
    });
});

describe('NameFormatter - Format Validation', function () {
    it('handles invalid format gracefully', function () {
        $fullname = 'Eneye Tijani Usman';

        // Invalid format should fall back to default behavior
        $formatter = NameFormatter::make($fullname, 'INVALID');

        // When invalid format is provided, it should still work with the name parts
        expect($formatter->firstname)->toBe('Eneye');   // First available part
        expect($formatter->lastname)->toBe('Usman');    // Last available part
        expect($formatter->middlename)->toBe('Eneye Tijani Usman'); // All parts when no middle found
    });

    it('handles format with missing components', function () {
        $fullname = 'Eneye Tijani Usman';

        // Format with only F and L
        $formatter = NameFormatter::make($fullname, 'FL');

        expect($formatter->firstname)->toBe('Eneye');
        expect($formatter->lastname)->toBe('Tijani');
        expect($formatter->middlename)->toBe('Usman'); // Should be treated as middle
    });
});
