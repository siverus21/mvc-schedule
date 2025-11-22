<?

namespace Youpi\Middleware;

class Auth
{

    public function handle(): void
    {
        if (!checkAuth()) {
            session()->setFlash('error', 'Forbidden');
            response()->redirect(base_url('/login'));
        }
    }
}
