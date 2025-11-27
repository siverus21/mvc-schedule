<?php
// create_migration.php - утилита для создания файлов миграций

require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';

$migrationName = $argv[1] ?? null;

if (!$migrationName) {
    echo "Использование: php create_migration.php имя_миграции\n";
    exit(1);
}

$timestamp = date('Y_m_d_His');
$className = 'Create' . str_replace(' ', '', ucwords(str_replace('_', ' ', $migrationName))) . 'Table';
$filename = $timestamp . '_' . $migrationName . '.php';
$migrationsPath = ROOT . '/database/migrations/' . $filename;

$content = <<<PHP
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 
    }

    public function down()
    {
        // 
    }
};
PHP;

file_put_contents($migrationsPath, $content);
echo "Миграция создана: $filename\n";
