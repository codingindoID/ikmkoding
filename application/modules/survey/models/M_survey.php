<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_survey extends CI_Model {

	function getSoal()
	{
		return $this->db->get('tb_pertanyaan');
	}

	function save_batch($data)
	{
		return $this->db->insert_batch('tb_hasil', $data);
	}

	function cekResponden($where)
	{
		return $this->db->get_where('tb_hasil', $where);
	}

	function save($table,$data)
	{
		$this->db->insert($table,$data);
	}

	function get_responden()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get('tb_hasil')->num_rows();
	}

	/*admin*/
	function auth($where)
	{
		return $this->db->get_where('admin', $where);
	}

}

/* End of file M_survey.php */
/* Location: ./application/modules/survey/models/M_survey.php */