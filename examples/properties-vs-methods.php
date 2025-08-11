<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Tijanieneye10\Playground\NameFormatter;

echo "🎯 PROPERTIES vs METHODS DEMO!\n";
echo "==============================\n\n";

$formatter = NameFormatter::make('John Michael Doe');

echo "Test Name: 'John Michael Doe'\n\n";

echo "🔧 USING METHODS (old way):\n";
echo "==========================\n";
echo "firstname(): " . $formatter->firstname() . "\n";
echo "lastname(): " . $formatter->lastname() . "\n";
echo "middlename(): " . $formatter->middlename() . "\n";
echo "initials(): " . $formatter->initials() . "\n\n";

echo "🎯 USING PROPERTIES (new way):\n";
echo "==============================\n";
echo "firstname: " . $formatter->firstname . "\n";
echo "lastname: " . $formatter->lastname . "\n";
echo "middlename: " . $formatter->middlename . "\n";
echo "initials: " . $formatter->initials . "\n\n";

echo "✨ BOTH WORK THE SAME WAY!\n";
echo "==========================\n\n";

// You can use either approach
echo "Method approach: " . $formatter->firstname() . " " . $formatter->lastname() . "\n";
echo "Property approach: " . $formatter->firstname . " " . $formatter->lastname . "\n\n";

// Properties work great in strings
echo "Welcome, " . $formatter->firstname . "!\n";
echo "Your initials are: " . $formatter->initials . "\n\n";

// Properties work in arrays
$userData = [
    'first_name' => $formatter->firstname,
    'middle_name' => $formatter->middlename,
    'last_name' => $formatter->lastname,
    'initials' => $formatter->initials
];

echo "User Data Array:\n";
foreach ($userData as $key => $value) {
    echo "  $key: '$value'\n";
}

echo "\n🎉 Now you can use properties OR methods!\n";
echo "✨ Properties feel more natural: \$formatter->firstname\n";
echo "🔧 Methods are still available: \$formatter->firstname()\n";
