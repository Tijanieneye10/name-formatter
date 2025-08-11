# Name Formatter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tijanieneye10/name-formatter.svg?style=flat-square)](https://packagist.org/packages/tijanieneye10/name-formatter)
[![Tests](https://img.shields.io/github/actions/workflow/status/tijanieneye10/name-formatter/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tijanieneye10/name-formatter/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/tijanieneye10/name-formatter.svg?style=flat-square)](https://packagist.org/packages/tijanieneye10/name-formatter)
[![License](https://img.shields.io/github/license/tijanieneye10/name-formatter.svg?style=flat-square)](LICENSE.md)

A simple and lightweight PHP package for formatting and extracting information from full names. Perfect for applications that need to handle user names, display initials, or format names consistently.

## Features

-   🎯 **Extract first, middle, and last names** from full names
-   🔤 **Generate initials** from full names (supports multiple names)
-   📝 **Text case formatting** (capitalize, lowercase first letter)
-   🎨 **Custom name formatting** with flexible templates
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

## Requirements

-   PHP 8.4 or higher

## Usage

### Basic Usage

```php
use Tijanieneye10\Playground\NameFormatter;

// Create a new instance
$formatter = new NameFormatter('John Doe');

// Or use the static factory method (recommended)
$formatter = NameFormatter::make('John Doe');
```

### Available Methods

#### Extract Names

```php
$formatter = NameFormatter::make('John Michael Doe');

// Get first name
$firstName = $formatter->firstname(); // Returns: "John"

// Get middle name(s)
$middleName = $formatter->middlename(); // Returns: "Michael"

// Get last name
$lastName = $formatter->lastname(); // Returns: "Doe"

// You can also access these as properties
$firstName = $formatter->firstname; // Same as above
$middleName = $formatter->middlename; // Same as above
$lastName = $formatter->lastname; // Same as above
```

#### Generate Initials

```php
$formatter = NameFormatter::make('John Michael Doe');

// Get initials (supports multiple names)
$initials = $formatter->initials(); // Returns: "JMD"

// Or access as property
$initials = $formatter->initials; // Same as above
```

#### Text Formatting

```php
$formatter = NameFormatter::make('john doe');

// Capitalize first letter
$capitalized = $formatter->capitalize(); // Returns: "John doe"

// Lowercase first letter
$lowerCaps = $formatter->lowerCaps(); // Returns: "john doe"
```

#### Custom Name Formatting

```php
$formatter = NameFormatter::make('John Michael Doe');

// Default format: "John Michael Doe"
$default = $formatter->format();

// Custom formats using placeholders:
// F = First name, M = Middle name, L = Last name
$lastFirst = $formatter->format('L, F M'); // Returns: "Doe, John Michael"
$initialsOnly = $formatter->format('F. M. L.'); // Returns: "J. Michael. Doe."
$formal = $formatter->format('L, F'); // Returns: "Doe, John"
```

#### Generate Avatar URLs

```php
$formatter = NameFormatter::make('John Doe');

// Generate avatar URL with default settings
$avatarUrl = $formatter->avatar(); // Returns: "https://ui-avatars.com/api/?name=John%20Doe&size=100&background=3B82F6&color=FFFFFF&bold=true&format=svg"

// Customize avatar size and colors
$avatarUrl = $formatter->avatar(200, 'FF6B6B', 'FFFFFF'); // Custom size and background color

// Or use the alias method
$avatarUrl = $formatter->avatarUrl(150, '10B981', '000000'); // Green background, black text
```

### Real-World Examples

#### User Profile Display

```php
$userName = 'jane marie smith';
$formatter = NameFormatter::make($userName);

echo "Welcome, " . $formatter->capitalize(); // "Welcome, Jane marie smith"
echo "Your initials: " . $formatter->initials; // "Your initials: JMS"
echo "Formal name: " . $formatter->format('L, F M'); // "Formal name: Smith, Jane Marie"
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
$fullName = 'Dr. John Michael Doe Jr.';
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
    'John Doe',
    'Jane Smith',
    'Bob Johnson'
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

### Edge Cases Handled

-   **Single names**: Returns the same value for first and last name
-   **Multiple middle names**: Combines all middle names into one string
-   **Extra spaces**: Automatically trims and normalizes spacing
-   **Empty names**: Returns empty strings gracefully
-   **Unicode support**: Properly handles international characters
-   **Property access**: Provides both method and property access to name components

## API Reference

### Methods

| Method                                        | Description                 | Parameters                                                               | Returns                  |
| --------------------------------------------- | --------------------------- | ------------------------------------------------------------------------ | ------------------------ |
| `make(string $fullname)`                      | Static factory method       | `$fullname` - Full name string                                           | `NameFormatter` instance |
| `firstname()`                                 | Get first name              | None                                                                     | `string`                 |
| `middlename()`                                | Get middle name(s)          | None                                                                     | `string`                 |
| `lastname()`                                  | Get last name               | None                                                                     | `string`                 |
| `initials()`                                  | Get initials                | None                                                                     | `string`                 |
| `capitalize()`                                | Capitalize first letter     | None                                                                     | `string`                 |
| `lowerCaps()`                                 | Lowercase first letter      | None                                                                     | `string`                 |
| `format(string $format)`                      | Format name with template   | `$format` - Template string                                              | `string`                 |
| `avatar(int $size, string $bg, string $text)` | Generate avatar URL         | `$size` - Size in pixels, `$bg` - Background color, `$text` - Text color | `string`                 |
| `avatarUrl(...)`                              | Alias for `avatar()` method | Same as `avatar()`                                                       | `string`                 |

### Properties (via `__get`)

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
