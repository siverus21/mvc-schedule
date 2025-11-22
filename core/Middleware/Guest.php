<?

namespace Youpi\Middleware;

class Guest
{

    public function handle(): void
    {
        if (checkAuth()) {
            response()->redirect(base_url('/dashboard'));
        }
    }
}
