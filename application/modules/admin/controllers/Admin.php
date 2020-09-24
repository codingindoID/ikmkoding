<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function dashboard()
	{
		$data = [
			'title'		=> 'Dashboard',
			'sub'		=> 'overview',
			'icon'		=> 'clip-home-3'
		];
		$this->template->load('tema/index','pertanyaan',$data);
	}

}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */