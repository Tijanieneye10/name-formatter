<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Tijanieneye10\Playground\NameFormatter;

echo "🔮 MAGIC METHOD __get() EXPLAINED!\n";
echo "==================================\n\n";

$formatter = NameFormatter::make('John Michael Doe');

echo "📝 Our Test Object:\n";
echo "Full Name: 'John Michael Doe'\n";
echo "Object Class: " . get_class($formatter) . "\n\n";

echo "🎯 HOW __get() MAGIC METHOD WORKS:\n";
echo "==================================\n\n";

echo "Step 1: When you access a property that doesn't exist...\n";
echo "        \$formatter->firstname\n\n";

echo "Step 2: PHP automatically calls the __get() method\n";
echo "        __get('firstname')\n\n";

echo "Step 3: The __get() method uses match() to route the request\n";
echo "        'firstname' => \$this->firstname()\n\n";

echo "Step 4: It calls the private method and returns the result\n";
echo "        return 'John'\n\n";

echo "🎨 LET'S SEE IT IN ACTION:\n";
echo "==========================\n\n";

// Show the magic happening
echo "Accessing \$formatter->firstname:\n";
echo "Result: '" . $formatter->firstname . "'\n\n";

echo "Accessing \$formatter->lastname:\n";
echo "Result: '" . $formatter->lastname . "'\n\n";

echo "Accessing \$formatter->middlename:\n";
echo "Result: '" . $formatter->middlename . "'\n\n";

echo "Accessing \$formatter->initials:\n";
echo "Result: '" . $formatter->initials . "'\n\n";

echo "🔍 BEHIND THE SCENES - What PHP Actually Does:\n";
echo "===============================================\n\n";

echo "When you write: \$formatter->firstname\n";
echo "PHP internally does this:\n";
echo "  1. Check if 'firstname' property exists → NO\n";
echo "  2. Check if __get() method exists → YES\n";
echo "  3. Call __get('firstname')\n";
echo "  4. Execute: match('firstname') { 'firstname' => \$this->firstname() }\n";
echo "  5. Call private method firstname() → returns 'John'\n";
echo "  6. Return 'John' to you\n\n";

echo "🎯 THE MATCH STATEMENT BREAKDOWN:\n";
echo "================================\n\n";

echo "match (\$name) {\n";
echo "    'firstname' => \$this->firstname(),    // Returns 'John'\n";
echo "    'lastname'  => \$this->lastname(),     // Returns 'Doe'\n";
echo "    'middlename'=> \$this->middlename(),   // Returns 'Michael'\n";
echo "    'initials'  => \$this->initials(),     // Returns 'JMD'\n";
echo "    default     => throw new Exception()   // For unknown properties\n";
echo "}\n\n";

echo "🚫 WHAT HAPPENS WITH UNKNOWN PROPERTIES:\n";
echo "========================================\n\n";

echo "If you try to access a property that doesn't exist:\n";
echo "Try: \$formatter->unknown_property\n\n";

try {
    $unknown = $formatter->unknown_property;
} catch (\InvalidArgumentException $e) {
    echo "❌ Error caught: " . $e->getMessage() . "\n";
    echo "This is the 'default' case in the match statement!\n\n";
}

echo "🔒 WHY MAKE METHODS PRIVATE?\n";
echo "============================\n\n";

echo "1. **Encapsulation**: Hide internal implementation details\n";
echo "2. **Single Access Point**: Only __get() can access these methods\n";
echo "3. **Consistent API**: Users always use properties, never methods\n";
echo "4. **Future Flexibility**: Can change internal logic without breaking API\n";
echo "5. **Clean Interface**: Public API is just properties + utility methods\n\n";

echo "🎉 BENEFITS OF THIS APPROACH:\n";
echo "=============================\n\n";

echo "✅ **Natural Syntax**: \$formatter->firstname feels natural\n";
echo "✅ **Lazy Loading**: Values calculated only when accessed\n";
echo "✅ **Encapsulated**: Internal methods are hidden\n";
echo "✅ **Flexible**: Easy to add new properties later\n";
echo "✅ **Error Handling**: Clear errors for invalid properties\n";
echo "✅ **Performance**: No unnecessary calculations\n\n";

echo "✨ MAGIC METHODS MAKE PHP POWERFUL!\n";
echo "🎭 They let you create custom behavior for property access!\n";
