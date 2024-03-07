<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survey extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_survey');
		$this->load->model('M_master');
		$this->M_survey->visitor();
	}

	public function index()
	{
		$data = [
			'pendidikan'	=> [],
			'pekerjaan'		=> [],
			'news1'			=> $this->M_master->getWhere('news', ['id' => 1])->row(),
			'news2'			=> $this->M_master->getWhere('news', ['id' => 2])->row(),
			'faq'			=> $this->M_master->getall('faq')->result(),
		];
		$this->load->view('index', $data);
	}

	function userToken()
	{
		$data = [
			'id_responden' 	=> uniqid(),
			'pekerjaan'		=> $this->db->get('tb_pekerjaan')->result(),
			'pendidikan'	=> $this->db->get('tb_pendidikan')->result(),
			'loket'			=> $this->M_survey->loket(),
		];
		$this->load->view('detil_responden', $data);
	}

	function adminToken()
	{
		$data = [
			'id_responden' 	=> uniqid(),
			'pekerjaan'		=> $this->db->get('tb_pekerjaan')->result(),
			'pendidikan'	=> $this->db->get('tb_pendidikan')->result(),
			'loket'			=> $this->M_survey->loket()
		];
		$this->load->view('detil_respondenAdmin', $data);
	}

	public function cek_user()
	{
		$no_antri		= strtoupper($this->input->post('no_antri'));
		$tgl_antri		= $this->input->post('tgl_antri');
		if ($no_antri == null || $no_antri == '' || $tgl_antri == null || $tgl_antri == '') {
			$this->session->set_flashdata('error', 'Isian Kurang Lengkap');
			redirect('survey', 'refresh');
		}

		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$base = "https://atompp.jepara.go.id/";
		$path = $base . "api/cekAntri/" . $no_antri . '/' . $tgl_antri;
		$data = file_get_contents($path, false, stream_context_create($arrContextOptions));
		$data = json_decode($data);

		$tgl = date('dmY', strtotime($tgl_antri));
		if ($data->success == 1) {

			$cek = $this->M_master->getWhere('tb_hasil', ['id_responden' => $no_antri . $tgl])->num_rows();
			if ($cek > 0) {
				$this->session->set_flashdata('error', 'Anda Sudah Pernah Mengisi');
				redirect('survey', 'refresh');
			} else {
				$arrContextOptions = array(
					"ssl" => array(
						"verify_peer" => false,
						"verify_peer_name" => false,
					),
				);

				$path 	= $base . "api/loket";
				$loket 	= file_get_contents($path, false, stream_context_create($arrContextOptions));
				$loket 	= json_decode($loket);


				$data = [
					'id_responden' 	=> $no_antri . $tgl,
					'pekerjaan'		=> $this->M_master->getall('tb_pekerjaan')->result(),
					'pendidikan'	=> $this->M_master->getall('tb_pendidikan')->result(),
					'loket'			=> $loket,
					'visitor'		=> $this->M_survey->visitor()
				];
				$this->load->view('detil_responden', $data);
			}
		} else {
			$this->session->set_flashdata('error', 'No Antrian Tidak Terdaftar');
			redirect('survey', 'refresh');
		}
	}

	function post_detil_responden()
	{
		$tgl = $this->input->post('tanggal');
		$cek = $this->M_survey->post_detil_responden();
		if ($cek['kode'] == 'success') {
			redirect('survey/pertanyaan/' . $this->input->post('id_responden') . '/' . $cek['id_detil'] . '/' . $tgl, 'refresh');
		} else {
			$this->session->set_flashdata('error', 'terjadi Kesalahan');
			redirect('survey', 'refresh');
		}
	}

	public function pertanyaan($responden, $id_detil, $tgl = null)
	{
		$tgl 			= $tgl ? date('Y-m-d', strtotime($tgl)) : date('Y-m-d H:i:s');
		$cek 			= $this->M_survey->cekResponden(['id_responden' => $responden])->row();

		if ($cek) {
			$this->session->set_flashdata('error', 'responden sudah pernah berpartisipasi');
			redirect('survey/index', 'refresh');
		} else {
			$data['nsoal'] 		= $this->M_survey->getSoal()->num_rows();
			$data['soal']		= $this->db->get('tb_pertanyaan')->result();
			$data['noreg'] 		= $responden;
			$data['id_detil']	= $id_detil;
			$data['tanggal']	= $tgl;
			$this->load->view('quest', $data);
		}
	}

	function kirimJawaban()
	{
		$cek = $this->M_survey->kirimJawaban();
		$this->session->set_flashdata($cek['kode'], $cek['msg']);
		redirect('survey/end_survey/' . urlencode($cek['star']) . '/' . urlencode($cek['persen']), 'refresh');
	}

	function saran($id_responden)
	{
		$data['responden'] = $id_responden;
		$this->load->view('saran', $data);
	}

	/*admin page*/
	function admin()
	{
		$this->load->view('sesi/header');
		$this->load->view('admin/auth');
		$this->load->view('sesi/script');
	}

	function auth()
	{
		$data = [
			'username'		=> $this->input->post('username'),
			'password'		=> md5($this->input->post('password')),
		];

		$cek = $this->M_survey->auth($data)->num_rows();
		if ($cek >= 1) {
			$user = $this->M_survey->auth($data)->row();
			$this->session->set_userdata('skm_user', $user->username);
			$this->session->set_userdata('skm_id', $user->id_admin);
			$this->session->set_userdata('skm_disp', $user->display);
			$this->session->set_userdata('skm_level', $user->level);
			redirect('admin', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'username atau password salah');
			redirect('satpam', 'refresh');
		}
	}

	function errorpage()
	{
		$this->load->view('404');
	}

	function visitor()
	{
		$visitor = $this->db->get('count_visitor')->row();

		$jumlahSoal = $this->db->get_where('tb_pertanyaan', ['jenis_pertanyaan'	=> KODEPELAYANAN])->num_rows();

		/* MENGHITUNG TOTAL NILAI */
		$this->db->select('(IFNULL(sum(jumlah_4),0) *4) + (IFNULL(sum(jumlah_3),0) *3) + (IFNULL(sum(jumlah_2),0) *2) + IFNULL(sum(jumlah_1),0) as total');
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
		$totalNilai = $this->db->get_where('count_point', ['jenis_pertanyaan'	=> KODEPELAYANAN])->row();
		$totalNilai = $totalNilai ? $totalNilai->total : 0;

		/* TOTAL RESPONDEN */
		$this->db->where('published', '2');
		$this->db->group_by('id_responden');
		$totalResponden = $this->db->select('id_responden')->get('tb_hasil')->num_rows();

		$kepuasan = ($totalNilai / ($totalResponden * 4 * $jumlahSoal)) * 100;
		if ($kepuasan > 81.25 && $kepuasan < 100) {
			$index = "Sangat Baik";
		} else if ($kepuasan > 62.50 && $kepuasan < 81.26) {
			$index = 'Baik';
		} else if ($kepuasan > 43.75 && $kepuasan < 62.51) {
			$index = 'Kurang Baik';
		} else if ($kepuasan > 24.9 && $kepuasan < 43.76) {
			$index = 'Tidak Baik';
		} else {
			$index = null;
		}

		$data = [
			'now'				=> $visitor->now,
			'all'				=> $visitor->all,
			'responden' 		=> $totalResponden,
			'loket'				=> $this->M_master->getall('tb_loket')->num_rows(),
			'nilai_kepuasan'	=> number_format($kepuasan, 2),
			'tingkat_kepuasan'	=> $index,
			'totalNilai'		=> $totalNilai
		];
		echo json_encode($data);
	}

	function end_survey($star, $persen)
	{
		$data = [
			'star'		=> urldecode($star),
			'persen'	=> urldecode($persen)
		];
		$this->load->view('end_survey', $data);
	}

	/* AJAX */
	function ajaxPie()
	{
		$label = [
			[
				'label'		=> 'Sangat Puas',
				'nilai'		=> 4
			],
			[
				'label'		=> 'Puas',
				'nilai'		=> 3
			],
			[
				'label'		=> 'Tidak Puas',
				'nilai'		=> 2
			],
			[
				'label'		=> 'Sangat Tidak Puas',
				'nilai'		=> 1
			],
		];

		$arrayLabel = [];
		$arrayPersen = [];
		$string = 'jumlah_';

		$jumlahSoal = $this->db->get_where('tb_pertanyaan', ['jenis_pertanyaan'	=> KODEPELAYANAN])->num_rows();

		$this->db->where('published', '2');
		$this->db->group_by('id_responden');
		$totalResponden = $this->db->select('id_responden')->get('tb_hasil')->num_rows();

		foreach ($label as $l) {
			array_push($arrayLabel, $l['label']);
			$nilai = strval($l['nilai']);
			// array_push($arrayPersen, $l['nilai']);

			$kolom = $string . $nilai;
			$where = [
				'jenis_pertanyaan'		=> KODEPELAYANAN
			];
			$this->db->select('SUM(' . $kolom . ') /' . ($totalResponden * $jumlahSoal) . ' as total');
			$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
			$cek = $this->db->get_where('count_point', $where)->row();

			array_push($arrayPersen, floatval(number_format(floatval($cek->total * 100), 4)));
		}

		echo json_encode([
			'label'		=> $arrayLabel,
			'persen'	=> $arrayPersen,
		]);
	}

	function ajaxPiePend()
	{
		$label = [];
		$data = [];
		$this->db->select('pendidikan,count(pendidikan) as total');
		$this->db->group_by('pendidikan');
		$array = $this->db->get_where('tb_detil_responden', [
			'status'	=> '2',
			'pendidikan !='	=> null
		])->result();
		$total = array_column($array, 'total');
		$totalData = array_sum($total);

		foreach ($array as $a) {
			array_push($label, $a->pendidikan);
			$persen = ($a->total / $totalData) * 100;
			$persen = number_format($persen, 2);
			$persen = floatval($persen);
			array_push($data, $persen);
		}

		echo json_encode(
			[
				'label'		=> $label,
				'data'		=> $data,
			]
		);
	}

	function ajaxPiePek()
	{
		$label = [];
		$data = [];
		$this->db->select('pekerjaan,count(pekerjaan) as total');
		$this->db->group_by('pekerjaan');
		$array = $this->db->get_where('tb_detil_responden', [
			'status'	=> '2',
			'pendidikan !='	=> null
		])->result();
		$total = array_column($array, 'total');
		$totalData = array_sum($total);

		foreach ($array as $a) {
			array_push($label, $a->pekerjaan);
			$persen = ($a->total / $totalData) * 100;
			$persen = number_format($persen, 2);
			$persen = floatval($persen);
			array_push($data, $persen);
		}

		echo json_encode(
			[
				'label'		=> $label,
				'data'		=> $data,
			]
		);
	}

	function ajaxKategori()
	{
		$label = [];
		$data = [];
		$jawaban = 0;
		$where = [
			'jenis_pertanyaan'		=> KODEPELAYANAN
		];
		$this->db->select('kode_soal,sum(jumlah_4) as jumlah_4,sum(jumlah_3) as jumlah_3,sum(jumlah_2) as jumlah_2,sum(jumlah_1) as jumlah_1');
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
		$this->db->group_by('kode_soal');
		$kategori = $this->db->get_where('count_point', $where)->result();
		foreach ($kategori as $var) {
			array_push($label, $var->kode_soal);
			$totalresponden = intval($var->jumlah_4) + intval($var->jumlah_3) + intval($var->jumlah_2) + intval($var->jumlah_1);
			$jawaban 		= intval($var->jumlah_4 * 4) + intval($var->jumlah_3 * 3) + intval($var->jumlah_2 * 2) + intval($var->jumlah_1);
			$persen = $jawaban / $totalresponden;
			$persen = number_format($persen, 2);
			$persen = floatval($persen);
			array_push($data, $persen);
		}

		echo json_encode(
			[
				'label'		=> $label,
				'data'		=> $data,
			]
		);
	}

	function ajaxMutu()
	{
		$where = [
			'jenis_pertanyaan'		=> KODEPELAYANAN
		];
		$this->db->select('kategori,kode_soal,sum(jumlah_4) as jumlah_4,sum(jumlah_3) as jumlah_3,sum(jumlah_2) as jumlah_2,sum(jumlah_1) as jumlah_1');
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
		$this->db->group_by('kode_soal');
		$this->db->order_by('urutan', 'asc');
		$kategori = $this->db->get_where('count_point', $where)->result();
		$html = '';
		foreach ($kategori as $var) {
			$totalresponden = intval($var->jumlah_4) + intval($var->jumlah_3) + intval($var->jumlah_2) + intval($var->jumlah_1);
			$jawaban 		= intval($var->jumlah_4 * 4) + intval($var->jumlah_3 * 3) + intval($var->jumlah_2 * 2) + intval($var->jumlah_1);
			$persen 		= intval($jawaban) / intval($totalresponden);

			if ($persen >= 1 && $persen <= 2.5996) {
				$index = 'D';
			} else if ($persen >= 2.60 && $persen <= 3.064) {
				$index = 'C';
			} else if ($persen >= 3.0644 && $persen < 3.532) {
				$index = 'B';
			} else if ($persen >= 3.5324 && $persen <= 4) {
				$index = 'A';
			} else {
				$index = null;
			}

			$persen = number_format($persen, 2);
			$html .= '<tr class="font-weight-bold">';
			$html .= '<td class="text-center" style="font-weight: bold;">' . $var->kode_soal . '</td>';
			$html .= '<td style="font-weight: bold;">' . $var->kategori . '</td>';
			$html .= '<td class="text-center">' . number_format($var->jumlah_4) . '</td>';
			$html .= '<td class="text-center">' . number_format($var->jumlah_3) . '</td>';
			$html .= '<td class="text-center">' . number_format($var->jumlah_2) . '</td>';
			$html .= '<td class="text-center">' . number_format($var->jumlah_1) . '</td>';
			$html .= '<td class="text-center" style="font-weight: bold;">' . $persen . '</td>';
			$html .= '<td class="text-center" style="font-weight: bold;">' . $index . '</td>';
			$html .= '<tr>';
		}
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode([
				'data' => $html
			]));
	}
}

/* End of file Tema.php */
/* Location: ./application/modules/tema/controllers/Tema.php */
