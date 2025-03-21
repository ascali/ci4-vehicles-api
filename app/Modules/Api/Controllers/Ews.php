<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Api\Models\ApiModel;
use App\Core\BaseController;

class Ews extends BaseController
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

    public function list_geojson()
    {
        $data = $this->apiModel->getEwsGeojson();


        $geoJson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($data as $key => $value) {
            $geoJson['features'][] = json_decode($value->geojson, true);
        }

        return $this->response->setJSON([
            'status_code' => 200,
            'error' => false,
            'message' => "Successfully",
            'data' => $geoJson
        ]);
    }

}