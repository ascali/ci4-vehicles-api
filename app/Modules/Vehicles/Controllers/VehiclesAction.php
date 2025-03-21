<?php namespace App\Modules\Vehicles\Controllers;

use App\Modules\Vehicles\Models\VehicleModel;
use App\Core\BaseController;

class VehiclesAction extends BaseController
{
    private $VehicleModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->vehicleModel = new VehicleModel();
    }

    public function index()
    {
        return redirect()->to(base_url()); 
    }

    public function manajemen_kendaraan_load()
    {
        parent::_authLoad(function () {
            $query = "SELECT a.* from vehicles a where a.is_deleted = 0";
            $where = ['a.id', 'a.name_client'];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    public function manajemen_kendaraan_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            $data['created_at'] = date('Y-m-d H:i:s');
            parent::_insert('vehicles', $data);
        });
        
    }

    public function manajemen_kendaraan_edit()
    {
        parent::_authEdit(function () {
            parent::_edit('vehicles', $this->request->getPost());
        });
    }

    public function manajemen_kendaraan_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('vehicles', $this->request->getPost());
        });
    }
}
