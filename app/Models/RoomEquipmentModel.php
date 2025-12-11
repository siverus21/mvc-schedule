<?

namespace App\Models;

use Youpi\Model;
use App\Models\AuditoryModel;
use App\Models\EquipmentTypeModel;

class RoomEquipmentModel extends Model
{
    protected string $table = 'room_equipments';

    public bool $timestamp = false;

    protected array $loaded = ["room_id", "equipment_type_id", "quantity", "notes"];
    protected array $fillable = ["room_id", "equipment_type_id", "quantity", "notes"];

    public array $rules = [
        'required' => ['room_id', 'equipment_type_id'],
        'unique_pair' => [['room_id', "room_equipments,room_id,equipment_type_id"]],
    ];

    public function getAllRooms()
    {
        $auditoryModel = new AuditoryModel();
        return $auditoryModel->getAuditories();
    }

    public function getAllEquipmentTypes()
    {
        $equipmentTypeModel = new EquipmentTypeModel();
        return $equipmentTypeModel->getEquipmentTypes();
    }

    public function getRoomWithEquipmentName()
    {
        $data = db()->query("
        SELECT 
            re.id,
            re.room_id,
            re.equipment_type_id,

            et.code       AS equipment_type_code,
            et.name       AS equipment_type_name

            FROM room_equipments AS re
            JOIN equipment_types AS et
            ON re.equipment_type_id = et.id
        ")->get();

        $res = [];
        foreach ($data as $item) {
            $res[$item['room_id']][$item['equipment_type_id']] = $item['equipment_type_name'];
        }

        return $res;
    }

    public function getCurrentRoomEquipment($id)
    {
        return db()->findOrFail('room_equipments', $id);
    }

    public function getAllData()
    {
        return db()->query("
        SELECT
            re.id,
            re.room_id,
            re.equipment_type_id,
            re.quantity,
            re.notes,

            r.id          AS room_id_pk,
            r.code        AS room_code,
            r.name        AS room_name,

            et.code       AS equipment_type_code,
            et.name       AS equipment_type_name
        FROM room_equipments AS re
        JOIN rooms AS r
        ON re.room_id = r.id
        JOIN equipment_types AS et
        ON re.equipment_type_id = et.id;

        ")->get();
    }
}
