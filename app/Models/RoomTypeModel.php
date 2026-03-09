<?

namespace App\Models;

class RoomTypeModel extends BaseModel
{
    protected string $table = 'room_types';
    public bool $timestamp = true;

    protected array $loaded = ['code', 'name'];
    protected array $fillable = ['code', 'name'];

    public array $rules = [
        'required' => ['name', 'code'],
        'unique'   => [['code', 'room_types,code']],
    ];

    public function getRoomTypes(): array
    {
        return $this->getAllRecords();
    }

    public function getRoomType(int|string $id): array
    {
        return $this->getRecordById($id);
    }
}
