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
}

/* End of file Api.php */
/* Location: ./application/modules/api/controllers/Api.php */