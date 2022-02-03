<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_loket extends CI_Model
{
	function get_nilai_loket($id, $bulan, $tahun)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(tb_hasil.created_date) BETWEEN "01" and "' . date('m') . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		} else {
			$query = 'MONTH(tb_hasil.created_date) = "' . $bulan . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		}

		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->join('tb_loket', 'tb_detil_responden.loket = tb_loket.id_loket');
		$this->db->where('tb_loket.id_loket', $id);
		$this->db->where($query);
		$this->db->where('tb_hasil.published', '2');
		return $this->db->get('tb_hasil');
	}

	function get_responden_by_loket($id, $bulan, $tahun)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(tb_hasil.created_date) BETWEEN "01" and "' . date('m') . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		} else {
			$query = 'MONTH(tb_hasil.created_date) = "' . $bulan . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		}

		$this->db->distinct();
		$this->db->select('tb_hasil.id_responden');
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->join('tb_loket', 'tb_detil_responden.loket = tb_loket.id_loket');
		$this->db->where('tb_loket.id_loket', $id);
		$this->db->where($query);
		$this->db->where('tb_hasil.published', '2');
		return $this->db->get('tb_hasil');
	}

	function get_pilihan($id, $bulan, $tahun, $pilihan)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(tb_hasil.created_date) BETWEEN "01" and "' . date('m') . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		} else {
			$query = 'MONTH(tb_hasil.created_date) = "' . $bulan . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		}

		$this->db->join('tb_detil_responden', 'tb_loket.id_loket = tb_detil_responden.loket');
		$this->db->join('tb_hasil', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->where('tb_hasil.jawaban', $pilihan);
		$this->db->where('tb_hasil.id_soal', $id);
		$this->db->where($query);
		$this->db->order_by('tb_hasil.created_date', 'desc');
		$this->db->group_by('tb_loket.id_loket');
		return $this->db->get('tb_loket');
	}

	function get_hasil_pilihan($id, $bulan, $tahun, $pilihan, $loket)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(tb_hasil.created_date) BETWEEN "01" and "' . date('m') . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		} else {
			$query = 'MONTH(tb_hasil.created_date) = "' . $bulan . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		}

		$this->db->join('tb_detil_responden', 'tb_loket.id_loket = tb_detil_responden.loket');
		$this->db->join('tb_hasil', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->where('tb_hasil.id_soal', $id);
		$this->db->where('tb_hasil.jawaban', $pilihan);
		$this->db->where('tb_loket.id_loket', $loket);
		$this->db->where($query);
		$this->db->order_by('tb_hasil.created_date', 'desc');
		return $this->db->get('tb_loket');
	}

	function detil_loket($data, $tahun, $bulan)
	{
		$hasil 	= [];
		$no 	= 1;
		if ($data) {
			foreach ($data as $dat) {
				$hasil[$no++] = [
					'id_loket'				=> $dat->id_loket,
					'jenis_layanan'			=> $dat->nama_loket,
					'jumlah_responden'		=> $this->_jumlahResponden($dat->id_loket, $tahun, $bulan),
					'persen'				=> $this->_persen($dat->id_loket, $tahun, $bulan),
					'kepuasan'				=> $this->_getKepuasan($dat->id_loket, $tahun, $bulan),
				];
			}
		}
		return $hasil;
	}

	function responden($data, $tahun, $bulan)
	{
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(tb_hasil.created_date)', $bulan);
		}
		$this->db->where('YEAR(tb_hasil.created_date)', $tahun);
		$this->db->where('published', '2');
		$this->db->join('tb_hasil', 'tb_hasil.id_responden = tb_detil_responden.id_responden');
		$this->db->group_by('tb_hasil.id_responden');
		return $this->db->get('tb_detil_responden')->num_rows();
	}

	function _jumlahResponden($id_loket, $tahun, $bulan)
	{
		$this->db->where('loket', $id_loket);
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(tb_hasil.created_date)', $bulan);
		}
		$this->db->where('YEAR(tb_hasil.created_date)', $tahun);
		$this->db->where('published', '2');
		$this->db->join('tb_hasil', 'tb_hasil.id_responden = tb_detil_responden.id_responden');
		$this->db->group_by('tb_hasil.id_responden');
		return $this->db->get('tb_detil_responden')->num_rows();
	}

	function _persen($id_loket, $tahun, $bulan)
	{
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(tb_hasil.created_date)', $bulan);
		}
		$this->db->where('YEAR(tb_hasil.created_date)', $tahun);
		$this->db->where('published', '2');
		$this->db->join('tb_hasil', 'tb_hasil.id_responden = tb_detil_responden.id_responden');
		$this->db->group_by('tb_hasil.id_responden');
		$total =  $this->db->get('tb_detil_responden')->num_rows();

		$this->db->where('loket', $id_loket);
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(tb_hasil.created_date)', $bulan);
		}
		$this->db->where('YEAR(tb_hasil.created_date)', $tahun);
		$this->db->where('published', '2');
		$this->db->join('tb_hasil', 'tb_hasil.id_responden = tb_detil_responden.id_responden');
		$this->db->group_by('tb_hasil.id_responden');
		$total_perloket =  $this->db->get('tb_detil_responden')->num_rows();

		if ($total != null) {
			return ($total_perloket / $total) * 100;
		}
		return 0;
	}

	function _getKepuasan($id_loket, $tahun, $bulan)
	{
		$nilai = 0;
		$hasil = [];
		$no = 1;
		$this->db->join('tb_detil_responden', 'tb_hasil.id_responden = tb_detil_responden.id_responden');
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(tb_hasil.created_date)', $bulan);
		}
		$this->db->where('published', '2');
		$this->db->where('YEAR(tb_hasil.created_date)', $tahun);
		$this->db->where('loket', $id_loket);
		$data =  $this->db->get('tb_hasil');

		$a = $this->_nilai($data->result(), 'a');
		$b = $this->_nilai($data->result(), 'b');
		$c = $this->_nilai($data->result(), 'c');
		$d = $this->_nilai($data->result(), 'd');

		if ($data->num_rows() != 0) {
			$nilai = (($a * 1) + ($b * 2) + ($c * 3) + ($d * 4)) / ($data->num_rows() * 4);
		}
		return $nilai * 100;
	}

	function _nilai($data, $pilihan)
	{
		$no = 1;
		$total = 0;
		$has = [];
		foreach ($data as $j) {
			if ($j->jawaban == $pilihan) {
				$has[$no++]	= [
					'jumlah'	=> $j->jawaban
				];
			}
		}
		return count($has);
	}

	//loket lainnya
	function loket_lainnya($tahun, $bulan)
	{
		$this->db->select('id_responden');
		$this->db->group_by('id_responden');
		$loket =  $this->db->get('tb_hasil')->result();
		$loket = array_column($loket, 'id_responden');
		// $loket =  implode(",", $loket);

		// return $loket = $this->db->get('tb_hasil');
		// return $this->get_nilai_loket_lainnya($loket, $tahun, $bulan);
		return $loket;
	}

	function get_nilai_loket_lainnya($loket, $tahun, $bulan)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(tb_hasil.created_date) BETWEEN "01" and "' . date('m') . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		} else {
			$query = 'MONTH(tb_hasil.created_date) = "' . $bulan . '" and YEAR(tb_hasil.created_date) = "' . $tahun . '"';
		}

		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->join('tb_loket', 'tb_detil_responden.loket = tb_loket.id_loket');
		$this->db->where_not_in('tb_loket.id_loket', $loket);
		$this->db->where($query);
		$this->db->where('tb_hasil.published', '2');
		return $this->db->get('tb_hasil')->result();
	}
}

/* End of file M_loket.php */
/* Location: ./application/modules/loket/models/M_loket.php */