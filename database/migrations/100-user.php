<?

use Youpi\Migrations\Migration;
use Youpi\Migrations\Blueprint;

return new Migration('users', [
    'up' => function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->timestamps();
    },
    'down' => function (string $tableName) {
        return "DROP TABLE IF EXISTS `{$tableName}`;";
    }
]);
