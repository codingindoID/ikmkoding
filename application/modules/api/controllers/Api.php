<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_api');
	}


	public function indexKepuasan()
	{
		$data = $this->M_api->indexKepuasan();
		echo json_encode($data);
	}

	function apiPerijinan()
	{	
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$base = "http://localhost/perijinan_v2/";
		//$base = "https://atompp.jepara.go.id/";
		$path = $base."api/totalPerijinan/".$username.'/'.$password;
		$data = file_get_contents($path, false, stream_context_create($arrContextOptions));
		$data = json_decode($data);

		$res = [
			'index_kepuasan_SKM'	=> $this->indexKepuasan(),
			'perijinan'				=> $data
		];

		echo json_encode($res);
	}
}

/* End of file Api.php */
/* Location: ./application/modules/api/controllers/Api.php */