<?

namespace Youpi;

class Application
{

    protected string $uri;

    public Request $request;
    public Response $response;
    public Router $router;

    public View $view;

    public Session $session;

    public static Application $app;

    public function __construct()
    {
        self::$app = $this;

        $this->uri = $_SERVER['REQUEST_URI'];

        $this->request = new Request($this->uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();

        $this->view = new View(LAYOUT);

        $this->generateCsrfToken();
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
}
