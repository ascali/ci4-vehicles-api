<?php namespace App\Modules\Kamera\Controllers;

use App\Modules\Kamera\Models\KameraModel;
use App\Core\BaseController;

class KameraAjax extends BaseController
{
    private $kameraModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->kameraModel = new KameraModel();
    }

    public function index()
    {
        return redirect()->to(base_url()); 
    }


    public function id_provinsi_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id , a.prov AS 'text'
                    FROM m_lokprov a
                    WHERE a.is_deleted = 0
        ";
        $where = ["a.prov"];
        $groupby = ["a.id"];
        $orderby = ["a.id"];
        parent::_loadSelect2($data, $query, $where, $orderby, $groupby);
    }

    public function id_kota_kab_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id , a.kabkota AS `text`
                    FROM m_lokabkota a
                    WHERE a.is_deleted = 0 AND a.idprov = " . $data['id_provinsi'];
        $where = ["a.kabkota", "a.kode", "a.ibukota", "a.group_nm"];

        parent::_loadSelect2($data, $query, $where);
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
