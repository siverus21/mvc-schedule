<?

namespace App\Models;

use Youpi\Model;

class AuditoryModel extends Model
{
    protected string $table = 'rooms';

    public bool $timestamp = false;

    protected array $loaded = ["building_id", "code", "capacity", "floor", "name", "room_type_id", "notes"];
    protected array $fillable = ["building_id", "code", "capacity", "floor", "name", "room_type_id", "notes"];

    public array $rules = [
        'required' => [
            ['name'],
            ['code']
        ],
        'integer' => [
            ['capacity'],
            ['floor'],
            ['building_id'],
            ['room_type_id']
        ],
        'min' => [
            ['capacity', 0],
            ['floor', -1]
        ],
        'lengthMax' => [
            ['notes', 255]
        ],
        'unique' => [
            ['code', "rooms,code"]
        ],
    ];

    public function getAuditories()
    {
        return db()->query("SELECT * FROM $this->table")->get();
    }

    public function getAuditory($id)
    {
        return db()->findOrFail('rooms', $id);
    }
}
