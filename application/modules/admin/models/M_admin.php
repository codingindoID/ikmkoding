<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	function getSoal()
	{
		return $this->db->get('tb_pertanyaan');
	}

}

/* End of file M_admin.php */
/* Location: ./application/modules/admin/models/M_admin.php */