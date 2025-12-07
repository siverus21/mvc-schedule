<?

namespace App\Models;

use Youpi\Model;

class RoomTypeModel extends Model
{
    protected string $table = 'room_types';
    public bool $timestamp = false;

    protected array $loaded = ["code", "name"];
    protected array $fillable = ['code', 'name'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique' => [['code', "room_types,code"]],
    ];

    public function getRoomTypes()
    {
        return db()->query("SELECT id, code, name FROM $this->table")->getAssoc();
    }

    public function getRoomType($id)
    {
        return db()->findOrFail('room_types', $id);
    }
}
