<?php

$dir = __DIR__ . '/app/Http/Controllers';
$files = glob($dir . '/*Controller.php');

foreach ($files as $file) {
    if (strpos($file, 'ProfileController') !== false) continue;
    if (strpos($file, 'Controller.php') === false) continue;
    if (basename($file) === 'Controller.php') continue;

    $content = file_get_contents($file);

    preg_match('/use App\\\\Models\\\\([a-zA-Z0-9_]+);/', $content, $matches);
    if (!$matches) continue;
    $model = $matches[1];

    preg_match("/return redirect\(\)->route\('([a-zA-Z0-9_-]+)\.index'\)/", $content, $routeMatches);
    if (!$routeMatches) continue;
    $routePrefix = $routeMatches[1];

    // Re-write store method
    $content = preg_replace_callback('/public function store\(Request \$request\)\s*\{\s*(.*?)\s*return redirect\(\)->route\([^)]+\).*?;\s*\}/s', function($m) use ($model, $routePrefix) {
        $body = trim($m[1]);
        if (strpos($body, 'try {') !== false) return $m[0]; // already refactored
        return <<<PHP
public function store(Request \$request)
    {
        try {
            {$body}
            return redirect()->route('{$routePrefix}.index')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Illuminate\Database\QueryException \$e) {
            if (\$e->errorInfo[1] == 1062) {
                return back()->with('error', 'Gagal! Terdapat duplikat data (ID atau data unik sudah ada).')->withInput();
            }
            return back()->with('error', 'Gagal menambahkan data: ' . \$e->getMessage())->withInput();
        } catch (\Exception \$e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . \$e->getMessage())->withInput();
        }
    }
PHP;
    }, $content);

    // Re-write update method
    $content = preg_replace_callback('/public function update\(Request \$request,\s*\$id\)\s*\{\s*(.*?)\s*return redirect\(\)->route\([^)]+\).*?;\s*\}/s', function($m) use ($model, $routePrefix) {
        $body = trim($m[1]);
        if (strpos($body, 'try {') !== false) return $m[0]; // already refactored
        return <<<PHP
public function update(Request \$request, \$id)
    {
        try {
            {$body}
            return redirect()->route('{$routePrefix}.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Database\QueryException \$e) {
            if (\$e->errorInfo[1] == 1062) {
                return back()->with('error', 'Gagal! Terdapat duplikat data (ID atau data unik sudah ada).')->withInput();
            }
            return back()->with('error', 'Gagal memperbarui data: ' . \$e->getMessage())->withInput();
        } catch (\Exception \$e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . \$e->getMessage())->withInput();
        }
    }
PHP;
    }, $content);

    // Re-write destroy method
    $content = preg_replace_callback('/public function destroy\(\$id\)\s*\{\s*(.*?)\s*return redirect\(\)->route\([^)]+\).*?;\s*\}/s', function($m) use ($model, $routePrefix) {
        $body = trim($m[1]);
        if (strpos($body, 'try {') !== false) return $m[0]; // already refactored
        return <<<PHP
public function destroy(\$id)
    {
        try {
            {$body}
            return redirect()->route('{$routePrefix}.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException \$e) {
            if (\$e->errorInfo[1] == 1451) {
                return back()->with('error', 'Gagal! Data ini tidak bisa dihapus karena sedang digunakan oleh tabel lain.');
            }
            return back()->with('error', 'Gagal menghapus data: ' . \$e->getMessage());
        } catch (\Exception \$e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . \$e->getMessage());
        }
    }
PHP;
    }, $content);

    file_put_contents($file, $content);
}

echo "Controllers updated successfully with regex group captures.\n";
