<?

namespace Youpi;

// use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{

    protected string $uri;

    public Request $request;
    public Response $response;
    public Router $router;

    public View $view;

    public Session $session;

    public Cache $cache;

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
        $this->cache = new Cache();

        $this->db = new Database();

        $this->view = new View(LAYOUT);

        $this->generateCsrfToken();
        Auth::setUser();
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
}
