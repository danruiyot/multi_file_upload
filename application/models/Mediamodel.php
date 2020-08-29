<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediamodel extends CI_Model {

	
public function store($params)
{
	return $this->db->insert('files', $params);
}
public function all($id = false)
{
	return $this->db->get('files')->result_array();
}
}

/* End of file Mediamodel.php */
/* Location: ./application/models/Mediamodel.php */