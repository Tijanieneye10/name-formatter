# Name Formatter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tijanieneye10/name-formatter.svg?style=flat-square)](https://packagist.org/packages/tijanieneye10/name-formatter)
[![Tests](https://img.shields.io/github/actions/workflow/status/tijanieneye10/name-formatter/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tijanieneye10/name-formatter/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/tijanieneye10/name-formatter.svg?style=flat-square)](https://packagist.org/packages/tijanieneye10/name-formatter)
[![License](https://img.shields.io/github/license/tijanieneye10/name-formatter.svg?style=flat-square)](LICENSE.md)

A simple and lightweight PHP package for formatting and extracting information from full names. Perfect for applications that need to handle user names, display initials, or format names consistently.

## Features

-   🎯 **Extract first, middle, and last names** from full names with flexible format support
-   🔤 **Generate initials** from full names (supports multiple names)
-   📝 **Text case formatting** (toUpperCase, toLowerCase)
-   🎨 **Custom name formatting** with flexible templates
-   🌍 **Multi-cultural name support** (LFM, FML, LMF, FL, LF formats)
-   🖼️ **Generate avatar URLs** using UI Avatars service
-   🚀 **Simple and fluent API** with static factory method
-   💪 **PHP 8.4+** with modern features and strict typing
-   🧪 **Fully tested** with Pest PHP
-   🛡️ **Robust parsing** handles multiple spaces and edge cases

## Installation

You can install the package via Composer:

```bash
composer require tijanieneye10/name-formatter
```

**Note:** The package uses the namespace `Tijanieneye10\Playground\NameFormatter` in your code.

## Requirements

-   PHP 8.4 or higher

## Usage

### Basic Usage

```php
use Tijanieneye10\Playground\NameFormatter;

// Create a new instance with default LFM format (Last, First, Middle)
$formatter = new NameFormatter('Eneye Tijani Usman');

// Or use the static factory method (recommended)
$formatter = NameFormatter::make('Eneye Tijani Usman');

// Specify custom name format
$formatter = NameFormatter::make('Tijani Usman Eneye', 'FML'); // First, Middle, Last
$formatter = NameFormatter::make('Eneye Usman Tijani', 'LMF'); // Last, Middle, First
```

### Name Format System

The `NameFormatter` supports different name order formats to accommodate various cultural naming conventions:

-   **LFM (Last, First, Middle)** - Default format, common in Western cultures
-   **FML (First, Middle, Last)** - Common in many cultures
-   **LMF (Last, Middle, First)** - Alternative format
-   **FL (First, Last)** - Two-name format
-   **LF (Last, First)** - Two-name format

#### Extract Names

```php
// Using default LFM format (Last, First, Middle)
$formatter = NameFormatter::make('Eneye Tijani Usman');

// Get first name
$firstName = $formatter->firstname; // Returns: "Tijani"

// Get middle name(s)
$middleName = $formatter->middlename; // Returns: "Usman"

// Get last name
$lastName = $formatter->lastname; // Returns: "Eneye"

// Using FML format (First, Middle, Last)
$formatter = NameFormatter::make('Tijani Usman Eneye', 'FML');

$firstName = $formatter->firstname; // Returns: "Tijani"
$middleName = $formatter->middlename; // Returns: "Usman"
$lastName = $formatter->lastname; // Returns: "Eneye"
```

#### Generate Initials

```php
// Using default LFM format (Last, First, Middle)
$formatter = NameFormatter::make('Eneye Tijani Usman');

// Get initials (supports multiple names)
$initials = $formatter->initials; // Returns: "ETU"

// Using FML format (First, Middle, Last)
$formatter = NameFormatter::make('Tijani Usman Eneye', 'FML');
$initials = $formatter->initials; // Returns: "TUE"
```

#### Text Formatting

```php
$formatter = NameFormatter::make('john doe');

// Capitalize first letter
$capitalized = $formatter->toUpperCase(); // Returns: "John doe"

// Lowercase entire string
$lowercase = $formatter->toLowerCase(); // Returns: "john doe"
```

#### Custom Name Formatting

```php
// Using default LFM format (Last, First, Middle)
$formatter = NameFormatter::make('Eneye Tijani Usman');

// Default format: "Tijani Usman Eneye"
$default = $formatter->format();

// Custom formats using placeholders:
// F = First name, M = Middle name, L = Last name
$lastFirst = $formatter->format('L, F M'); // Returns: "Eneye, Tijani Usman"
$initialsOnly = $formatter->format('F. M. L.'); // Returns: "T. Usman. Eneye."
$formal = $formatter->format('L, F'); // Returns: "Eneye, Tijani"

// Using FML format (First, Middle, Last)
$formatter = NameFormatter::make('Tijani Usman Eneye', 'FML');
$default = $formatter->format(); // Returns: "Tijani Usman Eneye"
$lastFirst = $formatter->format('L, F M'); // Returns: "Eneye, Tijani Usman"
```

#### Generate Avatar URLs

```php
// Using default LFM format (Last, First, Middle)
$formatter = NameFormatter::make('Eneye Tijani Usman');

// Generate avatar URL with default settings
$avatarUrl = $formatter->avatar(); // Returns: "https://ui-avatars.com/api/?name=Eneye%20Tijani%20Usman&size=100&background=3B82F6&color=FFFFFF&bold=true&format=svg"

// Customize avatar size and colors
$avatarUrl = $formatter->avatar(200, 'FF6B6B', 'FFFFFF'); // Custom size and background color

// Or use the alias method
$avatarUrl = $formatter->avatarUrl(150, '10B981', '000000'); // Green background, black text

// Access default avatar as property
$defaultAvatar = $formatter->avatar; // Same as $formatter->avatar()
```

### Real-World Examples

#### User Profile Display

```php
$userName = 'eneye tijani usman';
$formatter = NameFormatter::make($userName);

echo "Welcome, " . $formatter->toUpperCase(); // "Welcome, Eneye tijani usman"
echo "Your initials: " . $formatter->initials; // "Your initials: ETU"
echo "Formal name: " . $formatter->format('L, F M'); // "Formal name: Eneye, Tijani Usman"
echo "Avatar: " . $formatter->avatar(80); // Generate 80x80 avatar
```

#### Form Processing

```php
$fullName = $_POST['full_name'] ?? '';
$formatter = NameFormatter::make($fullName);

$firstName = $formatter->firstname;
$middleName = $formatter->middlename;
$lastName = $formatter->lastname;
$initials = $formatter->initials;

// Use in database or display
```

#### Database Storage

```php
$fullName = 'Dr. Eneye Tijani Usman Jr.';
$formatter = NameFormatter::make($fullName);

$user = User::create([
    'first_name' => $formatter->firstname,
    'middle_name' => $formatter->middlename,
    'last_name' => $formatter->lastname,
    'initials' => $formatter->initials,
    'display_name' => $formatter->format('F M L'),
    'avatar_url' => $formatter->avatar(120),
]);
```

#### User Interface with Avatars

```php
$users = [
    'Eneye Tijani Usman',
    'Bello Aisha',
    'Ahmed Musa'
];

foreach ($users as $userName) {
    $formatter = NameFormatter::make($userName);

    echo '<div class="user-card">';
    echo '<img src="' . $formatter->avatar(64, '6366F1', 'FFFFFF') . '" alt="' . $formatter->fullname . '">';
    echo '<h3>' . $formatter->format('F L') . '</h3>';
    echo '<p>Initials: ' . $formatter->initials . '</p>';
    echo '</div>';
}
```

#### Multi-Cultural Name Handling

```php
// Western names (Last, First, Middle)
$westernName = NameFormatter::make('Smith John Michael', 'LFM');
echo $westernName->firstname; // "John"
echo $westernName->lastname;  // "Smith"

// Eastern names (First, Middle, Last)
$easternName = NameFormatter::make('Li Wei Chen', 'FML');
echo $easternName->firstname; // "Li"
echo $easternName->lastname;  // "Chen"

// Two-name format
$twoName = NameFormatter::make('Doe John', 'LF');
echo $twoName->firstname; // "John"
echo $twoName->lastname;  // "Doe"
```

### Edge Cases Handled

-   **Single names**: Returns the same value for first and last name
-   **Multiple middle names**: Combines all middle names into one string
-   **Extra spaces**: Automatically trims and normalizes spacing
-   **Empty names**: Returns empty strings gracefully
-   **Unicode support**: Properly handles international characters
-   **Property access**: Provides both method and property access to name components
-   **Format flexibility**: Automatically handles names with different numbers of parts

### Format Examples

Here are examples of how different formats work with the same name:

```php
$fullName = 'Eneye Tijani Usman';

// LFM format (default) - Last, First, Middle
$formatter = NameFormatter::make($fullName, 'LFM');
echo $formatter->firstname;  // "Tijani"
echo $formatter->middlename; // "Usman"
echo $formatter->lastname;   // "Eneye"
echo $formatter->initials;   // "ETU"

// FML format - First, Middle, Last
$formatter = NameFormatter::make($fullName, 'FML');
echo $formatter->firstname;  // "Eneye"
echo $formatter->middlename; // "Tijani"
echo $formatter->lastname;   // "Usman"
echo $formatter->initials;   // "ETU"

// LMF format - Last, Middle, First
$formatter = NameFormatter::make($fullName, 'LMF');
echo $formatter->firstname;  // "Usman"
echo $formatter->middlename; // "Tijani"
echo $formatter->lastname;   // "Eneye"
echo $formatter->initials;   // "ETU"
```

## API Reference

### Methods

| Method                                        | Description                 | Parameters                                                               | Returns                  |
| --------------------------------------------- | --------------------------- | ------------------------------------------------------------------------ | ------------------------ |
| `make(string $fullname, string $format)`      | Static factory method       | `$fullname` - Full name string, `$format` - Name format (default: 'LFM') | `NameFormatter` instance |
| `toUpperCase()`                               | Capitalize first letter     | None                                                                     | `string`                 |
| `toLowerCase()`                               | Lowercase entire string     | None                                                                     | `string`                 |
| `format(string $format)`                      | Format name with template   | `$format` - Template string                                              | `string`                 |
| `avatar(int $size, string $bg, string $text)` | Generate avatar URL         | `$size` - Size in pixels, `$bg` - Background color, `$text` - Text color | `string`                 |
| `avatarUrl(...)`                              | Alias for `avatar()` method | Same as `avatar()`                                                       | `string`                 |

### Constructor

```php
new NameFormatter(string $fullname, string $format = 'LFM')
```

The constructor accepts a full name string and an optional format parameter that determines how the name parts are interpreted.

**Format Parameter:**

-   **LFM** (default): Last, First, Middle - Common in Western cultures
-   **FML**: First, Middle, Last - Common in many cultures
-   **LMF**: Last, Middle, First - Alternative format
-   **FL**: First, Last - Two-name format
-   **LF**: Last, First - Two-name format

The format string uses single characters where:

-   **F** = First name position
-   **M** = Middle name position
-   **L** = Last name position

### Properties (via `__get`)

The following properties are accessible through PHP's magic `__get` method, which internally calls private methods:

| Property     | Description        | Returns  |
| ------------ | ------------------ | -------- |
| `firstname`  | First name         | `string` |
| `middlename` | Middle name(s)     | `string` |
| `lastname`   | Last name          | `string` |
| `initials`   | Initials           | `string` |
| `avatar`     | Default avatar URL | `string` |

### Format Template Placeholders

| Placeholder | Description    |
| ----------- | -------------- |
| `F`         | First name     |
| `M`         | Middle name(s) |
| `L`         | Last name      |

## Testing

Run the test suite:

```bash
composer test
```

Run tests with coverage:

```bash
composer test-coverage
```

## Code Formatting

Format your code using Laravel Pint:

```bash
composer format
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Security

If you discover any security-related issues, please email brainyworld10@gmail.com instead of using the issue tracker.

## Credits

-   [Tijani Eneye Usman](https://github.com/Tijanieneye10)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
