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
}
