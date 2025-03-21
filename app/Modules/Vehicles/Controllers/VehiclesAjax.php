<?php namespace App\Modules\Vehicles\Controllers;

use App\Modules\Vehicles\Models\VehiclesModel;
use App\Core\BaseController;

class VehiclesAjax extends BaseController
{
    private $vehicleModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->vehicleModel = new VehiclesModel();
    }

    public function index()
    {
        return redirect()->to(base_url()); 
    }

    public function total_camera() {
        $data =[];
        $camera = $this->db->query("SELECT COUNT(*) as total FROM cameras WHERE is_deleted = 0")->getRow();
        $data['status_code'] = 200;
        $data['status'] = true;
        $data['message'] = "Success";
        $data['data'] = $camera;
        $this->response->setHeader('Content-Type', 'application/json');
        return $this->response->setJSON($data);
    }

    public function total_camera_terkoneksi() {
        $data =[];
        $camera = $this->db->query("SELECT COUNT(*) as total_connect FROM cameras WHERE active = 1 AND is_deleted = 0")->getRow();
        $data['status_code'] = 200;
        $data['status'] = true;
        $data['message'] = "Success";
        $data['data'] = $camera;
        $this->response->setHeader('Content-Type', 'application/json');
		return $this->response->setJSON($data);
    }

    public function total_camera_tidak_terkoneksi() {
        $data =[];
        $camera = $this->db->query("SELECT COUNT(*) as total_not_connect FROM cameras WHERE active != 1 AND is_deleted = 0")->getRow();
        $data['status_code'] = 200;
        $data['status'] = true;
        $data['message'] = "Success";
        $data['data'] = $camera;
        $this->response->setHeader('Content-Type', 'application/json');
		return $this->response->setJSON($data);
    }
}
