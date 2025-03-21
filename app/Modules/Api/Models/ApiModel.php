<?php

namespace App\Modules\Api\Models;

use App\Core\BaseModel;

class ApiModel extends BaseModel {

    public function getStreet()
	{
		return $this->db->query('SELECT a.*, c.name as work_unit_level_nama, d.name as work_unit_nama
                FROM streets a 
                JOIN work_unit_levels c on a.work_unit_level_id = c.id
                JOIN work_units d on a.work_unit_id = d.id
                where a.is_deleted = 0')->getResult();
	}

    public function getTraffic()
	{
		return $this->db->query('SELECT a.* FROM traffic a 
                where a.is_deleted = 0')->getResult();
	}

    public function getCurrentTraffic()
	{
		return $this->db->query('SELECT a.* FROM traffic a 
                where a.is_deleted = 0')->getResult();
	}

    public function getEwsGeojson()
	{
		return $this->db->query('SELECT a.geojson FROM ews a 
                where a.is_deleted = 0')->getResult();
	}

    public function getPublicFacilities()
	{
		return $this->db->query('SELECT a.*, b.name as facility_type_nama, c.name as work_unit_level_nama, d.name as work_unit_nama
            FROM public_facilities a 
            JOIN facility_types b on a.facility_type_id = b.id
            JOIN work_unit_levels c on a.work_unit_level_id = c.id
            JOIN work_units d on a.work_unit_id = d.id
            where a.is_deleted = 0')->getResult();
	}
}
