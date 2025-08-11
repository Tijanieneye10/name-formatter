<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Tijanieneye10\Playground\NameFormatter;

echo "🎨 FORMAT METHOD DEMO - See the Magic in Action!\n";
echo "================================================\n\n";

// Let's use a name with middle names to show all possibilities
$formatter = NameFormatter::make('John Michael Doe');

echo "📝 Our Test Name: 'John Michael Doe'\n";
echo 'First Name: '.$formatter->firstname()."\n";
echo 'Middle Name: '.$formatter->middlename()."\n";
echo 'Last Name: '.$formatter->lastname()."\n";
echo 'Initials: '.$formatter->initials()."\n\n";

echo "🎯 FORMAT METHOD EXAMPLES:\n";
echo "==========================\n\n";

// 1. Default format
echo "1️⃣ Default Format (F M L):\n";
echo "   Template: 'F M L'\n";
echo "   Result:   '".$formatter->format()."'\n\n";

// 2. Last, First format
echo "2️⃣ Last, First Format:\n";
echo "   Template: 'L, F'\n";
echo "   Result:   '".$formatter->format('L, F')."'\n\n";

// 3. Last, First Middle format
echo "3️⃣ Last, First Middle Format:\n";
echo "   Template: 'L, F M'\n";
echo "   Result:   '".$formatter->format('L, F M')."'\n\n";

// 4. With dots
echo "4️⃣ With Dots Format:\n";
echo "   Template: 'F. M. L.'\n";
echo "   Result:   '".$formatter->format('F. M. L.')."'\n\n";

// 5. Formal business style
echo "5️⃣ Formal Business Style:\n";
echo "   Template: 'L, F M'\n";
echo "   Result:   '".$formatter->format('L, F M')."'\n\n";

// 6. Initials style
echo "6️⃣ Initials Style:\n";
echo "   Template: 'F. M. L.'\n";
echo "   Result:   '".$formatter->format('F. M. L.')."'\n\n";

// 7. Custom separators
echo "7️⃣ Custom Separators:\n";
echo "   Template: 'F | M | L'\n";
echo "   Result:   '".$formatter->format('F | M | L')."'\n\n";

// 8. File naming style
echo "8️⃣ File Naming Style:\n";
echo "   Template: 'F_M_L'\n";
echo "   Result:   '".$formatter->format('F_M_L')."'\n\n";

// 9. Compact format
echo "9️⃣ Compact Format:\n";
echo "   Template: 'FL'\n";
echo "   Result:   '".$formatter->format('FL')."'\n\n";

// 10. Reverse order
echo "🔟 Reverse Order:\n";
echo "    Template: 'L M F'\n";
echo "    Result:   '".$formatter->format('L M F')."'\n\n";

echo "🎨 MORE CREATIVE EXAMPLES:\n";
echo "==========================\n\n";

// Creative formats
echo "🌟 Welcome Message:\n";
echo "   Template: 'Welcome, F M L!'\n";
echo "   Result:   '".$formatter->format('Welcome, F M L!')."'\n\n";

echo "🌟 User ID Format:\n";
echo "   Template: 'L_F_M'\n";
echo "   Result:   '".$formatter->format('L_F_M')."'\n\n";

echo "🌟 Display Name:\n";
echo "   Template: 'F M L'\n";
echo "   Result:   '".$formatter->format('F M L')."'\n\n";

echo "🌟 Formal Address:\n";
echo "   Template: 'Mr. F M L'\n";
echo "   Result:   '".$formatter->format('Mr. F M L')."'\n\n";

echo "🎯 TRY DIFFERENT NAMES:\n";
echo "======================\n\n";

// Test with different names
$names = [
    'Alice Johnson',
    'Bob Michael Smith',
    'Carol A B Davis',
    'David',
    'Emma Grace Wilson',
];

foreach ($names as $name) {
    $f = NameFormatter::make($name);
    echo "Name: '".str_pad($name, 20)."'\n";
    echo "  F M L:     '".$f->format('F M L')."'\n";
    echo "  L, F M:    '".$f->format('L, F M')."'\n";
    echo "  F. M. L.:  '".$f->format('F. M. L.')."'\n";
    echo "  F_M_L:     '".$f->format('F_M_L')."'\n";
    echo "\n";
}

echo "✨ The format method is incredibly flexible!\n";
echo "🎨 You can create ANY name format you want!\n";
echo "🔧 Just use F, M, L as placeholders and get creative!\n";
