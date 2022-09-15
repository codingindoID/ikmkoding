<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class M_admin extends CI_Model
{

	function getSoal()
	{
		return $this->db->get('tb_pertanyaan');
	}

	function _get_pendidikan_filter($bulan, $tahun)
	{
		$pendidikan = $this->M_master->getall('tb_pendidikan')->result();
		$no = 1;
		foreach ($pendidikan as $p) {
			$hasil[$no] = [
				'pendidikan'	=> $p->pendidikan,
				'jumlah'		=> $this->join_get_responden_2_filter('pendidikan', $p->pendidikan, $bulan, $tahun)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}

	function _get_pekerjaan_filter($bulan, $tahun)
	{
		$pekerjaan = $this->M_master->getall('tb_pekerjaan')->result();
		$no = 1;
		foreach ($pekerjaan as $p) {
			$hasil[$no] = [
				'pekerjaan'		=> $p->pekerjaan,
				'jumlah'		=> $this->join_get_responden_2_filter('pekerjaan', $p->pekerjaan, $bulan, $tahun)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}

	function get_responden_publish($bulan, $tahun)
	{
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->where('published', '2');
		if ($bulan == 'setahun') {
			$this->db->where('YEAR(tb_hasil.created_date)', $tahun);
		} else {
			$this->db->where('MONTH(tb_hasil.created_date)', $bulan);
			$this->db->where('YEAR(tb_hasil.created_date)', $tahun);
		}

		$this->db->group_by('tb_hasil.id_responden');
		return $this->db->get('tb_hasil');
	}

	function get_responden_1()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('tb_hasil', ['published' => '1']);
	}

	function get_blm_publish($bulan, $tahun)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(created_date) BETWEEN "01" and "' . date('m') . '" and YEAR(created_date) = "' . $tahun . '"';
		} else {
			$query = 'MONTH(created_date) = "' . $bulan . '" and YEAR(created_date) = "' . $tahun . '"';
		}

		$this->db->where($query);
		$this->db->where('published', '1');
		$this->db->group_by('tb_hasil.id_responden');
		return $this->db->get('tb_hasil');
	}


	function join_get_responden_2($kolom, $param)
	{
		return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM tb_hasil where published = 2) as a  , tb_detil_responden  b where  a = b.id_responden and b.' . $kolom . ' = "' . $param . '"');
	}

	function join_get_responden_2_filter($kolom, $param, $bulan, $tahun)
	{
		if ($bulan == 'setahun') {
			return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM tb_hasil where published = 2 and MONTH(created_date) BETWEEN "01" AND "' . date('m') . '" and YEAR(created_date) = "' . $tahun . '") as a  , tb_detil_responden  b where  a = b.id_responden and b.' . $kolom . ' = "' . $param . '"');
		}
		return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM tb_hasil where published = 2 and MONTH(created_date) = "' . $bulan . '" and YEAR(created_date) = "' . $tahun . '") as a  , tb_detil_responden  b where  a = b.id_responden and b.' . $kolom . ' = "' . $param . '"');
	}

	function getdetil($id_responden)
	{
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = tb_hasil.id_soal');
		$this->db->where('id_responden', $id_responden);
		return $this->db->get('tb_hasil')->result();
	}

	function getSaran()
	{
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_saran.id_responden');
		$this->db->where('tb_saran.status', '1');
		return $this->db->get('tb_saran');
	}

	function get_umur($param, $data)
	{
		$array40 = [];
		$arraymin = [];
		foreach ($data->result() as $dat) {
			if ($dat->umur >= 40) {
				array_push($array40, $dat);
			} else {
				array_push($arraymin, $dat);
			}
		}
		return ($param == 'up40') ? count($array40) : count($arraymin);
	}

	function getJK($param, $data)
	{
		$pr = [];
		$lk = [];
		foreach ($data->result() as $dat) {
			if ($dat->jk >= 'Perempuan') {
				array_push($pr, $dat);
			} else {
				array_push($lk, $dat);
			}
		}
		return ($param == 'Perempuan') ? count($pr) : count($lk);
	}

	/*baru*/
	function getdetilresponden($id_responden)
	{
		$this->db->join('tb_loket', 'tb_loket.id_loket = tb_detil_responden.loket');
		return $this->db->get_where('tb_detil_responden', ['id_responden' => $id_responden])->row();
	}

	function get_rekap_hasil()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		$this->db->where('date(created_date)', date('2021-03-09'));
		$this->db->where('published', 2);
		return $this->db->get_where('tb_hasil');
	}

	function get_kuisioner($id_responden)
	{
		$pertanyaan = $this->db->get('tb_pertanyaan')->result();

		$no = 0;
		foreach ($pertanyaan as $p) {
			$hasil[$no++] = [
				'pertanyaan'	=> $p->soal,
				'jawaban'		=> $this->_get_jawaban($p->id_soal, $id_responden)
			];
		}

		return $hasil;
	}

	function _get_jawaban($id_soal, $id_responden)
	{
		$where = [
			'id_responden'		=> $id_responden,
			'tb_hasil.id_soal'			=> $id_soal
		];

		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = tb_hasil.id_soal');
		$data = $this->db->get_where('tb_hasil', $where)->row();

		if ($data) {
			$kolom = $data->jawaban;
			return $data->$kolom;
		}
		return null;
	}

	function get_tanggal_responden($id_responden)
	{
		$data = $this->db->get_where('tb_hasil', ['id_responden' => $id_responden])->row();

		return $this->indo->konversi($data->created_date);
	}

	function get_jam_responden($id_responden)
	{
		$data = $this->db->get_where('tb_hasil', ['id_responden' => $id_responden])->row();

		return date('H:i:s', strtotime($data->created_date));
	}


	/*IMPORT*/
	function importAction()
	{
		$nama = uniqid() . '.xlsx';
		$config['upload_path']          = './assets/excel/';
		$config['allowed_types']        = 'xls|xlsx';
		$config['file_name']           	= $nama;
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;

		if (!$this->upload->do_upload('file')) {
			$response = $this->upload->display_errors();
			$res = [
				'kode'		=> 'error',
				'msg'		=> $response
			];
		} else {
			//proses import
			$spreadsheet 	= \PhpOffice\PhpSpreadsheet\IOFactory::load($config['upload_path'] . $config['file_name']);
			$worksheet 		= $spreadsheet->getActiveSheet()->toArray();

			$data_import  =	[];
			$no = 0;
			for ($i = 1; $i < count($worksheet); $i++) {
				$data[$no] = [
					'id_kuis'		=> uniqid(),
					'id_responden' 	=> $worksheet[$i][0],
					'id_soal' 		=> strtoupper($worksheet[$i][1]),
					'jawaban'		=> $worksheet[$i][2],
					'created_date'	=> date('Y-m-d H:i:s', strtotime($worksheet[$i][3])),
					'published'		=> $worksheet[$i][4],
				];
				$no++;
			}

			$cek = $this->db->insert_batch('tb_hasil', $data);
			if ($cek) {
				$res = [
					'kode'		=> 'success',
					'msg'		=> 'import success'
				];
			} else {
				$res = [
					'kode'		=> 'error',
					'msg'		=> 'import gagal'
				];
			}
			unlink('./assets/excel/' . $nama);
		}
		return $res;
	}

	function importResponden()
	{
		$nama = uniqid() . '.xlsx';
		$config['upload_path']          = './assets/excel/';
		$config['allowed_types']        = 'xls|xlsx';
		$config['file_name']           	= $nama;
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;

		if (!$this->upload->do_upload('file')) {
			$response = $this->upload->display_errors();
			$res = [
				'kode'		=> 'error',
				'msg'		=> $response
			];
		} else {
			//proses import
			$spreadsheet 	= \PhpOffice\PhpSpreadsheet\IOFactory::load($config['upload_path'] . $config['file_name']);
			$worksheet 		= $spreadsheet->getActiveSheet()->toArray();

			$data_import  =	[];
			$no = 0;
			for ($i = 1; $i < count($worksheet); $i++) {
				$data[$no] = [
					'id'			=> uniqid(),
					'id_responden' 	=> $worksheet[$i][0],
					'nama' 			=> strtoupper($worksheet[$i][1]),
					'umur'			=> $worksheet[$i][2],
					'jk'			=> $worksheet[$i][3],
					'pendidikan'	=> $worksheet[$i][4],
					'pekerjaan'		=> $worksheet[$i][5],
					'loket'			=> $worksheet[$i][6],
					'created_date'	=> date('Y-m-d H:i:s', strtotime($worksheet[$i][7])),
					'status'		=> '1',
				];
				$no++;
			}

			$cek = $this->db->insert_batch('tb_detil_responden', $data);
			if ($cek) {
				$res = [
					'kode'		=> 'success',
					'msg'		=> 'import success'
				];
			} else {
				$res = [
					'kode'		=> 'error',
					'msg'		=> 'import gagal'
				];
			}
			unlink('./assets/excel/' . $nama);
		}
		return $res;
	}
}

/* End of file M_admin.php */
/* Location: ./application/modules/admin/models/M_admin.php */