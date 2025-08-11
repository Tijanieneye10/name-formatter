# Name Formatter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tijanieneye10/name-formatter.svg?style=flat-square)](https://packagist.org/packages/tijanieneye10/name-formatter)
[![Tests](https://img.shields.io/github/actions/workflow/status/tijanieneye10/name-formatter/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tijanieneye10/name-formatter/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/tijanieneye10/name-formatter.svg?style=flat-square)](https://packagist.org/packages/tijanieneye10/name-formatter)
[![License](https://img.shields.io/github/license/tijanieneye10/name-formatter.svg?style=flat-square)](LICENSE.md)

A simple and lightweight PHP package for formatting and extracting information from full names. Perfect for applications that need to handle user names, display initials, or format names consistently.

## Features

-   🎯 **Extract first and last names** from full names
-   🔤 **Generate initials** from full names
-   📝 **Text case formatting** (capitalize, lowercase first letter)
-   🚀 **Simple and fluent API** with static factory method
-   💪 **PHP 8.4+** with modern features
-   🧪 **Fully tested** with Pest PHP

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
$formatter = NameFormatter::make('John Doe');

// Get first name
$firstName = $formatter->firstname(); // Returns: "John"

// Get last name
$lastName = $formatter->lastname(); // Returns: "Doe"
```

#### Generate Initials

```php
$formatter = NameFormatter::make('John Doe');

// Get initials
$initials = $formatter->initials(); // Returns: "JD"
```

#### Text Formatting

```php
$formatter = NameFormatter::make('john doe');

// Capitalize first letter
$capitalized = $formatter->capitalize(); // Returns: "John doe"

// Lowercase first letter
$lowerCaps = $formatter->lowerCaps(); // Returns: "john doe"
```

### Real-World Examples

#### User Profile Display

```php
$userName = 'jane smith';
$formatter = NameFormatter::make($userName);

echo "Welcome, " . $formatter->capitalize(); // "Welcome, Jane smith"
echo "Your initials: " . $formatter->initials(); // "Your initials: JS"
```

#### Form Processing

```php
$fullName = $_POST['full_name'] ?? '';
$formatter = NameFormatter::make($fullName);

$firstName = $formatter->firstname();
$lastName = $formatter->lastname();
$initials = $formatter->initials();

// Use in database or display
```

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
