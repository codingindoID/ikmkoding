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

		// totalResponsen
		if ($bulan == 'setahun') {
			$query2 = "SELECT * FROM tb_hasil JOIN tb_detil_responden ON tb_detil_responden.id_responden = tb_hasil.id_responden  WHERE YEAR ( tb_hasil.created_date ) = '$tahun' AND published = '2'";
		} else {
			$query2 = "SELECT * FROM tb_hasil JOIN tb_detil_responden ON tb_detil_responden.id_responden = tb_hasil.id_responden  WHERE YEAR ( tb_hasil.created_date ) = '$tahun' and MONTH(tb_hasil.created_date) = '$bulan'  AND published = '2'";
		}
		$allResponden = $this->db->query($query2)->result();

		$totalResponden = $this->M_loket->total_responden($allResponden);
		$repondenLoket 	= $this->M_loket->repondenLoket($allResponden, $totalResponden);

		$totalrepondenLoket = array_column($repondenLoket, 'jumlah_responden');

		$data = [
			'title'				=> 'Monitoring Kepuasan',
			'sub'				=> 'Loket Pelayanan',
			'icon'				=> 'fa-user-circle',
			'menu'				=> 'loket',
			'total_responden' 	=> $totalResponden,
			'loket'				=> $repondenLoket,
			'loket_lainnya'		=> $totalResponden - array_sum($totalrepondenLoket),
			'f_bulan'			=> $bulan,
			'f_tahun'			=> $tahun,
			'bulan'				=> $this->M_master->getall('bulan')->result(),
			'tahun'				=> $this->M_master->getall('tahun')->result(),
		];
		if ($cetak != null) {
			$this->load->view('cetakLaporan', $data);
		} else {
			$this->template->load('tema/index', 'loket', $data);
		}
	}
}

/* End of file Loket.php */
/* Location: ./application/modules/loket/controllers/Loket.php */