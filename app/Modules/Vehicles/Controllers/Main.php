<?php namespace App\Modules\Vehicles\Controllers;

use CodeIgniter\Controller;
use App\Core\BaseController;
use App\Modules\Vehicles\Models\MainModel;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(): ResponseInterface
    {
        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Welcome to API",
            'data' => []
        ]);
    }

    public function home(): ResponseInterface
    {
        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Welcome to API",
            'data' => []
        ]);
    }

    public function bus(): ResponseInterface
    {
        $limit = $this->request->getVar('limit') ?? 10;
        $page = $this->request->getVar('page') ?? 1;
        $offset = ($page - 1) * $limit;
        $sort = $this->request->getVar('sort') ?? 'ASC';

        $id = $this->request->getVar('id');
        $gps_sn = $this->request->getVar('gps_sn');
        $nomor_kendaraan = $this->request->getVar('nomor_kendaraan');
        $route_type = $this->request->getVar('route_type') ?? 'AKAP';

        if ($id) {
            $whereClause = "id = ?";
            $whereValue = $id;
        } elseif ($gps_sn) {
            $whereClause = "gps_sn = ?";
            $whereValue = $gps_sn;
        } elseif ($nomor_kendaraan) {
            $whereClause = "nomor_kendaraan = ?";
            $whereValue = $nomor_kendaraan;
        } else {
            $whereClause = "route_type = ?";
            $whereValue = $route_type;
        }

        $data = $this->db->query("SELECT `id`, `gps_sn`, `route_type`, `nomor_kendaraan`, `nomor_kendaraan_clean`, `name_sender`, `name_client`, 
            `region`, `route`, `date_tracker`, `date_tracker_original`, `date_tracker_timestamp`, `timezone`, `acc`, `speed`, 
            `latitude`, `longitude`, `altitude`, `angle`, `odometer`, `address`, `battery_level`, `signal`, `gps_valid`, `created_at`, `updated_at`
            FROM vehicles WHERE $whereClause AND route_type = ? 
            ORDER BY id $sort LIMIT ? OFFSET ?", 
            [$whereValue, $route_type, $limit, $offset])->getResult();

        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully fetched bus data",
            'data' => $data
        ]);
    }

    public function log_bus(): ResponseInterface
    {
        $limit = $this->request->getVar('limit') ?? 10;
        $page = $this->request->getVar('page') ?? 1;
        $offset = ($page - 1) * $limit;
        $sort = $this->request->getVar('sort') ?? 'ASC';

        $id = $this->request->getVar('id');
        $gps_sn = $this->request->getVar('gps_sn');
        $nomor_kendaraan = $this->request->getVar('nomor_kendaraan');
        $route_type = $this->request->getVar('route_type') ?? 'AKAP';

        if ($id) {
            $whereClause = "id = ?";
            $whereValue = $id;
        } elseif ($gps_sn) {
            $whereClause = "gps_sn = ?";
            $whereValue = $gps_sn;
        } elseif ($nomor_kendaraan) {
            $whereClause = "nomor_kendaraan = ?";
            $whereValue = $nomor_kendaraan;
        } else {
            return $this->response->setJSON([
            'status_code' => 400,
            'error' => true,
            'message' => "Harap isi id, gps_sn, atau nomor_kendaraan",
            'data' => []
            ]);
        }

        $data = $this->db->query("SELECT `id`, `gps_sn`, `route_type`, `nomor_kendaraan`, `nomor_kendaraan_clean`, `name_sender`, `name_client`, 
            `region`, `route`, `date_tracker`, `date_tracker_original`, `date_tracker_timestamp`, `timezone`, `acc`, `speed`, 
            `latitude`, `longitude`, `altitude`, `angle`, `odometer`, `address`, `battery_level`, `signal`, `gps_valid`, `created_at`, `updated_at`
            FROM vehicle_logs WHERE $whereClause AND route_type = ? 
            ORDER BY id $sort LIMIT ? OFFSET ?", 
            [$whereValue, $route_type, $limit, $offset])->getResult();

        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully fetched log bus data",
            'data' => $data
        ]);
    }
}
