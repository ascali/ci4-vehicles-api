<?php

namespace App\Modules\Administrator\Controllers;

use App\Modules\Administrator\Models\AdministratorModel;
use App\Core\BaseController;

class Administrator extends BaseController
{
    private $administratorModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->administratorModel = new AdministratorModel();
    }

    public function index()
    {
        return redirect()->to(base_url());
    }

    public function manmodul()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Modul | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Manajemen Modul']),
            'load_view' => 'App\Modules\Administrator\Views\manmodul',
        ];
        return parent::_authView($data);
    }

    public function manmenu()
    {

        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Menu | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Manajemen Menu']),
            'modules' => $this->administratorModel->getModules(),
            'load_view' => 'App\Modules\Administrator\Views\manmenu',
        ];
        //$data['modules'] = ;
        return parent::_authView($data);
    }

    public function manjenisuser()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Jenis User | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Jenis User']),
            'modules' => $this->administratorModel->getModules(),
            'load_view' => 'App\Modules\Administrator\Views\manjenisuser',
        ];
        return parent::_authView($data);
    }

    public function manhakakses()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Hak Akses | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Hak Akses']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\manhakakses',
        ];

        return parent::_authView($data);
    }

    public function manuser()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen User | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Manajemen User']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'role_code' => $this->session->get('role_code'),
            'load_view' => 'App\Modules\Administrator\Views\manuser',
        ];


        return parent::_authView($data);
    }

    public function manprov()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Master Provinsi | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Manajemen Wilayah', 'li_2' => 'Master Provinsi']),
            'load_view' => 'App\Modules\Administrator\Views\manprov',
            'role_code' => $this->session->get('role_code'),
        ];
        return parent::_authView($data);
    }

    public function mankabkota()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Master Kabupaten/Kota | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Manajemen Wilayah', 'li_2' => 'Master Kabupaten/Kota']),
            'load_view' => 'App\Modules\Administrator\Views\mankabkota',
            'role_code' => $this->session->get('role_code'),
        ];
        return parent::_authView($data);
    }

    public function mankec()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Master Kecamatan | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Manajemen Wilayah', 'li_2' => 'Master Kecamatan']),
            'load_view' => 'App\Modules\Administrator\Views\mankec',
            'role_code' => $this->session->get('role_code'),
        ];
        return parent::_authView($data);
    }

    public function mankel()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Master Kelurahan | ' . getenv('prop.appname')]),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Manajemen Wilayah', 'li_2' => 'Master Kelurahan']),
            'load_view' => 'App\Modules\Administrator\Views\mankel',
            'role_code' => $this->session->get('role_code'),
        ];
        return parent::_authView($data);
    }
}
