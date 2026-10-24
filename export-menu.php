<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$data = [
    'groups' => \Illuminate\Support\Facades\DB::table('groups')->get()->toArray(),
    'categories' => \Illuminate\Support\Facades\DB::table('categories')->get()->toArray(),
    'products' => \Illuminate\Support\Facades\DB::table('products')->get()->toArray(),
];

$data = array_map(
    fn ($rows) => array_map(fn ($row) => (array) $row, $rows),
    $data
);

file_put_contents(
    __DIR__ . '/menu-export.json',
    json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR)
);

echo "Export completed\n";
echo "Groups: " . count($data['groups']) . "\n";
echo "Categories: " . count($data['categories']) . "\n";
echo "Products: " . count($data['products']) . "\n";
