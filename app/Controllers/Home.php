<?php

namespace App\Controllers;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(): string
    {
        return view('welcome_message');
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
}
