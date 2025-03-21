<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Api\Models\ApiModel;
use App\Core\BaseController;

class PublicFacility extends BaseController
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

    public function test()
    {
        return 'test ';
    }

    public function list()
    {
        $data = $this->apiModel->getPublicFacilities();
        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully",
            'data' => $data
        ]);
    }

}