<?
// Root path
define("ROOT", dirname(__DIR__));
define("VENDOR", ROOT . "/vendor");
define("AUTOLOAD", VENDOR . "/autoload.php");

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

// DB settings (в Docker задаются через environment)
define("DB_DRIVER", "mysql");
define("DB_HOST", getenv("DB_HOST") ?: "127.0.0.1");
define("DB_PORT", getenv("DB_PORT") ?: "3306");
define("DB_DATABASE", getenv("DB_DATABASE") ?: "mvc-schedule");
define("DB_USERNAME", getenv("DB_USERNAME") ?: "root");
define("DB_PASSWORD", getenv("DB_PASSWORD") !== false ? getenv("DB_PASSWORD") : "");
define("DB_CHARSET", "utf8mb4");
define("DB_COLLATION", "utf8mb4_unicode_ci");
define("DB_PREFIX", "");
define("DB_OPTIONS", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
define("MIGRATIONS", ROOT . "/database/migrations");

// Log const
define("LOG_PATH", ROOT . "/tmp/logs");
define("ERROR_LOGS", LOG_PATH . "/errors.log");

// Cache path
define("CACHE_PATH", ROOT . "/tmp/cache");
define("USE_REDIS", true);
define("REDIS_IP", getenv("REDIS_IP") ?: "127.0.0.1");
define("REDIS_PORT", getenv("REDIS_PORT") ?: "6379");

// Files
define("UPLOADS", PUBLIC_PATH . "/uploads");

// Enother const
define("LAYOUT", 'default');
define("PATH", "http://localhost:8080");

// Debug
define("DEBUG", "dev");
// define("DEBUG", "prod");