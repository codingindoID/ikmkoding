<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_loket extends CI_Model
{
	function _arrayResponden($array)
	{
		$total = [];
		if ($array) {
			$responden = [];
			for ($i = 0; $i < count($array); $i++) {
				if (!in_array($array[$i]->id_responden, $responden, true)) {
					array_push($responden, $array[$i]->id_responden);
				}
			}
			$total = $responden;
		}
		return $total;
	}

	function dataPerloket($hasil)
	{
		$array = [];
		$response = [];
		$id_responden = $this->_arrayResponden($hasil);

		if ($id_responden) {
			$this->db->where_in('id_responden', $id_responden);
			$array =  $this->db->get('tb_detil_responden')->result();
		}

		$loket = $this->db->get('tb_loket')->result();
		foreach ($loket as $dat) {
			$respondenLoket = $this->_hitungJumlahRespondenLoket($array, $dat->id_loket);
			$res = [
				'id_loket'				=> $dat->id_loket,
				'jenis_layanan'			=> $dat->nama_loket,
				'jumlah_responden'		=> count($respondenLoket),
				'total_semua'			=> count($id_responden),
				'persen'				=> (count($id_responden) > 0) ? (count($respondenLoket) / count($id_responden)) * 100 : 0,
				'kepuasan'				=> $this->_getKepuasanLoket($hasil, $respondenLoket)
			];
			array_push($response, $res);
		}
		return $response;
	}

	function _hitungJumlahRespondenLoket($array, $id_loket)
	{
		$total = [];
		if ($array) {
			$responden = [];
			foreach ($array as $ar) {
				if ($ar->loket == $id_loket) {
					array_push($responden, $ar->id_responden);
				}
			}
			$total = $responden;
		}
		return $total;
	}

	function _getKepuasanLoket($hasil, $array_responden)
	{
		$kepuasan = 0;
		$total_soal = $this->db->get('tb_pertanyaan')->num_rows();
		if ($hasil) {
			$array = [];
			for ($i = 0; $i < count($hasil); $i++) {
				if (in_array($hasil[$i]->id_responden, $array_responden, true)) {
					array_push($array, $hasil[$i]);
				}
			}

			$jawaban_a = $this->_hitungJawaban($array, 'a');
			$jawaban_b = $this->_hitungJawaban($array, 'b');
			$jawaban_c = $this->_hitungJawaban($array, 'c');
			$jawaban_d = $this->_hitungJawaban($array, 'd');

			if (count($array_responden) > 0) {
				$kepuasan = (($jawaban_a * 1) + ($jawaban_b * 2) + ($jawaban_c * 3) + ($jawaban_d * 4)) / ($total_soal * count($array_responden) * 4);
			}
		}
		return $kepuasan * 100;
	}

	function _hitungJawaban($array, $jawaban)
	{
		$total = 0;
		if ($array) {
			for ($i = 0; $i < count($array); $i++) {
				if ($array[$i]->jawaban == $jawaban) {
					$total++;
				}
			}
		}
		return $total;
	}
}

/* End of file M_loket.php */
/* Location: ./application/modules/loket/models/M_loket.php */