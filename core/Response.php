<?

namespace Youpi;

class Response
{

    public function setStatusResponse(int $statusCode): void
    {
        http_response_code($statusCode);
    }

    public function redirect()
    {
        // TODO
    }
}
