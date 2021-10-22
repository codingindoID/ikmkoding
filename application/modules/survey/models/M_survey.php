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

	function update($table,$where,$data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function get_responden()
	{
		$this->db->where('published', '2');
		$this->db->group_by('id_responden');
		return $this->db->get_where('tb_hasil')->num_rows();
	}

	function get_responden_1()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('tb_hasil',['published' => '1']);
	}

	function join_get_responden_2($kolom,$param)
	{
		return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM tb_hasil where published = 2) as a  , tb_detil_responden  b where  a = b.id_responden and b.'.$kolom.' = "'.$param.'"');
	}

	function post_detil_responden()
	{
		$id_detil = uniqid(12);
		$data = [
			'id'			=> $id_detil,
			'id_responden'	=> $this->input->post('id_responden'),
			'nama'			=> $this->input->post('nama'),
			'umur'			=> $this->input->post('umur'),
			'jk'			=> $this->input->post('jk'),
			'pekerjaan'		=> $this->input->post('pekerjaan'),
			'pendidikan'	=> $this->input->post('pendidikan'),
			'loket'			=> $this->input->post('loket')
		];
		$cek = $this->db->insert('tb_detil_responden', $data);
		if ($cek) {
			$res = [
				'kode'			=> 'success',
				'id_responden'	=>  $this->input->post('id_responden'),
				'id_detil'		=> $id_detil
			];
		}
		else
		{
			$res = [
				'kode'			=> 'error',
				'id_responden'	=>  ''
			];
		}
		return $res;
	}


	/*admin*/
	function auth($where)
	{
		return $this->db->get_where('admin', $where);
	}

}

/* End of file M_survey.php */
/* Location: ./application/modules/survey/models/M_survey.php */