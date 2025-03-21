<?php
 namespace App\Modules\Kamera\Controllers;

use App\Core\BaseController;

class Kamera extends BaseController
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

    public function manajemen_kamera(): String
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Kamera | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Kamera', 'li_2' => 'Manajemen Kamera ']),
            'load_view' => 'App\Modules\Kamera\Views\manajemen_kamera',
            'role_code' => $this->session->get('role_code'),
        ];
        // return view($data['load_view'], $data);
        return parent::_authView($data);
    }
}
