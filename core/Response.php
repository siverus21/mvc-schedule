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
}
