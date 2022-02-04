<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_survey extends CI_Model
{
	function loket()
	{
		$this->db->order_by('nama_loket', 'asc');
		return $this->db->get('tb_loket')->result();
	}

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

	function save($table, $data)
	{
		$this->db->insert($table, $data);
	}

	function update($table, $where, $data)
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
		return $this->db->get_where('tb_hasil', ['published' => '1']);
	}

	function join_get_responden_2($kolom, $param)
	{
		return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM tb_hasil where published = 2) as a  , tb_detil_responden  b where  a = b.id_responden and b.' . $kolom . ' = "' . $param . '"');
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
		} else {
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

	/*visitor*/
	function visitor()
	{
		$ip 		= $this->input->ip_address();
		$where = [
			'ip_address'		=> $ip,
			'tanggal'			=> date('Y-m-d')
		];

		$cek = $this->db->get_where('visitor', $where)->row();
		if (!$cek) {
			$this->db->insert('visitor', $where);
		}
	}

	/* NEW METHOD */
	function kirimJawaban()
	{
		$no = 0;
		$star = [];
		$totalStar = 0;
		$jawaban = $this->input->post('jawaban');
		$id_soal = $this->input->post('id_soal');
		$id_responden = $this->input->post('id_responden');
		$hasil = [];
		$totalsoal = count($jawaban);

		foreach ($jawaban as $j) {
			switch ($j) {
				case "4":
					$nilai = "d";
					break;
				case "3":
					$nilai = "c";
					break;
				case "2":
					$nilai = "b";
					break;
				case "1":
					$nilai = "a";
					break;
			}

			$hasil[$no] = [
				'id_kuis'			=> uniqid(),
				'jawaban'			=> $nilai,
				'id_soal'			=> $id_soal[$no],
				'id_responden'		=> $id_responden,
				'created_date'		=> date('Y-m-d H:i:s'),
				'published'			=> '1'
			];

			$star[$no]  = [
				'jawaban'		=> $j
			];
			$totalStar += $star[$no]['jawaban'];
			$no++;
		}

		$totalStar 	= $totalStar / $totalsoal;
		$persenStar = ($totalStar / 4) * 100;

		$cek = $this->db->insert_batch('tb_hasil', $hasil);
		if ($cek) {
			$saran = [
				'id_responden'			=> $id_responden,
				'saran'					=> $this->input->post('saran'),
				'created_date'			=> date('Y-m-d H:i:s'),
				'status'				=> "1"
			];
			$this->db->insert('tb_saran', $saran);
			return  [
				'kode'		=> 'success',
				'star'		=> $totalStar,
				'persen'	=> $persenStar,
				'msg'		=> 'atas partisipasi anda,. Salam Jepara Smart.. '
			];
		}
		return  [
			'kode'		=> 'error',
			'star'		=> 0,
			'persen'	=> 0,
			'msg'		=> 'ada yang salah'
		];
	}
}

/* End of file M_survey.php */
/* Location: ./application/modules/survey/models/M_survey.php */