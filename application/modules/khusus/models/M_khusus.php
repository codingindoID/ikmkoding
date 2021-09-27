<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_khusus extends CI_Model {

	/*baru*/
	function getdetilresponden($id_responden)
	{
		$this->db->join('tb_loket', 'tb_loket.id_loket = tb_detil_responden_14.loket');
		return $this->db->get_where('tb_detil_responden_14', ['id_responden' => $id_responden])->row();
	}

	function get_rekap_hasil()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		$this->db->where('date(created_date)', date('2021-03-09'));
		$this->db->where('published', 2);
		return $this->db->get_where('tb_hasil_14');
	}

	function get_kuisioner($id_responden)
	{
		$pertanyaan =$this->db->get('tb_pertanyaan_14')->result();

		$no = 0;
		foreach ($pertanyaan as $p) {
			$hasil[$no++] = [
				'pertanyaan'	=> $p->soal,
				'jawaban'		=> $this->_get_jawaban($p->id_soal,$id_responden)
			];
		}

		return $hasil;
	}

	function _get_jawaban($id_soal,$id_responden)
	{
		$where = [
			'id_responden'		=> $id_responden,
			'tb_hasil_14.id_soal'			=> $id_soal
		];

		$this->db->join('tb_pertanyaan_14', 'tb_pertanyaan_14.id_soal = tb_hasil_14.id_soal');
		$data = $this->db->get_where('tb_hasil_14', $where)->row();

		if ($data) {
			$kolom = $data->jawaban;
			return $data->$kolom;
		}
		return null;
	}

	function get_tanggal_responden($id_responden)
	{
		$data = $this->db->get_where('tb_hasil_14',['id_responden' => $id_responden])->row();

		return $data->created_date;
	}	


	function getdetil($id_responden)
	{
		$this->db->join('tb_pertanyaan_14', 'tb_pertanyaan_14.id_soal = tb_hasil_14.id_soal');
		$this->db->where('id_responden', $id_responden);
		return $this->db->get('tb_hasil_14')->result();
	}

}

/* End of file M_khusus.php */
/* Location: ./application/modules/khusus/models/M_khusus.php */