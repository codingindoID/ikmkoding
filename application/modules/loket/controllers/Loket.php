<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loket extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_loket');
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam', 'refresh');
		}
	}

	function index($bulan = null, $tahun = null, $cetak = null)
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
		$dataKepuasanLoket = $this->M_loket->dataPerloket($responden);
		// totalResponsen
		$data = [
			'title'				=> 'Monitoring Kepuasan',
			'sub'				=> 'Loket Pelayanan',
			'icon'				=> 'fa-user-circle',
			'menu'				=> 'loket',
			'bulan'				=> $this->M_master->getall('bulan')->result(),
			'tahun'				=> $this->M_master->getall('tahun')->result(),
			'f_bulan'			=> $bulan,
			'f_tahun'			=> $tahun,
			'total_responden' 	=> count($this->M_loket->_arrayResponden($responden)),
			'loket'				=> $dataKepuasanLoket
		];

		$totalRespondenLoket = array_column($dataKepuasanLoket, 'jumlah_responden');
		$lain = count($this->M_loket->_arrayResponden($responden)) - array_sum($totalRespondenLoket);
		$data['loket_lainnya']	= ($lain > 0) ? $lain : 0;

		if ($cetak != null) {
			$this->load->view('cetakLaporan', $data);
		} else {
			$this->template->load('tema/index', 'loket', $data);
		}
	}
}

/* End of file Loket.php */
/* Location: ./application/modules/loket/controllers/Loket.php */