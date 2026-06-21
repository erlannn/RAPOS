<?php

$models = json_decode(file_get_contents('models_info.json'), true);

$baseLayout = "x-app-layout";

function generateController($modelName, $table) {
    $lower = strtolower($modelName);
    $path = "app/Http/Controllers/{$modelName}Controller.php";
    $content = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Models\\$modelName;
use Illuminate\Http\Request;

class {$modelName}Controller extends Controller
{
    public function index()
    {
        \$$lower = $modelName::all();
        return view('Master-data.{$modelName}.index', compact('$lower'));
    }

    public function create()
    {
        return view('Master-data.{$modelName}.create');
    }

    public function store(Request \$request)
    {
        $modelName::create(\$request->all());
        return redirect()->route('{$lower}.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(\$id)
    {
        \$$lower = $modelName::findOrFail(\$id);
        return view('Master-data.{$modelName}.edit', compact('$lower'));
    }

    public function update(Request \$request, \$id)
    {
        \$$lower = $modelName::findOrFail(\$id);
        \$reqData = \$request->except(['_token', '_method']);
        \${$lower}->update(\$reqData);
        return redirect()->route('{$lower}.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(\$id)
    {
        $modelName::destroy(\$id);
        return redirect()->route('{$lower}.index')->with('success', 'Data berhasil dihapus');
    }
}
PHP;
    file_put_contents($path, $content);
}

function generateViews($modelName, $info) {
    $lower = strtolower($modelName);
    $dir = "resources/views/Master-data/{$modelName}";
    if (!is_dir($dir)) mkdir($dir, 0777, true);

    $fields = array_filter($info['fillable'], fn($f) => !in_array($f, ['CreatedAt', 'UpdatedAt']));

    // INDEX VIEW
    $ths = "";
    $tds = "";
    foreach($fields as $f) {
        $ths .= "<th class=\"px-3 py-2 border\">{$f}</th>\n";
        $tds .= "<td class=\"px-3 py-2 border\">{{ \$item->{$f} }}</td>\n";
    }

    $indexContent = <<<BLADE
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                <div class="flex gap-3">
                    <a href="{{ route('{$lower}.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-700 text-sm flex items-center">
                        + Tambah {$modelName}
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                $ths
                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\${$lower} as \$index => \$item)
                                <tr>
                                    <td class="px-3 py-2 border">{{ \$index + 1 }}</td>
                                    $tds
                                    <td class="px-3 py-2 border">
                                        <a href="{{ route('{$lower}.edit', \$item->{$info['primaryKey']}) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs inline-block">Edit</a>
                                        <form action="{{ route('{$lower}.destroy', \$item->{$info['primaryKey']}) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-xs">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
BLADE;
    file_put_contents("$dir/index.blade.php", $indexContent);

    // CREATE VIEW
    $inputs = "";
    foreach($fields as $f) {
        $inputs .= <<<HTML
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{$f}</label>
                                <input type="text" name="{$f}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan {$f}">
                            </div>

HTML;
    }
    
    $createContent = <<<BLADE
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Tambah {$modelName} Baru</h2>
                <a href="{{ route('{$lower}.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('{$lower}.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
$inputs
                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <a href="{{ route('{$lower}.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 text-sm">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
BLADE;
    file_put_contents("$dir/create.blade.php", $createContent);

    // EDIT VIEW
    $editInputs = "";
    foreach($fields as $f) {
        $editInputs .= <<<HTML
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{$f}</label>
                                <input type="text" name="{$f}" value="{{ \$$lower->{$f} }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan {$f}">
                            </div>

HTML;
    }

    $editContent = <<<BLADE
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Edit {$modelName}</h2>
                <a href="{{ route('{$lower}.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded-lg shadow hover:bg-gray-600 text-sm">
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('{$lower}.update', \$$lower->{$info['primaryKey']}) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
$editInputs
                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t">
                            <a href="{{ route('{$lower}.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 text-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
BLADE;
    file_put_contents("$dir/edit.blade.php", $editContent);
}

foreach ($models as $name => $info) {
    // Generate controller and views for each
    generateController($name, $info['table']);
    generateViews($name, $info);
}

echo "CRUD Controllers and Views generated successfully.\n";

