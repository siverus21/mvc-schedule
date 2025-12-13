<?

namespace Youpi;

class Router
{
    protected Request $request;
    protected Response $response;

    protected array $routes = [];
    protected array $params = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function add($path, $callback, $method): self
    {
        $path = trim($path, '/');

        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }

        $this->routes[] = [
            "path" => "/$path",
            "callback" => $callback,
            "middleware" => [],
            "method" => $method,
            "needCsrfToken" => true,
        ];

        return $this;
    }

    public function get($path, $callback): self
    {
        return $this->add($path, $callback, 'GET');
    }

    public function post($path, $callback): self
    {
        return $this->add($path, $callback, 'POST');
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function dispatch(): mixed
    {
        $path = $this->request->getPath();
        $route = $this->matchRoute($path);

        if ($route === false) {
            abort('Test 404 error');
        }

        if (is_array($route['callback'])) {
            $route['callback'][0] = new $route['callback'][0];
        }

        return call_user_func($route['callback']);
    }

    protected function matchRoute($path): mixed
    {
        $requestPath = '/' . trim($path, '/');
        if ($requestPath === '//') {
            $requestPath = '/';
        }

        $allowedMethods = [];

        foreach ($this->routes as $route) {
            $routePattern = preg_replace_callback(
                '/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/',
                function ($m) {
                    return '(?P<' . $m[1] . '>[^/]+)';
                },
                $route['path']
            );

            $regex = "#^" . $routePattern . "$#";

            if (
                preg_match($regex, $requestPath, $matches)
            ) {

                if (!in_array($this->request->getMethod(), $route['method'])) {
                    $allowedMethods = array_merge($allowedMethods, $route['method']);
                    continue;
                }

                // middleware
                if ($route['middleware']) {
                    foreach ($route['middleware'] as $item) {
                        if (strpos($item, ':') !== false) {
                            $nameParam = explode(':', $item)[0];
                            $valueParam = explode(',', explode(':', $item)[1]);
                        } else {
                            $nameParam = $item;
                            $valueParam = [];
                        }
                        $middleware = MIDDLEWARE[$nameParam] ?? false;
                        if ($middleware) {
                            (new $middleware)->handle($valueParam);
                        }
                    }
                }

                // CSRF
                if (request()->isPost()) {
                    if ($route['needCsrfToken'] && !$this->checkCsrfToken()) {
                        if (request()->isAjax()) {
                            echo json_encode([
                                'status' => 'error',
                                'data' => 'csrf token error',
                            ]);
                            die;
                        } else {
                            abort('csrf token error', 419);
                        }
                    }
                }

                // Забираем именованные захваты из $matches в $this->params
                $this->params = [];
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $this->params[$k] = $v;
                    }
                }

                // Если callback задан как [ClassName::class, 'method'], превратим его в замыкание,
                // которое создаёт экземпляр контроллера и вызывает нужный метод с параметрами.
                // Это позволяет оставить dispatch без изменений (call_user_func).
                if (is_array($route['callback']) && is_string($route['callback'][0])) {
                    $class = $route['callback'][0];
                    $method = $route['callback'][1] ?? null;
                    $params = $this->params; // фиксируем текущие параметры для замыкания

                    $route['callback'] = function () use ($class, $method, $params) {
                        $controller = new $class;
                        if ($method === null) {
                            // Если передали только класс — попробуем вызвать __invoke
                            if (is_callable([$controller, '__invoke'])) {
                                return call_user_func_array([$controller, '__invoke'], array_values($params));
                            }
                            throw new \RuntimeException("Method not specified for controller {$class}");
                        }
                        return call_user_func_array([$controller, $method], array_values($params));
                    };
                }

                return $route;
            }
        }

        if ($allowedMethods) {
            header("Allow: " . implode(", ", array_unique($allowedMethods)));
            if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
                response()->json([
                    'status' => 'error',
                    'data' => 'Method not allowed',
                ], 405);
            }
            abort('Method not allowed', 405);
        }

        return false;
    }

    public function withoutCsrfToken(): self
    {
        $this->routes[array_key_last($this->routes)]['needCsrfToken'] = false;
        return $this;
    }

    public function checkCsrfToken(): bool
    {
        return request()->post('_csrf_token') && request()->post('_csrf_token') === session()->get('_csrf_token');
    }

    public function middleware(array $middleware): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }
}
