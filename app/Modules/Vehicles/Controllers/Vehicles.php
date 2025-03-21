<?php namespace App\Modules\Vehicles\Controllers;

use CodeIgniter\Controller;
use App\Core\BaseController;
use App\Modules\Vehicles\Models\VehicleModel;
use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client;

class Vehicles extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return redirect()->to(base_url());
    }

    public function manajemen_kendaraan(): String
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Stream | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Kendaraan', 'li_2' => 'Manajemen Kendaraan ']),
            'load_view' => 'App\Modules\Vehicles\Views\manajemen_kendaraan',
            'role_code' => $this->session->get('role_code'),
        ];
        // return view($data['load_view'], $data);
        return parent::_authView($data);
    }

    public function home(): ResponseInterface
    {
        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Welcome to bus AKAP REST API",
            'data' => []
        ]);
    }

    public function bus(): ResponseInterface
    {
        $limit = $this->request->getVar('limit') ?? 10;
        $page = $this->request->getVar('page') ?? 1;
        $offset = ($page - 1) * $limit;
        $sort = $this->request->getVar('sort') ?? 'ASC';

        $data = $this->db->query("SELECT `id`, `gps_sn`, `route_type`, `nomor_kendaraan`, `nomor_kendaraan_clean`, `name_sender`, `name_client`, 
            `region`, `route`, `date_tracker`, `date_tracker_original`, `date_tracker_timestamp`, `timezone`, `acc`, `speed`, 
            `latitude`, `longitude`, `altitude`, `angle`, `odometer`, `address`, `battery_level`, `signal`, `gps_valid`, `created_at`, `updated_at`
            FROM vehicles WHERE route_type = ? 
            ORDER BY id $sort LIMIT ? OFFSET ?", 
            ['AKAP', $limit, $offset])->getResult();

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
            [$whereValue, 'AKAP', $limit, $offset])->getResult();

        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully fetched log bus data",
            'data' => $data
        ]);
    }


    public function lacak(): string
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Stream | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Kendaraan', 'li_2' => 'Manajemen Kendaraan ']),
            'load_view' => 'App\Modules\Vehicles\Views\lacak_kendaraan',
            'role_code' => $this->session->get('role_code'),
        ];
        return view($data['load_view'], $data);
        // return parent::_authView($data);
    }

    public function polyline(): ResponseInterface
    {
        $query = $this->request->getGet('query');
        
        $client = new Client();
        $response = $client->get(
            'https://routing.openstreetmap.de/routed-bike/route/v1/driving/112.72079074999999,-7.1704675;112.73813557744137,-7.302871834544816?overview=false&alternatives=true&steps=true',
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'User-Agent' => 'Thishub/1.0'
                ]
            ]
        );
    
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'status_code' => 200,
                'error' => false,
                'message' => "Successfully",
                'data' => $data
            ]);
        } elseif ($response->getStatusCode() == 403) {
            return $this->response->setJSON([
                'status_code' => 403,
                'error' => true,
                'message' => "Forbidden: The request is forbidden. Please check the query parameters and API usage."
            ], 403);
        } else {
            return $this->response->setJSON([
                'status_code' => 500,
                'error' => true,
                'message' => "Internal Server Error"
            ], 500);
        }
    }

}
