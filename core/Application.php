<?php

namespace Youpi;

use Illuminate\Database\Capsule\Manager as Capsule;
use Youpi\Contracts\CacheInterface;

class Application
{

    protected string $uri;

    public Request $request;
    public Response $response;
    public Router $router;

    public View $view;

    public Session $session;

    /** Драйвер кэша (Redis или файловый), переключение через USE_REDIS */
    public CacheInterface $cache;

    public Database $db;

    public static Application $app;

    protected array $container = [];

    public function __construct()
    {
        self::$app = $this;

        $this->uri = $_SERVER['REQUEST_URI'];

        $this->request = new Request($this->uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();

        $this->db = new Database();

        $this->view = new View(LAYOUT);

        $this->cache = $this->createCacheDriver();

        $this->generateCsrfToken();
        Auth::setUser();
    }

    /**
     * Создаёт драйвер кэша по конфигу (USE_REDIS). Легко расширить под другие драйверы.
     */
    protected function createCacheDriver(): CacheInterface
    {
        if (USE_REDIS) {
            return new CacheRedis();
        }
        return new Cache();
    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }

    public function generateCsrfToken(): void
    {
        if (!session()->isSet('_csrf_token')) {
            session()->set('_csrf_token', md5(uniqid(mt_rand(), true)));
        }
    }

    public function set($key, $value): void
    {
        $this->container[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return $this->container[$key] ?? $default;
    }

    public function setDbConnection()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => DB_DRIVER,
            'host'      => DB_HOST,
            'database'  => DB_DATABASE,
            'username'  => DB_USERNAME,
            'password'  => DB_PASSWORD,
            'charset'   => DB_CHARSET,
            'collation' => DB_COLLATION,
            'prefix'    => DB_PREFIX,
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
