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
		if ($this->session->userdata('skm_id') == null) {
			redirect('survey', 'refresh');
		}
	}

	function index($bulan = null, $tahun = null)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');
		$data = [
			'title'			=> 'Dashboard',
			'menu'			=> 'Dashboard',
			'sub'			=> '',
			'tahun'			=> $this->M_master->getall('tahun')->result(),
			'bulan'			=> $this->M_master->getall('bulan')->result(),
			'icon'			=> 'clip-home-3',
			'f_bulan'		=> $bulan,
			'f_tahun'		=> $tahun,
		];
		$this->template->load('tema/index', 'index', $data);
	}

	/*PERTANYAAN*/
	function pertanyaan()
	{
		$data = [
			'title'		=> 'Dashboard',
			'sub'		=> 'overview',
			'icon'		=> 'clip-home-3',
			'jenis'		=> $this->db->get('jenis_pertanyaan')->result(),
			'soal'		=> $this->db->join('jenis_pertanyaan', 'jenis_pertanyaan.id_jenispertanyaan=tb_pertanyaan.jenis_pertanyaan')->order_by('jenis_pertanyaan', 'asc')->get('tb_pertanyaan')->result(),
			'menu'		=> 'pertanyaan'
		];
		$this->template->load('tema/index', 'pertanyaan', $data);
	}

	function detilpertanyaan($id)
	{
		$data = $this->M_master->getWhere('tb_pertanyaan', ['id_soal' => $id])->row();
		echo json_encode($data);
	}

	function simpanPertanyaan()
	{
		$id_soal = $this->input->post('id_soal');
		$data = [
			'jenis_pertanyaan'	=> $this->input->post('jenis_pertanyaan'),
			'kategori'			=> $this->input->post('kategori'),
			'kode_soal'			=> $this->input->post('kode_soal'),
			'soal'				=> $this->input->post('soal'),
		];

		if ($id_soal) {
			$this->db->where(['id_soal'	=> $id_soal]);
			$this->db->update('tb_pertanyaan', $data);
		} else {
			$this->db->insert('tb_pertanyaan', $data);
		}
		$this->session->set_flashdata('success', 'Data berhasil disimpan');
		redirect('admin/pertanyaan', 'refresh');
	}

	function hapuspertanyaan($id)
	{
		$this->M_master->delete('tb_pertanyaan', ['id_soal' => $id]);
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect('admin/pertanyaan', 'refresh');
	}

	/*SARAN*/
	function saran()
	{
		$data = [
			'title'			=> 'Kritik Dan Saran',
			'sub'			=> '',
			'icon'			=> 'clip-file',
			'rekap'			=> $this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_saran.id_responden')->get_where('tb_saran', ['tb_saran.status' => '1'])->result(),
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
	function publish($bulan = null, $tahun = null)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun  ? $tahun : date('Y');
		$unsur = $this->input->get('unsur');
		$unsur = $unsur ? $unsur : KODEPELAYANAN;
		$data = [
			'title'			=> 'Survey',
			'sub'			=> 'pre publish',
			'icon'			=> 'fa-share',
			'unsur'			=> $unsur,
			'tahun'			=> $this->M_master->getall('tahun')->result(),
			'bulan'			=> $this->M_master->getall('bulan')->result(),
			'total_soal'	=> $this->db->get_where('tb_pertanyaan', ['jenis_pertanyaan'	=> $unsur])->num_rows(),
			'f_bulan'		=> $bulan,
			'f_tahun'		=> $tahun,
			'rekap'			=> $this->M_admin->belumPublish($bulan, $tahun, $unsur),
			'menu'			=> 'publish'
		];
		// echo json_encode($data);
		$this->template->load('tema/index', 'publish', $data);
	}

	function detil($id_responden, $unsur)
	{
		$data = [
			'title'			=> 'Survey',
			'sub'			=> 'pre publish',
			'icon'			=> 'fa-share',
			'rekap'			=> $this->M_admin->getdetil($id_responden, $unsur),
			'menu'			=> 'publish'
		];
		$this->template->load('tema/index', 'detil', $data);
	}

	function aksipublish($id_responden, $jenisPertanyaan)
	{
		$cek = $this->M_admin->aksipublish($id_responden, $jenisPertanyaan);
		$this->session->set_flashdata($cek['kode'], $cek['msg']);
		redirect('admin/publish/?unsur=' . $cek['jenis'], 'refresh');
	}

	function log_out()
	{
		session_destroy();
		redirect('survey', 'refresh');
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

	/* UPDATE 2024 */
	function ajaxCount()
	{
		$data = $this->M_admin->ajaxCount();
		echo json_encode($data);
	}

	function ajaxTableMutu()
	{
		$data = $this->M_admin->ajaxTableMutu();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode([
				'data' => $data
			]));
	}

	function ajaxPiePekerjaan()
	{
		$data = $this->M_admin->ajaxPiePekerjaan();
		echo json_encode($data);
	}

	function ajaxPiePendidikan()
	{
		$data = $this->M_admin->ajaxPiePendidikan();
		echo json_encode($data);
	}

	function ajaxPiePilihan()
	{
		$data = $this->M_admin->ajaxPiePilihan();
		echo json_encode($data);
	}

	function ajaxColumnPilihan()
	{
		$data = $this->M_admin->ajaxColumnPilihan();
		echo json_encode($data);
	}

	// cetak
	function exportData($bulan = null, $tahun = null)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');
		$this->M_admin->exportData($bulan, $tahun);
	}

	function exportDataDetail($bulan, $tahun, $jenis = '1')
	{
		$jenis = $jenis ? $jenis : '1';
		$this->M_admin->exportDataDetail($bulan, $tahun, $jenis);
	}

	function cetaklaporan($bulan = null, $tahun = null, $jenis = '1')
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');
		$this->M_admin->cetaklaporan($bulan, $tahun, $jenis);
	}

	/* HELPER untuk migrasi data */
	function formAutomate()
	{
		$data = [
			'title'			=> 'Form',
			'menu'			=> 'automate',
			'sub'			=> '',
			'jenis'			=> 'countHasil',
			'icon'			=> 'clip-home-3',
			'tahun'			=> $this->M_master->getall('tahun')->result(),
		];
		$this->template->load('tema/index', 'form-automate', $data);
	}

	function helperAuto()
	{
		if ($this->session->userdata('skm_level') != LEVELSUPER) {
			redirect('survey', 'refresh');
		}
		$tahun = $this->input->post('tahun');
		$hasil = [];
		$arr = ['12', '11', '10', '09', '08', '07', '06', '05', '04', '03', '02', '01'];
		$pertanyaan = $this->db->get_where('tb_pertanyaan', ['jenis_pertanyaan'	=> KODEPELAYANAN])->result();

		foreach ($arr as $bl) {
			foreach ($pertanyaan as $id) {
				$this->db->select('COUNT(id_responden) as total');
				$this->db->group_by('id_soal');
				$d = $this->db->get_where('tb_hasil', [
					'published'				=> '2',
					'MONTH(created_date)'	=> $bl,
					'id_soal'				=> $id->id_soal,
					'jawaban'				=> 4,
					'YEAR(created_date)'	=> $tahun
				])->row();

				$this->db->select('COUNT(id_responden) as total');
				$this->db->group_by('id_soal');
				$c = $this->db->get_where('tb_hasil', [
					'published'				=> '2',
					'MONTH(created_date)'	=> $bl,
					'id_soal'				=> $id->id_soal,
					'jawaban'				=> 3,
					'YEAR(created_date)'	=> $tahun
				])->row();

				$this->db->select('COUNT(id_responden) as total');
				$this->db->group_by('id_soal');
				$b = $this->db->get_where('tb_hasil', [
					'published'				=> '2',
					'MONTH(created_date)'	=> $bl,
					'id_soal'				=> $id->id_soal,
					'jawaban'				=> 2,
					'YEAR(created_date)'	=> $tahun
				])->row();

				$this->db->select('COUNT(id_responden) as total');
				$this->db->group_by('id_soal');
				$a = $this->db->get_where('tb_hasil', [
					'published'				=> '2',
					'MONTH(created_date)'	=> $bl,
					'id_soal'				=> $id->id_soal,
					'jawaban'				=> 1,
					'YEAR(created_date)'	=> $tahun
				])->row();

				$hasil[]  = [
					'id_soal'		=> $id->id_soal,
					'jumlah_4'		=> $d ? $d->total : null,
					'jumlah_3'		=> $c ? $c->total : null,
					'jumlah_2'		=> $b ? $b->total : null,
					'jumlah_1'		=> $a ? $a->total : null,
					'tahun_isi'		=> $tahun,
					'bulan_isi'		=> $bl
				];
				$this->db->where([
					'tahun_isi'		=> $tahun,
					'bulan_isi'		=> $bl
				]);
				$this->db->delete('count_point');
			}
		}
		$this->db->insert_batch('count_point', $hasil);

		$this->session->set_flashdata('success', 'automate count hasil success');
		redirect('admin', 'refresh');
	}

	function formAutomateHasil()
	{
		$data = [
			'title'			=> 'Form',
			'menu'			=> 'automate',
			'sub'			=> '',
			'jenis'			=> 'rekapHasil',
			'icon'			=> 'clip-home-3',
			'tahun'			=> $this->M_master->getall('tahun')->result(),
		];
		$this->template->load('tema/index', 'form-automate', $data);
	}

	function helperRekapHasil()
	{
		if ($this->session->userdata('skm_level') != LEVELSUPER) {
			redirect('survey', 'refresh');
		}
		$tahun = $this->input->post('tahun');
		/* UPDATE REKAP HASIL JENIS PELAYANAN */
		$this->db->select('id_responden,jenis_pertanyaan,created_date');
		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '2');
		$this->db->order_by('id_responden', 'asc');
		$this->db->group_by('id_responden');
		$data = $this->db->get('tb_hasil')->result();
		$hasil = [];
		foreach ($data as $d) {
			/* UPDATE REKAP HASIL JENIS PELAYANAN */
			$this->db->where('jenis_pertanyaan', $d->jenis_pertanyaan);
			$this->db->where('id_responden', $d->id_responden);
			$jawaban = $this->db->get('tb_hasil')->result();
			$jawabanPelayanan = [];
			foreach ($jawaban as $h) {
				array_push($jawabanPelayanan, $h->jawaban);
			}
			$hasil[] = [
				'id_responden'			=> $d->id_responden,
				'jenis_pertanyaan'		=> $d->jenis_pertanyaan,
				'created_date'			=> $d->created_date,
				'jawaban'				=> json_encode($jawabanPelayanan),
			];

			/* clear data dulu */
			$this->db->where('id_responden', $d->id_responden);
			$this->db->where('jenis_pertanyaan', $d->jenis_pertanyaan);
			$this->db->delete('rekap_hasil');
		}
		$this->db->insert_batch('rekap_hasil', $hasil);
		$this->session->set_flashdata('success', 'automate rekap hasil success');
		redirect('admin', 'refresh');
	}
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */