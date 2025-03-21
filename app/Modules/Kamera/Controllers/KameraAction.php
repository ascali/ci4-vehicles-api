<?php namespace App\Modules\Kamera\Controllers;

use App\Modules\Kamera\Models\KameraModel;
use App\Core\BaseController;

class KameraAction extends BaseController
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

    public function manajemen_kamera_load()
    {
        parent::_authLoad(function () {
            $query = "SELECT a.*, b.prov as provinsi_name, c.kabkota as kota_kabupaten_name from cameras a 
            JOIN m_lokprov b ON a.id_provinsi = b.id
            JOIN m_lokabkota c ON a.id_kota_kab = c.id
            where a.is_deleted = 0";
            $where = ['a.id', 'a.name_client'];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    public function manajemen_kamera_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            $data['created_at'] = date('Y-m-d H:i:s');
            parent::_insert('cameras', $data);
        });
    }

    public function manajemen_kamera_edit()
    {
        parent::_authEdit(function () {
            parent::_edit('cameras', $this->request->getPost());
        });
    }

    public function manajemen_kamera_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('cameras', $this->request->getPost());
        });
    }
}
