<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
	}

	function index()
	{
		$data = [
			'title'		=> 'Dashboard',
			'sub'		=> '',
			'icon'		=> 'clip-home-3',
			'soal'		=> $this->M_admin->getSoal()->result()
		];
		$this->template->load('tema/index','index',$data);
	} 

	function pertanyaan()
	{
		$data = [
			'title'		=> 'Dashboard',
			'sub'		=> 'overview',
			'icon'		=> 'clip-home-3',
			'soal'		=> $this->M_admin->getSoal()->result()
		];
		$this->template->load('tema/index','pertanyaan',$data);
	}

}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */