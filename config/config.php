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


// Константы
define("LAYOUT", 'default');
define("PATH", "http://localhost");

// Langs
define("LANG_VALIDATOR", PUBLIC_PATH . '/langValidator');