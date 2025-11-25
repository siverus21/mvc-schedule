<?

use Youpi\Migrations\Migration;
use Youpi\Migrations\Blueprint;

return new Migration('users', [
    'up' => function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedTinyInteger('role')->default(0);
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    },
    'down' => function (string $tableName) {
        return "DROP TABLE IF EXISTS `{$tableName}`;";
    }
]);
