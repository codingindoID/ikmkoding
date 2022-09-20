<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class M_admin extends CI_Model
{
	//belum publish
	function get_blm_publish($bulan, $tahun)
	{
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '1');
		$hasil = $this->db->get('tb_hasil')->result();
		return count($this->_arrayResponden($hasil));
	}

	//kepuasan
	function _get_kepuasan_filter($hasil)
	{
		$total_responden = count($this->_arrayResponden($hasil));
		$total_soal = $this->db->get('tb_pertanyaan')->num_rows();

		$jawaban_a = $this->_hitungJawaban($hasil, 'a');
		$jawaban_b = $this->_hitungJawaban($hasil, 'b');
		$jawaban_c = $this->_hitungJawaban($hasil, 'c');
		$jawaban_d = $this->_hitungJawaban($hasil, 'd');

		$kepuasan = ($total_responden) ? (($jawaban_a * 1) + ($jawaban_b * 2) + ($jawaban_c * 3) + ($jawaban_d * 4)) / ($total_responden * $total_soal * 4) : 0;
		return [
			'kepuasan'			=> $kepuasan * 100,
			'total_responden'	=> $total_responden
		];
	}

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

	// pendidikan
	function _get_pendidikan_filter($hasil)
	{
		$array = [];
		$response = [];
		$id_responden = $this->_arrayResponden($hasil);

		if ($id_responden) {
			$this->db->where_in('id_responden', $id_responden);
			$array =  $this->db->get('tb_detil_responden')->result();
		}

		$pendidikan = $this->db->get('tb_pendidikan')->result();
		foreach ($pendidikan as $p) {
			$hasil = [
				'pendidikan'	=> $p->pendidikan,
				'jumlah'		=> ($array) ? $this->_getTotalPendidikanResponden($p->pendidikan, $array) : 0
			];
			array_push($response, $hasil);
		}
		return $response;
	}

	function _getTotalPendidikanResponden($pendidikan, $array)
	{
		$total = 0;
		if ($array) {
			for ($i = 0; $i < count($array); $i++) {
				if ($pendidikan == $array[$i]->pendidikan) {
					$total++;
				}
			}
		}
		return $total;
	}

	// pekerjaan
	function _get_pekerjaan_filter($hasil)
	{
		$array = [];
		$response = [];
		$id_responden = $this->_arrayResponden($hasil);

		if ($id_responden) {
			$this->db->where_in('id_responden', $id_responden);
			$array =  $this->db->get('tb_detil_responden')->result();
		}

		$pekerjaan = $this->db->get('tb_pekerjaan')->result();
		foreach ($pekerjaan as $p) {
			$hasil = [
				'pekerjaan'		=> $p->pekerjaan,
				'jumlah'		=> ($array) ? $this->_getTotalPekerjaanResponden($p->pekerjaan, $array) : 0
			];
			array_push($response, $hasil);
		}
		return $response;
	}

	function _getTotalPekerjaanResponden($pekerjaan, $array)
	{
		$total = 0;
		if ($array) {
			for ($i = 0; $i < count($array); $i++) {
				if ($pekerjaan == $array[$i]->pekerjaan) {
					$total++;
				}
			}
		}
		return $total;
	}

	// Rekap kepuasan Persoal
	function rekapKepuasanPersoal($array)
	{
		$total_responden = count($this->_arrayResponden($array));
		$hasil = array();
		$no = 0;
		$soal = $this->M_master->getall('tb_pertanyaan')->result();
		foreach ($soal as $v) {
			$hasil[$no] = [
				'kepuasan'	=> $this->_getKepuasanPersoal($array, $v->id_soal, $total_responden),
				'id_soal'	=> $v->id_soal,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'sp'		=> $this->_getRataRataJawaban($v->id_soal, 'd', $array),
				'p'			=> $this->_getRataRataJawaban($v->id_soal, 'c', $array),
				'tp'		=> $this->_getRataRataJawaban($v->id_soal, 'b', $array),
				'kec'		=> $this->_getRataRataJawaban($v->id_soal, 'a', $array),
			];
			$no++;
		}
		return $hasil;
	}

	function urutkanHasil($hasil)
	{
		sort($hasil);
		$data_short = $this->_get_prioritas($hasil);
		usort($data_short, fn ($a, $b) => $a['kepuasan'] <=> $b['kepuasan']);
		return $data_short;
	}

	function _get_prioritas($data)
	{
		$hasil = array();
		$no = 1;
		foreach ($data as $v) {
			$hasil[$no] = [
				'id_soal'	=> $v['id_soal'],
				'kepuasan'	=> $v['kepuasan'],
				'kategori'	=> $v['kategori'],
				'soal'		=> $v['soal'],
				'sp'		=> $v['sp'],
				'p'			=> $v['p'],
				'tp'		=> $v['tp'],
				'kec'		=> $v['kec'],
				'prioritas' => $no
			];
			$no++;
		}

		return $hasil;
	}

	function _getKepuasanPersoal($array, $id_soal, $total_responden)
	{
		$respondenPerSoal = [];
		if ($array) {
			for ($i = 0; $i < count($array); $i++) {
				if ($id_soal == $array[$i]->id_soal) {
					array_push($respondenPerSoal, $array[$i]);
				}
			}
		}

		$jawaban_a = $this->_hitungJawaban($respondenPerSoal, 'a');
		$jawaban_b = $this->_hitungJawaban($respondenPerSoal, 'b');
		$jawaban_c = $this->_hitungJawaban($respondenPerSoal, 'c');
		$jawaban_d = $this->_hitungJawaban($respondenPerSoal, 'd');

		$kepuasan = ($total_responden) ? (($jawaban_a * 1) + ($jawaban_b * 2) + ($jawaban_c * 3) + ($jawaban_d * 4)) / ($total_responden * 4) : 0;
		return ($kepuasan > 1) ? 100 : $kepuasan * 100;
	}

	function _getRataRataJawaban($id_soal, $jawaban, $array)
	{
		$respondenPerSoal = [];
		if ($array) {
			for ($i = 0; $i < count($array); $i++) {
				if ($id_soal == $array[$i]->id_soal) {
					array_push($respondenPerSoal, $array[$i]);
				}
			}
		}
		return $this->_hitungJawaban($respondenPerSoal, $jawaban);
	}

	// grafik
	function grafik($hasil)
	{
		$sangat_puas 	= $this->_hitungJawaban($hasil, 'd');
		$puas 		 	= $this->_hitungJawaban($hasil, 'c');
		$tidak_puas 	= $this->_hitungJawaban($hasil, 'b');
		$kecewa 		= $this->_hitungJawaban($hasil, 'a');

		$all = $sangat_puas + $puas + $tidak_puas + $kecewa;

		if ($all != 0) {
			$data = [
				[
					'name' 	=> 'sangat_puas',
					'y'		=> $sangat_puas,
					'color' => '#00FF00'
				],
				[
					'name' 	=> 'puas',
					'y'		=> $puas,
					'color' => 'blue'
				],
				[
					'name' 	=> 'tidak_puas',
					'y'		=> $tidak_puas,
					'color' => 'purple'
				],
				[
					'name' 	=> 'kecewa',
					'y'		=> $kecewa,
					'color' => 'red'
				]
			];
			return $data;
		} else {
			return null;
		}
	}

	//umur
	function arrayUmur($pengunjung)
	{
		//data umur
		$up40 = $this->get_umur('up40', $pengunjung);
		$min40 = $this->get_umur('min40', $pengunjung);
		//presentase umur
		$p40	= (($up40 + $min40) > 0) ?  $up40 / ($up40 + $min40) : 0;
		$m40 	= (($up40 + $min40) > 0) ? $min40 / ($up40 + $min40) : 0;

		return [
			'up40'	=> [
				'index'			=> '< 40',
				'jumlah'		=> $up40,
				'presentase'	=> number_format($p40 * 100, 2)
			],
			'min40'	=> [
				'index'			=> '>= 40',
				'jumlah'		=> $min40,
				'presentase'	=> number_format($m40 * 100, 2)
			]
		];
	}

	function get_umur($param, $hasil)
	{
		$array = [];
		$array40 = [];
		$arraymin = [];

		$id_responden = $this->_arrayResponden($hasil);
		if ($id_responden) {
			$this->db->where_in('id_responden', $id_responden);
			$array =  $this->db->get('tb_detil_responden')->result();
		}

		if ($array) {
			foreach ($array as $dat) {
				if ($dat->umur >= 40) {
					array_push($array40, $dat);
				} else {
					array_push($arraymin, $dat);
				}
			}
		}
		return ($param == 'up40') ? count($array40) : count($arraymin);
	}

	// JK
	function arrayJk($pengunjung)
	{
		//data JK
		$lk = $this->getJK('Laki-laki', $pengunjung);
		$pr = $this->getJK('Perempuan', $pengunjung);
		//presentase umur
		$plk	= (($lk + $pr) > 0) ?  $lk / ($lk + $pr) : 0;
		$ppr 	= (($lk + $pr) > 0) ?   $pr / ($lk + $pr) : 0;
		return [
			'laki'	=> [
				'jk'		=> 'Laki-laki',
				'jumlah'	=> $lk,
				'presentase' => number_format($plk * 100, 2)
			],
			'pr'	=> [
				'jk'		=> 'Perempuan',
				'jumlah'	=> $pr,
				'presentase' => number_format($ppr * 100, 2)
			],
		];
	}

	function getJk($param, $hasil)
	{
		$array = [];
		$pr = [];
		$lk = [];

		$id_responden = $this->_arrayResponden($hasil);
		if ($id_responden) {
			$this->db->where_in('id_responden', $id_responden);
			$array =  $this->db->get('tb_detil_responden')->result();
		}

		if ($array) {
			foreach ($array as $dat) {
				if ($dat->jk >= 'Perempuan') {
					array_push($pr, $dat);
				} else {
					array_push($lk, $dat);
				}
			}
			return ($param == 'Perempuan') ? count($pr) : count($lk);
		}
	}

	// pertanyaan publish
	function belumPublish($hasil)
	{
		$res = [];
		$total_soal = $this->db->get('tb_pertanyaan')->num_rows();
		$id_responden = $this->_arrayResponden($hasil);
		if ($id_responden) {
			foreach ($id_responden as $id) {
				$jawabanById = $this->db->get_where('tb_hasil', ['id_responden'	=> $id])->result();

				$jawaban_a = $this->_hitungJawaban($jawabanById, 'a');
				$jawaban_b = $this->_hitungJawaban($jawabanById, 'b');
				$jawaban_c = $this->_hitungJawaban($jawabanById, 'c');
				$jawaban_d = $this->_hitungJawaban($jawabanById, 'd');
				$kepuasan = (($jawaban_a * 1) + ($jawaban_b * 2) + ($jawaban_c * 3) + ($jawaban_d * 4)) / $total_soal;

				$dat = [
					'id_responden'		=> $id,
					'rata'				=> $kepuasan,
					'tanggal'			=> ($jawabanById) ? date('Y-m-d', strtotime($jawabanById[0]->created_date)) : '',
					'jam_isi'			=> ($jawabanById) ? date('H:i:s', strtotime($jawabanById[0]->created_date)) : ''
				];
				array_push($res, $dat);
			}
		}
		return $res;
	}

	function getdetil($id_responden)
	{
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = tb_hasil.id_soal');
		$this->db->where('id_responden', $id_responden);
		return $this->db->get('tb_hasil')->result();
	}

	function cetakrekapdetil($hasil)
	{
		$response = [];
		$id_responden = $this->_arrayResponden($hasil);
		if ($id_responden) {
			foreach ($id_responden as $id) {
				$detil = $this->db->get_where('tb_detil_responden', ['id_responden' => $id])->row();
				$jawaban = $this->olahJawaban($hasil, $id);
				$res = [
					'id_responden'	=> $id,
					'nama'			=> ($detil) ? $detil->nama : '',
					'jawaban' 		=> $jawaban,
					'tanggal'		=> ($jawaban) ? $jawaban[0]->created_date : '',
				];
				array_push($response, $res);
			}
		}
		return $response;
	}

	function olahJawaban($hasil, $id_responden)
	{
		$res = [];
		if ($hasil) {
			foreach ($hasil as $h) {
				if ($h->id_responden == $id_responden) {
					array_push($res, $h);
				}
			}
		}
		return $res;
	}

	// saran
	function getSaran()
	{
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_saran.id_responden');
		$this->db->where('tb_saran.status', '1');
		return $this->db->get('tb_saran');
	}

	/*IMPORT*/
	function importData()
	{
		$nama = uniqid() . '.xlsx';
		$config['upload_path']          = './assets/excel/';
		$config['allowed_types']        = 'xls|xlsx';
		$config['file_name']           	= $nama;
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;
		if (!$this->upload->do_upload('file')) {
			$response = $this->upload->display_errors();
			return [
				'kode'		=> 'error',
				'msg'		=> $response
			];
		} else {
			$spreadsheet 	= \PhpOffice\PhpSpreadsheet\IOFactory::load($config['upload_path'] . $config['file_name']);
			$worksheet 		= $spreadsheet->getActiveSheet()->toArray();

			$dataResponden = [];
			$dataJawaban = [];
			for ($i = 1; $i < count($worksheet); $i++) {
				if ($worksheet[$i][0] != "") {
					$id_responden = uniqid();
					$dat = [
						'id' 			=> uniqid(),
						'id_responden' 	=> $id_responden,
						'created_date'	=> date('Y-m-d H:i:s', strtotime($worksheet[$i][0])),
						'loket' 		=> $worksheet[$i][1],
						'nama'			=> $worksheet[$i][2],
						'umur'			=> $worksheet[$i][3],
						'jk'			=> $worksheet[$i][4],
						'pekerjaan'		=> $worksheet[$i][5],
						'pendidikan'	=> $worksheet[$i][6],
					];
					array_push($dataResponden, $dat);

					for ($colom = 1; $colom < 10; $colom++) {
						$index = 6 + $colom;
						switch ($worksheet[$i][$index]) {
							case '4':
								$jawaban = 'd';
								break;
							case '3':
								$jawaban = 'c';
								break;
							case '2':
								$jawaban = 'b';
								break;

							default:
								$jawaban = 'a';
								break;
						}

						$dat2 = [
							'id_kuis' 		=> uniqid(),
							'id_responden' 	=> $id_responden,
							'id_soal'		=> "U" . $colom,
							'jawaban'		=> $jawaban,
							'created_date'	=> date('Y-m-d H:i:s', strtotime($worksheet[$i][0])),
							'published'		=> '2'
						];
						array_push($dataJawaban, $dat2);
					}
				}
			}

			$this->db->insert_batch('tb_detil_responden', $dataResponden);
			$this->db->insert_batch('tb_hasil', $dataJawaban);
			unlink("./assets/excel/$nama");

			return [
				'hasil'		=> $dataJawaban,
				'resp'		=> $dataResponden,
				'kode'		=> 'success',
				'msg'		=> 'success'
			];
		}
	}
}

/* End of file M_admin.php */
/* Location: ./application/modules/admin/models/M_admin.php */