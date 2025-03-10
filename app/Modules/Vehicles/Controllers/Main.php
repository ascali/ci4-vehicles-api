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

    public function log_data_hooks(): ResponseInterface
    {
        $limit = $this->request->getGet('limit') ?? 10;
        $page = $this->request->getGet('page') ?? 1;
        $offset = ($page - 1) * $limit;
        $sort = $this->request->getGet('sort') ?? 'ASC';

        $id = $this->request->getGet('id');
        $data = $this->request->getGet('data');

        if ($id) {
            $whereClause = "id = ?";
            $whereValue = $id;
        } elseif ($data) {
            $whereClause = "data LIKE ?";
            $whereValue = '%' . $data . '%';
        } else {
            $whereClause = '1 = ?';
            $whereValue = '1';
        }

        $data = $this->db->query("SELECT `id`, `data`
            FROM data_hooks WHERE $whereClause 
            ORDER BY id $sort LIMIT ? OFFSET ?", 
            [$whereValue, $limit, $offset])->getResult();

        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully fetched data hooks",
            'data' => $data
        ]);
    }

    public function webhook_data() {
        $postData = $this->request->getJSON(true);
        $data = [
            'data' => json_encode($postData)
        ];

        $this->db->transStart();
        try {
            // Set a shorter timeout for the transaction
            $this->db->query('SET SESSION wait_timeout = 5');
            $this->db->query('SET SESSION interactive_timeout = 5');

            $this->db->table('data_hooks')->insert($data);
            $insertId = $this->db->insertID();
            $data = json_decode($data['data'], true);
            $data['predata'] = $data;
            $data['id'] = $insertId;

            $this->db->transComplete();
            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $this->response->setJSON([
                'status_code' => 500,
                'error' => true,
                'message' => "Internal Server Error: " . $e->getMessage()
            ], 500);
        }
    }

    public function hit_webhook() {

        $newDate = date('Y-m-d H:i:s');
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://host.docker.internal:5005/ingest/3cY0rqGcuNHeTklU',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "gps_sn": "SN123456",
                "route_type": "AKAP",
                "nomor_kendaraan": "B1234XYZ",
                "nomor_kendaraan_clean": "B1234XYZ",
                "name_sender": "Sender1",
                "name_client": "Client1",
                "region": "Region1",
                "route": "Route1",
                "date_tracker": "'.$newDate.'",
                "date_tracker_original": "'.$newDate.'",
                "date_tracker_timestamp": "'.$newDate.'",
                "timezone": "UTC+7",
                "acc": true,
                "speed": 60.5,
                "latitude": -6.2,
                "longitude": 106.816666,
                "altitude": 50.0,
                "angle": 90.0,
                "odometer": 1200.5,
                "address": "Address1",
                "battery_level": 75.0,
                "signal": 4,
                "gps_valid": true
            }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            return $this->response->setJSON([
                'status_code' => 500,
                'error' => true,
                'message' => "cURL Error: " . $error
            ], 500);
        }

        curl_close($curl);

        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully",
            'data' => json_decode($response, true)
        ]);
    }
}
