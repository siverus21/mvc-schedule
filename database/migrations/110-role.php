<?

use Youpi\Migrations\Migration;
use Youpi\Migrations\Blueprint;

return new Migration('role', [
    'up' => function (Blueprint $table) {
        $table->id();
        $table->string('name');
    },
    'down' => function (string $tableName) {
        return "DROP TABLE IF EXISTS `{$tableName}`;";
    }
]);
