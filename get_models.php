<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$models = [
    'Brand', 'Departemen', 'Kategori', 'SubKategori', 'Store', 'Inventori', 'MutasiStok', 'Produk', 'Supplier'
];

$output = [];
foreach ($models as $modelName) {
    $class = '\\App\\Models\\' . $modelName;
    if (class_exists($class)) {
        $model = new $class;
        $output[$modelName] = [
            'table' => $model->getTable(),
            'primaryKey' => $model->getKeyName(),
            'fillable' => $model->getFillable(),
        ];
    }
}

file_put_contents('models_info.json', json_encode($output, JSON_PRETTY_PRINT));
echo "Models info saved.";
