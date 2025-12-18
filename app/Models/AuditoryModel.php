<?

namespace App\Models;

use Youpi\Model;

class AuditoryModel extends Model
{
    protected string $table = 'rooms';

    public bool $timestamp = true;

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

    public function getAuditoriesWithBuilding()
    {
        return db()->query("
        SELECT
            r.id,
            r.building_id,
            r.name,
            b.name AS building_name
        FROM rooms r
        LEFT JOIN buildings b
            ON r.building_id = b.id
        ")->get();
    }

    public function getAuditory($id)
    {
        return db()->findOrFail('rooms', $id);
    }

    public function countAuditories()
    {
        return db()->count('rooms');
    }

    public function getListData()
    {
        $data = db()->query("
        SELECT
            r.id                      AS room_id,
            r.building_id,
            r.name                    AS room_name,
            r.room_type_id,
            r.capacity,
            b.name                    AS building_name,
            rt.code                   AS room_type_code,
            rt.name                   AS room_type_name,
            re.equipment_type_id,
            et.name                   AS equipment_type_name
        FROM rooms r
        LEFT JOIN buildings b
            ON r.building_id = b.id
        LEFT JOIN room_types rt
            ON r.room_type_id = rt.id
        LEFT JOIN room_equipments re
            ON r.id = re.room_id
        LEFT JOIN equipment_types et
            ON re.equipment_type_id = et.id;
        ")->get();

        $rooms = [];

        foreach ($data as $v) {
            $id = $v['room_id'];

            if (!isset($rooms[$id])) {
                $rooms[$id] = [
                    'room_id' => $v['room_id'],
                    'building_id' => $v['building_id'],
                    'room_name' => $v['room_name'],
                    'room_type_id' => $v['room_type_id'],
                    'capacity' => $v['capacity'],
                    'building_name' => $v['building_name'],
                    'room_type_code' => $v['room_type_code'],
                    'room_type_name' => $v['room_type_name'],
                    'equipment_types' => [],
                ];
            }

            if (!empty($v['equipment_type_id']) && !empty($v['equipment_type_name'])) {
                $rooms[$id]['equipment_types'][$v['equipment_type_id']] = $v['equipment_type_name'];
            }
        }

        foreach ($rooms as &$room) {
            $room['equipment_types'] = array_values($room['equipment_types']); // индексный массив имён
            $room['equipment_types_str'] = count($room['equipment_types']) ? implode(', ', $room['equipment_types']) : null;
        }
        unset($room);

        return array_values($rooms);
    }
}
