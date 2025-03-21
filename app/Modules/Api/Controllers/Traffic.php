<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Api\Models\ApiModel;
use App\Core\BaseController;

class Traffic extends BaseController
{
    private $apiModel;
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->apiModel = new ApiModel();
    }

    public function index()
    {
        return redirect()->to(base_url());
    }

    public function graph_today()
    {
        return 'graph_today ';
    }

    public function add()
    {
        return 'add ';
    }

    public function list_all()
    {
        $data = $this->apiModel->getTraffic();
        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully",
            'data' => $data
        ]);
    }

    public function current()
    {
        $data = $this->apiModel->getCurrentTraffic();
        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully",
            'data' => $data
        ]);
    }

}