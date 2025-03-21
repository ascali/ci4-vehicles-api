<?php namespace App\Modules\Vehicles\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
    protected $table      = "";
    protected $primaryKey = "";

    protected $returnType     = array();
    protected $useSoftDeletes = true;

    protected $allowedFields = [];

    protected $useTimestamps = false;
    protected $createdField  = "created_at";
    protected $updatedField  = "updated_at";
    protected $deletedField  ="deleted_at";

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}