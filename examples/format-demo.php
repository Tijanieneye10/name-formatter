<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Tijanieneye10\Playground\NameFormatter;

echo "🎨 FORMAT METHOD DEMO!\n";
echo "=====================\n\n";

$formatter = NameFormatter::make('John Michael Doe');

echo "Test Name: 'John Michael Doe'\n";
echo 'First: '.$formatter->firstname()."\n";
echo 'Middle: '.$formatter->middlename()."\n";
echo 'Last: '.$formatter->lastname()."\n\n";

echo "🎯 FORMAT EXAMPLES:\n";
echo "==================\n\n";

echo "Default (F M L):     '".$formatter->format()."'\n";
echo "Last, First (L, F):  '".$formatter->format('L, F')."'\n";
echo "Last, F M (L, F M):  '".$formatter->format('L, F M')."'\n";
echo "With dots (F. M. L.): '".$formatter->format('F. M. L.')."'\n";
echo "File style (F_M_L):   '".$formatter->format('F_M_L')."'\n";
echo "Compact (FL):         '".$formatter->format('FL')."'\n";
echo "Reverse (L M F):      '".$formatter->format('L M F')."'\n\n";

echo "🌟 CREATIVE FORMATS:\n";
echo "====================\n\n";

echo "Welcome: '".$formatter->format('Welcome, F M L!')."'\n";
echo "User ID: '".$formatter->format('L_F_M')."'\n";
echo "Formal:  '".$formatter->format('Mr. F M L')."'\n";
echo "Email:   '".$formatter->format('F.M.L@email.com')."'\n\n";

echo "✨ The format method is super flexible!\n";
echo "🎨 Use F, M, L as placeholders and get creative!\n";
