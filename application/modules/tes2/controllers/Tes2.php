<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes2 extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_tes2');
	}
	public function index()
	{
		$data['nsoal'] 		= $this->M_tes2->getSoal()->num_rows();
		$data['soal']		= $this->M_tes2->getSoal()->result();
		$data['noreg'] 		= "tes";
			//$this->load->view('proses',$data);
		$this->load->view('index', $data);
	}

	function get_soal($param)
	{
		$data	= $this->M_tes2->getSoal()->result();
		
		echo json_encode($data[$param]);
	}

	function getSoalCount()
	{
		$data	= $this->M_tes2->getSoal()->num_rows();
		echo json_encode($data);
	}

}

/* End of file Tes2.php */
/* Location: ./application/modules/tes2/controllers/Tes2.php */