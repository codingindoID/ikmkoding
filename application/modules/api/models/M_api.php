<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends CI_Model {

	function indexKepuasan()
	{
		$nilai = 0;

		$total 				= $this->db->get('tb_hasil')->num_rows();
		$soal 				= $this->db->get('tb_pertanyaan')->num_rows();
		$total_responden 	= $this->get_responden();
		
		$a 		= $this->db->get_where('tb_hasil', ['published' => '2','jawaban' => 'a'])->num_rows();
		$b 		= $this->db->get_where('tb_hasil', ['published' => '2','jawaban' => 'b'])->num_rows();
		$c 		= $this->db->get_where('tb_hasil', ['published' => '2','jawaban' => 'c'])->num_rows();
		$d 		= $this->db->get_where('tb_hasil', ['published' => '2','jawaban' => 'd'])->num_rows();

		if ($total_responden != 0) {
			$kepuasan 	= (($d*4)+($c*3)+($b*2)+($a*1))/($total_responden*4*$soal);
			$nilai 		=  number_format(($kepuasan*100),2);
		}
		return $nilai;
	}

	function get_responden()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('tb_hasil',['published' => '2'])->num_rows();
	}
}

/* End of file M_api.php */
/* Location: ./application/modules/api/models/M_api.php */