<?php namespace App\Modules\Main\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends Controller
{
    public function index(): ResponseInterface
    {
        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Welcome to bus AKAP REST API",
            'data' => []
        ]);
    }
}
