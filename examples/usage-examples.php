<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Tijanieneye10\Playground\NameFormatter;

echo "🚀 NameFormatter Package - Complete Usage Examples\n";
echo "================================================\n\n";

// Example 1: Basic Name Extraction
echo "📝 EXAMPLE 1: Basic Name Extraction\n";
echo "-----------------------------------\n";
$basicName = NameFormatter::make('John Doe');
echo "Full Name: 'John Doe'\n";
echo "First Name: " . $basicName->firstname() . "\n";
echo "Last Name: " . $basicName->lastname() . "\n";
echo "Middle Name: '" . $basicName->middlename() . "' (empty)\n";
echo "Initials: " . $basicName->initials() . "\n\n";

// Example 2: Middle Name Support
echo "📝 EXAMPLE 2: Middle Name Support\n";
echo "-----------------------------------\n";
$middleName = NameFormatter::make('John Michael Doe');
echo "Full Name: 'John Michael Doe'\n";
echo "First Name: " . $middleName->firstname() . "\n";
echo "Middle Name: " . $middleName->middlename() . "\n";
echo "Last Name: " . $middleName->lastname() . "\n";
echo "Initials: " . $middleName->initials() . "\n\n";

// Example 3: Multiple Middle Names
echo "📝 EXAMPLE 3: Multiple Middle Names\n";
echo "-----------------------------------\n";
$multipleMiddle = NameFormatter::make('John A B C Doe');
echo "Full Name: 'John A B C Doe'\n";
echo "First Name: " . $multipleMiddle->firstname() . "\n";
echo "Middle Names: " . $multipleMiddle->middlename() . "\n";
echo "Last Name: " . $multipleMiddle->lastname() . "\n";
echo "Initials: " . $multipleMiddle->initials() . "\n\n";

// Example 4: Text Formatting
echo "📝 EXAMPLE 4: Text Formatting\n";
echo "-----------------------------------\n";
$textFormat = NameFormatter::make('john doe');
echo "Original: 'john doe'\n";
echo "Capitalized: " . $textFormat->capitalize() . "\n";
echo "Lowercase First: " . $textFormat->lowerCaps() . "\n\n";

// Example 5: Custom Formatting
echo "📝 EXAMPLE 5: Custom Formatting\n";
echo "-----------------------------------\n";
$customFormat = NameFormatter::make('John Michael Doe');
echo "Full Name: 'John Michael Doe'\n";
echo "Default Format: " . $customFormat->format() . "\n";
echo "Last, First: " . $customFormat->format('L, F') . "\n";
echo "Last, First Middle: " . $customFormat->format('L, F M') . "\n";
echo "With Dots: " . $customFormat->format('F. M. L.') . "\n";
echo "Formal Style: " . $customFormat->format('L, F M') . "\n\n";

// Example 6: Edge Cases
echo "📝 EXAMPLE 6: Edge Cases\n";
echo "-----------------------------------\n";
$singleName = NameFormatter::make('John');
echo "Single Name: 'John'\n";
echo "First Name: " . $singleName->firstname() . "\n";
echo "Last Name: " . $singleName->lastname() . "\n";
echo "Middle Name: '" . $singleName->middlename() . "'\n";
echo "Initials: " . $singleName->initials() . "\n\n";

$messySpaces = NameFormatter::make('  John   Michael   Doe  ');
echo "Messy Spaces: '  John   Michael   Doe  '\n";
echo "First Name: " . $messySpaces->firstname() . "\n";
echo "Middle Name: " . $messySpaces->middlename() . "\n";
echo "Last Name: " . $messySpaces->lastname() . "\n";
echo "Initials: " . $messySpaces->initials() . "\n\n";

// Example 7: Real-World Scenarios
echo "📝 EXAMPLE 7: Real-World Scenarios\n";
echo "-----------------------------------\n";

// User Registration
echo "🔐 User Registration:\n";
$newUser = NameFormatter::make('Jane Marie Smith');
echo "User: " . $newUser->format() . "\n";
echo "Database Fields:\n";
echo "  - first_name: '" . $newUser->firstname() . "'\n";
echo "  - middle_name: '" . $newUser->middlename() . "'\n";
echo "  - last_name: '" . $newUser->lastname() . "'\n";
echo "  - initials: '" . $newUser->initials() . "'\n";
echo "  - display_name: '" . $newUser->format('F M L') . "'\n\n";

// Email Signature
echo "📧 Email Signature:\n";
$emailUser = NameFormatter::make('Dr. Robert A. Johnson III');
echo "Full Name: 'Dr. Robert A. Johnson III'\n";
echo "Signature: " . $emailUser->format('F M L') . "\n";
echo "Formal: " . $emailUser->format('L, F M') . "\n\n";

// File Naming
echo "📁 File Naming:\n";
$fileUser = NameFormatter::make('Sarah Elizabeth Williams');
echo "User: " . $fileUser->format() . "\n";
echo "File Name: " . strtolower($fileUser->format('F_M_L')) . ".pdf\n";
echo "Folder: " . $fileUser->lastname() . "_" . $fileUser->firstname() . "\n\n";

// Example 8: Batch Processing
echo "📝 EXAMPLE 8: Batch Processing\n";
echo "-----------------------------------\n";
$names = [
    'Alice Johnson',
    'Bob Michael Smith',
    'Carol A B Davis',
    'David',
    'Emma Grace Wilson'
];

echo "Processing multiple names:\n";
foreach ($names as $name) {
    $formatter = NameFormatter::make($name);
    echo "  " . str_pad($name, 20) . " → " . $formatter->format('L, F M') . "\n";
}

echo "\n🎉 That's all the features of your NameFormatter package!\n";
echo "✨ You now have a powerful tool for handling names in any format!\n";
