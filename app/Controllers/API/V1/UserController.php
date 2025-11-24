<?

namespace App\Controllers\API\V1;

class UserController
{

    public function index()
    {
        response()->json([
            'status' => 'ok',
            'data' => db()->query('select * from users')->get(),
        ]);
    }

    public function view($id)
    {
        response()->json([
            'status' => 'ok',
            'data' => db()->findOrFail('users', $id),
        ]);
    }
}
