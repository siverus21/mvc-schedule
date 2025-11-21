<?

define("ROOT", dirname(__DIR__)); // Корневая константа

// Core
define("CORE", ROOT . "/core");
define("PUBLIC_PATH", ROOT . "/public");

// Config
define("CONFIG", ROOT . "/config");
define("HELPERS", ROOT . "/helpers");

// App
define("APP", ROOT . "/app");
define("VIEWS", APP . "/Views");
define("LAYOUTS", APP . "/Views/layouts");

// Langs
define("LANG_VALIDATOR", PUBLIC_PATH . '/langValidator');

// DB settings
define("DB_DRIVER", "mysql");
define("DB_HOST", "127.0.0.1");
define("DB_PORT", "3306");
define("DB_DATABASE", "mvc-schedule");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_CHARSET", "utf8mb4");
define("DB_COLLATION", "utf8mb4_unicode_ci");
define("DB_PREFIX", "");
define("DB_OPTIONS", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// Log const
define("LOG_PATH", ROOT . "/tmp/logs");
define("ERROR_LOGS", LOG_PATH . "/errors.log");

// Константы
define("LAYOUT", 'default');
define("PATH", "http://localhost");

// Debug
// define("DEBUG", "dev");
define("DEBUG", "prod");