<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loket extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		if ($this->session->userdata('skm_user') == null) {
			redirect('satpam', 'refresh');
		}
	}

	function index($bulan = null, $tahun = null,  $cetak = null)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');

		$total_responden = $this->_totalResponden($bulan, $tahun);
		$dataLoket = $this->dataLoket($bulan, $tahun, $total_responden);
		$data = [
			'title'				=> 'Monitoring Kepuasan',
			'sub'				=> 'Loket Pelayanan',
			'icon'				=> 'fa-user-circle',
			'menu'				=> 'loket',
			'bulan'				=> $this->M_master->getall('bulan')->result(),
			'tahun'				=> $this->M_master->getall('tahun')->result(),
			'f_bulan'			=> $bulan,
			'f_tahun'			=> $tahun,
			'total_responden' 	=> $total_responden,
			'loket'				=> $dataLoket
		];

		$totalRespondenLoket = array_column($dataLoket, 'jumlah_responden');
		$lain = $total_responden - array_sum($totalRespondenLoket);
		$data['loket_lainnya']	= ($lain > 0) ? $lain : 0;

		if ($cetak != null) {
			$this->load->view('cetakLaporan', $data);
		} else {
			$this->template->load('tema/index', 'loket', $data);
		}
	}

	private function _totalResponden($bulan, $tahun)
	{
		$where = [
			'YEAR(tb_detil_responden.created_date)' 	=> date('Y', strtotime($tahun)),
			'status'									=> '2'
		];
		$this->db->select('COUNT(tb_detil_responden.id_responden) as jumlah_responden');
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(tb_detil_responden.created_date)', $bulan);
		}
		$this->db->join('tb_loket', 'tb_loket.id_loket = tb_detil_responden.loket');
		return $this->db->get_where('tb_detil_responden', $where)->row()->jumlah_responden;
	}

	private function dataLoket($bulan, $tahun, $total_responden)
	{
		$where = [
			'YEAR(tb_detil_responden.created_date)' 	=> date('Y', strtotime($tahun)),
			'status'									=> '2'
		];
		$this->db->select('loket, COUNT(tb_detil_responden.id_responden) as jumlah_responden,nama_loket');
		$this->db->group_by('loket');
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(tb_detil_responden.created_date)', $bulan);
		}
		$this->db->join('tb_loket', 'tb_loket.id_loket = tb_detil_responden.loket');
		$loketDikunjungi = $this->db->get_where('tb_detil_responden', $where)->result();

		$hasil = [];
		foreach ($loketDikunjungi as $l) {
			$hasil[] = [
				'id_loket'				=> $l->loket,
				'jenis_layanan'			=> $l->nama_loket,
				'jumlah_responden'		=> $l->jumlah_responden,
				'persen'				=> ($l->jumlah_responden / $total_responden) * 100,
				'kepuasan'				=> $this->_kepuasanPerLoket($l->jumlah_responden, $l->loket, $bulan, $tahun)
			];
		}
		return $hasil;
	}

	private function _kepuasanPerLoket($jumlah_responden, $id_loket, $bulan, $tahun)
	{
		$totalPertanyaan = $this->db->get_where('tb_pertanyaan', ['jenis_pertanyaan' => KODEPELAYANAN])->num_rows();

		$where = [
			'YEAR(tb_detil_responden.created_date)' 	=> date('Y', strtotime($tahun)),
			'status'									=> '2',
			'loket'										=> $id_loket,
			'jenis_pertanyaan'							=> KODEPELAYANAN
		];
		$this->db->select('sum(jawaban) /' . ($jumlah_responden * 4 * $totalPertanyaan) . ' as nilai');
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(tb_detil_responden.created_date)', $bulan);
		}
		$this->db->join('tb_detil_responden', 'tb_hasil.id_responden = tb_detil_responden.id_responden');
		$this->db->join('tb_loket', 'tb_loket.id_loket = tb_detil_responden.loket');
		$nilai = $this->db->get_where('tb_hasil', $where)->row();
		return $nilai ? floatval($nilai->nilai) * 100 : 0;
	}
}

/* End of file Loket.php */
/* Location: ./application/modules/loket/controllers/Loket.php */