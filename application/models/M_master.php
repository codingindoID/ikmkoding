<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

	function getall($table)
	{
		return $this->db->get($table);
	}	

	function input($table,$data)
	{
		$this->db->insert($table, $data);
	}

	function delete($table,$where)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	function update($table,$where,$data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function getWhere($table,$where)
	{
		return $this->db->get_where($table,$where);
	}	


	function get_responden()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('tb_hasil',['published' => '2'])->num_rows();
	}


}

/* End of file M_master.php */
/* Location: ./application/models/M_master.php */