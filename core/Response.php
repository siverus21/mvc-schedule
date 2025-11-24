<?

namespace Youpi;

class Response
{

    public function setStatusResponse(int $statusCode): void
    {
        http_response_code($statusCode);
    }

    public function redirect($url = '')
    {
        if ($url) {
            $redirect = $url;
        } else {
            $redirect = $_SERVER['HTTP_REFERER'] ?? base_url('/');
        }

        header('Location: ' . $redirect);
        die;
    }

    public function json($data, $code = 200): void
    {
        $this->setStatusResponse($code);
        header('Content-Type: application/json; charset=utf-8');
        exit(json_encode($data));
    }
}
