<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_admin');
		//cek session
		if ($this->session->userdata('ses_id') == null) {
			redirect('survey/admin', 'refresh');
		}
	}

	/* filter */

	/*FILTER*/
	function index($bulan = null, $tahun = null)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');

		//responden
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '2');
		$responden = $this->db->get('tb_hasil')->result();

		$data = [
			'title'			=> 'Dashboard',
			'menu'			=> 'Dashboard',
			'sub'			=> '',
			'tahun'			=> $this->M_master->getall('tahun')->result(),
			'bulan'			=> $this->M_master->getall('bulan')->result(),
			'icon'			=> 'clip-home-3',
			'f_bulan'		=> $bulan,
			'f_tahun'		=> $tahun,
			'kepuasan' 		=> $this->M_admin->_get_kepuasan_filter($responden),
			'b_publish'		=> $this->M_admin->get_blm_publish($bulan, $tahun),
			'pendidikan'	=> $this->M_admin->_get_pendidikan_filter($responden),
			'pekerjaan'		=> $this->M_admin->_get_pekerjaan_filter($responden),
			'hasil'			=> $this->M_admin->grafik($responden)
		];
		//menentukan tingkat kepuasan
		$kepuasan = $data['kepuasan'];
		if ($kepuasan > 88.31) {
			$mutu = 'A';
			$index = "Sangat Baik";
		} else if ($kepuasan > 76.61) {
			$mutu = 'B';
			$index = 'Baik';
		} else if ($kepuasan > 65.00) {
			$mutu = 'C';
			$index = 'Kurang Baik';
		} else if ($kepuasan > 25.00) {
			$mutu = 'D';
			$index = 'Tidak Baik';
		} else {
			$mutu = null;
			$index = null;
		}
		$data['tingkat_kepuasan']	= $index;
		$data['mutu'] 				= $mutu;
		$data['rekap']				= $this->M_admin->urutkanHasil($this->M_admin->rekapKepuasanPersoal($responden));
		// echo json_encode($data);
		$this->template->load('tema/index', 'index', $data);
	}

	function cetaklaporan($bulan = null, $tahun = null)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');

		//responden
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '2');
		$pengunjung = $this->db->get('tb_hasil')->result();
		$kepuasan = $this->M_admin->rekapKepuasanPersoal($pengunjung);

		$data = [
			'tgl_indo'		=> $this->M_master->tglindo($bulan),
			'tahun'			=> $tahun,
			'pengunjung'	=> count($this->M_admin->_arrayResponden($pengunjung)),
			'umur'			=> $this->M_admin->arrayUmur($pengunjung),
			'jk'			=> $this->M_admin->arrayJk($pengunjung),
			'hasil' 		=> $kepuasan,
			'min' 			=> min($kepuasan),
			'max'			=> max($kepuasan),
			'prioritas'		=> $this->M_admin->urutkanHasil($kepuasan)
		];

		//Index Kepuasan
		$kepuasan = $this->M_admin->_get_kepuasan_filter($pengunjung);
		if ($kepuasan > 88.31) {
			$mutu = 'A';
			$index = "Sangat Baik";
		} else if ($kepuasan > 76.61) {
			$mutu = 'B';
			$index = 'Baik';
		} else if ($kepuasan > 65.00) {
			$mutu = 'C';
			$index = 'Kurang Baik';
		} else if ($kepuasan > 25.00) {
			$mutu = 'D';
			$index = 'Tidak Baik';
		} else {
			$mutu = null;
		}
		$data['tingkat_kepuasan'] = [
			'index'			=> $index,
			'mutu'			=> $mutu,
			'presentase'	=> $kepuasan
		];
		// echo json_encode($data);
		$this->load->view('cetak/cetak_laporan', $data);
	}

	function prioritas($hasil)
	{
		usort($hasil, function ($a, $b) {
			return $a['kepuasan'] <=> $b['kepuasan'];
		});
		return $hasil;
	}

	/*PERTANYAAN*/
	function pertanyaan()
	{
		$data = [
			'title'		=> 'Dashboard',
			'sub'		=> 'overview',
			'icon'		=> 'clip-home-3',
			'soal'		=> $this->db->get('tb_pertanyaan')->result(),
			'menu'		=> 'pertanyaan'
		];
		$this->template->load('tema/index', 'pertanyaan', $data);
	}

	function detilpertanyaan($id)
	{
		$data = $this->M_master->getWhere('tb_pertanyaan', ['id_soal' => $id])->row();
		echo json_encode($data);
	}

	function addpertanyaan()
	{

		$data = [
			'soal'		=> $this->input->post('pertanyaan'),
			'kategori'	=> $this->input->post('kategori'),
			'a'			=> $this->input->post('a'),
			'b'			=> $this->input->post('b'),
			'c'			=> $this->input->post('c'),
			'd'			=> $this->input->post('d'),
			'id_soal' 	=> $this->input->post('id_soal')
		];

		$cek = $this->M_master->getWhere('tb_pertanyaan', ['id_soal' => $this->input->post('id_soal')])->num_rows();
		if ($cek > 0) {
			$this->session->set_flashdata('error', 'Nomor Pertanyaan Sudah Terdaftar, Silahkan Ganti Nomor atau Edit Nomor Pertanyaan Yang Sudah Ada...');
			redirect('admin/pertanyaan', 'refresh');
		} else {
			$cek = $this->M_master->input('tb_pertanyaan', $data);
			if (!$cek) {
				$this->session->set_flashdata('success', 'Data Updated');
				redirect('admin/pertanyaan', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Error...');
				redirect('admin/pertanyaan', 'refresh');
			}
		}
	}

	function updatepertanyaan()
	{

		$where = ['id_soal' => $this->input->post('id_soal')];
		$data = [
			'soal'		=> $this->input->post('pertanyaan'),
			'kategori'	=> $this->input->post('kategori'),
			'a'			=> $this->input->post('a'),
			'b'			=> $this->input->post('b'),
			'c'			=> $this->input->post('c'),
			'd'			=> $this->input->post('d')
		];
		$cek = $this->M_master->update('tb_pertanyaan', $where, $data);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data inserted');
			redirect('admin/pertanyaan', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/pertanyaan', 'refresh');
		}
	}

	function hapuspertanyaan($id)
	{

		$cek = $this->M_master->delete('tb_pertanyaan', ['id_soal' => $id]);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data Deleted');
			redirect('admin/pertanyaan', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/pertanyaan', 'refresh');
		}
	}

	/*SARAN*/
	function saran()
	{

		$data = [
			'title'			=> 'Kritik Dan Saran',
			'sub'			=> '',
			'icon'			=> 'clip-file',
			'rekap'			=> $this->M_admin->getSaran()->result(),
			'menu'			=> 'saran'
		];
		$this->template->load('tema/index', 'saran', $data);
	}

	function tanggapisaran($id)
	{

		$cek = $this->M_master->update('tb_saran', ['id_responden' => $id], ['status' => '2']);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data Updated');
			redirect('admin/saran', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/saran', 'refresh');
		}
	}

	/*publish*/
	function publish()
	{
		$this->db->where('YEAR(created_date)', date('Y'));
		$this->db->where('published', '1');
		$responden = $this->db->get('tb_hasil')->result();
		$data = [
			'title'			=> 'Survey',
			'sub'			=> 'pre publish',
			'icon'			=> 'fa-share',
			'rekap'			=> $this->M_admin->belumPublish($responden),
			'menu'			=> 'publish'
		];
		// echo json_encode($data);
		$this->template->load('tema/index', 'publish', $data);
	}

	function detil($id_responden)
	{

		$data = [
			'title'			=> 'Survey',
			'sub'			=> 'pre publish',
			'icon'			=> 'fa-share',
			'rekap'			=> $this->M_admin->getdetil($id_responden),
			'menu'			=> 'publish'
		];
		$this->template->load('tema/index', 'detil', $data);
		//echo json_encode($data);
	}

	function aksipublish($id)
	{

		$where = ['id_responden' => $id];
		$this->db->where($where);
		$this->db->update('tb_hasil', ['published' => '2']);
		redirect('admin', 'refresh');
	}

	function log_out()
	{
		session_destroy();
		redirect('survey', 'refresh');
	}

	// cetak
	function cetakrekap($bulan = null, $tahun = null)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');
		//hasilnya untuk index kepuasan per soal
		//responden
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '2');
		$this->db->order_by('jawaban', 'asc');
		$responden = $this->db->get('tb_hasil')->result();
		$data = [
			'rekap'		=> $this->M_admin->urutkanHasil($this->M_admin->rekapKepuasanPersoal($responden)),
			'bulan'		=> $bulan,
			'tahun'		=> $tahun,
		];
		// echo json_encode($data);
		$this->load->view('cetak/cetak1', $data);
	}

	function cetakrekapdetil($bulan, $tahun)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');

		//responden
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '2');
		$res = $this->db->get('tb_hasil')->result();

		$data = [
			'soal'		=> $this->db->get('tb_pertanyaan')->result(),
			'bulan'		=> $this->M_master->tglindo($bulan),
			'tahun'		=> $tahun,
			'rekap'		=> $this->M_admin->cetakrekapdetil($res)
		];
		$this->load->view('cetak/cetakrekapdetil', $data);
	}

	//import
	function import()
	{
		$data = [
			'title'			=> 'Import',
			'sub'			=> '',
			'menu'			=> 'import',
			'icon'			=> 'upload',
		];

		$this->template->load('tema/index', 'import', $data);
	}

	function importData()
	{
		$cek = $this->M_admin->importData();
		// echo json_encode($cek);
		// die();
		$this->session->set_flashdata($cek['kode'], $cek['msg']);
		redirect('admin', 'refresh');
	}
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */