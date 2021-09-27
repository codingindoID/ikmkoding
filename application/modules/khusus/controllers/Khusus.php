<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khusus extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_khusus');
	}

	function index()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$responden = $this->M_khusus->get_rekap_hasil()->result();

		$hasil = array();
		$no = 1;
		foreach ($responden as $h) {
			$hasil[$no]	= [
				'id_responden'	=> $h->id_responden,
				'rata'			=> $this->_get_rataan_hasil($h->id_responden),
				'tanggal'		=> $this->M_khusus->get_tanggal_responden($h->id_responden),
			];
			$no++;
		}

		$data = [
			'title'			=> 'Survey',
			'sub'			=> 'pre publish',
			'icon'			=> 'fa-share',
			'rekap'			=> $hasil,
			'menu'			=> ''
		];
		//echo json_encode($data);
		$this->template->load('tema/index','rekap_jawaban',$data);
	}

	function cetak_kuisioner($id_responden)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'responden'		=> $this->M_khusus->getdetilresponden($id_responden),
			'jawaban'		=> $this->M_khusus->get_kuisioner($id_responden),
			'saran'			=> $this->M_master->getWhere('tb_saran',['id_responden' => $id_responden])->row()
		];

		$this->load->view('cetak/cetak_satuan', $data);
	}

	private function _get_rataan_hasil($id_responden)
	{
		$soal = $this->M_master->getall('tb_pertanyaan_14')->num_rows();
		$a = $this->M_master->getWhere('tb_hasil_14',['published' => '2','jawaban' => 'a','id_responden' => $id_responden])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil_14',['published' => '2','jawaban' => 'b','id_responden' => $id_responden])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil_14',['published' => '2','jawaban' => 'c','id_responden' => $id_responden])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil_14',['published' => '2','jawaban' => 'd','id_responden' => $id_responden])->num_rows();

		$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($soal);
		return number_format($kepuasan,2);
	}

	function detil($id_responden)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'title'			=> 'Survey',
			'sub'			=> 'pre publish',
			'icon'			=> 'fa-share',
			'rekap'			=> $this->M_khusus->getdetil($id_responden),
			'menu'			=> 'publish'
		];
		$this->template->load('tema/index','detil',$data);
		//echo json_encode($data);
	}

}

/* End of file Khusus.php */
/* Location: ./application/modules/khusus/controllers/Khusus.php */