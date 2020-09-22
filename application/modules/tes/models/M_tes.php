<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tes extends CI_Model {

	function getSoal()
	{
		return $this->db->get('tb_pertanyaan');
	}

	public function save_batch($data)
	{
		return $this->db->insert_batch('tb_hasil', $data);
	}

	public function cekResponden($where)
	{
		return $this->db->get_where('tb_hasil', $where);
	}	

	function get_soalpagination($limit, $start){
		return $this->db->get('tb_pertanyaan', $limit, $start);
	}

}

/* End of file M_tes.php */
/* Location: ./application/modules/tes/models/M_tes.php */