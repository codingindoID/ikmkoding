<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_loket extends CI_Model
{
	function total_responden($data)
	{
		$array = [];
		foreach ($data as $a) {
			if (!in_array($a->id_responden, $array, true)) {
				array_push($array, $a->id_responden);
			}
		}
		return count($array);
	}

	function repondenLoket($data, $totalResponden)
	{
		$this->db->order_by('nama_loket', 'asc');
		$loket = $this->db->get('tb_loket')->result();
		$response = [];

		foreach ($loket as $lok) {
			$respondenLoket = $this->_respondenLoket($data, $lok->id_loket);
			$groupRespondenLoket = $this->total_responden($respondenLoket);
			$res = [
				'id_loket'				=> $lok->id_loket,
				'jenis_layanan'			=> $lok->nama_loket,
				'jumlah_responden'		=> $groupRespondenLoket,
				'total_semua'			=> $totalResponden,
				'persen'				=> ($totalResponden > 0) ? ($groupRespondenLoket / $totalResponden) * 100 : 0,
				'kepuasan'				=> $this->_kepuasanLoket($respondenLoket, $groupRespondenLoket)
			];
			array_push($response, $res);
		}
		return $response;
	}

	function _respondenLoket($data, $id_loket)
	{
		$a = 0;
		$arrayLoket = [];
		while ($a < count($data)) {
			if ($data[$a]->loket == $id_loket) {
				array_push($arrayLoket, $data[$a]);
			}
			$a++;
		}
		return $arrayLoket;
	}

	function _kepuasanLoket($data, $totalResponden)
	{
		$total_soal = $this->db->get('tb_pertanyaan')->num_rows();
		$nilai = 0;
		$a = $this->_nilai($data, 'a');
		$b = $this->_nilai($data, 'b');
		$c = $this->_nilai($data, 'c');
		$d = $this->_nilai($data, 'd');

		if ($totalResponden > 0) {
			$nilai = (($a * 1) + ($b * 2) + ($c * 3) + ($d * 4)) / ($totalResponden * 4 * $total_soal);
		}
		return $nilai * 100;
	}

	function _nilai($data, $pilihan)
	{
		$no = 1;
		$count = 0;
		foreach ($data as $j) {
			if ($j->jawaban == $pilihan) {
				$count++;
			}
		}
		return $count;
	}
}

/* End of file M_loket.php */
/* Location: ./application/modules/loket/models/M_loket.php */