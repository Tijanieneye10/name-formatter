<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Tijanieneye10\Playground\NameFormatter;

// 🎯 SIMPLE EXAMPLES - Copy and paste these into your projects!

// 1. Basic name extraction
$name = NameFormatter::make('John Doe');
echo "First: " . $name->firstname() . "\n";  // John
echo "Last: " . $name->lastname() . "\n";    // Doe
echo "Initials: " . $name->initials() . "\n"; // JD

// 2. Middle name handling
$fullName = NameFormatter::make('Jane Marie Smith');
echo "Middle: " . $fullName->middlename() . "\n"; // Marie
echo "All initials: " . $fullName->initials() . "\n"; // JMS

// 3. Custom formatting
$user = NameFormatter::make('Bob Michael Johnson');
echo "Formal: " . $user->format('L, F M') . "\n"; // Johnson, Bob Michael
echo "With dots: " . $user->format('F. M. L.') . "\n"; // Bob. Michael. Johnson.

// 4. Text case formatting
$lowercase = NameFormatter::make('john doe');
echo "Capitalized: " . $lowercase->capitalize() . "\n"; // John doe

// 5. Database storage example
$newUser = NameFormatter::make('Alice Grace Wilson');
$userData = [
    'first_name' => $newUser->firstname(),
    'middle_name' => $newUser->middlename(),
    'last_name' => $newUser->lastname(),
    'initials' => $newUser->initials(),
    'display_name' => $newUser->format('F M L')
];

// 6. Form processing
$inputName = $_POST['full_name'] ?? 'John Doe';
$formatter = NameFormatter::make($inputName);

$firstName = $formatter->firstname();
$lastName = $formatter->lastname();
$middleName = $formatter->middlename();

// 7. Display formatting
$displayName = NameFormatter::make('Dr. Robert A. Johnson III');
echo "Welcome, " . $displayName->format('F M L') . "!\n";
echo "Your initials: " . $displayName->initials() . "\n";

// 8. File naming
$fileName = NameFormatter::make('Sarah Elizabeth Williams');
$filePath = strtolower($fileName->format('F_M_L')) . '.pdf';
// Result: sarah_elizabeth_williams.pdf

echo "\n✨ These examples show the most common ways to use your package!\n";
