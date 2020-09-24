<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_survey');
	}
	public function index()
	{
		$this->load->view('index');
	}

	public function pertanyaan()
	{
		$responden		= $this->input->post('noreg');
		$cek 			= $this->M_survey->cekResponden(['id_responden' => $responden])->row();
		
		if ($cek) {
			$this->session->set_flashdata('error', 'responden sudah pernah berpartisipasi');
			redirect('survey/index','refresh');
		}else{
			$data['nsoal'] 		= $this->M_survey->getSoal()->num_rows();
			$data['soal']		= $this->M_survey->getSoal()->result();
			$data['noreg'] 		= $responden;
			
			//echo json_encode($data);
			$this->load->view('quest', $data);
		}
		
	}

	function get_soal($param)
	{
		$data	= $this->M_survey->getSoal()->result();
		
		echo json_encode($data[$param]);
	}

	function getSoalCount()
	{
		$data	= $this->M_survey->getSoal()->num_rows();
		echo json_encode($data);
	}

	function jawaban()
	{
		$data = [
			'id_kuis'		=>uniqid(12),
			'id_responden'	=> $this->input->post('id_responden'),
			'id_soal'		=> $this->input->post('id_soal'),
			'jawaban'		=> $this->input->post('jawaban')
		];

		$cek 	= $this->M_survey->save($data);
		if(!$cek){
			echo json_encode(array(
				'hasil' => 'berhasil'
			));
		} 
		else {
			echo json_encode(array(
				'hasil' => 'gagal'
			));
		}
	}

	/*admin page*/
	function admin()
	{
		$this->load->view('sesi/header');
		$this->load->view('admin/auth');
		$this->load->view('sesi/script');
	}	

	function auth()
	{
		$data = [
			'username'		=> $this->input->post('username') ,
			'password'		=> md5($this->input->post('password')),
		];

		$cek = $this->M_survey->auth($data)->num_rows();
		if($cek>= 1){
			$user = $this->M_survey->auth($data)->row();
			$this->session->set_userdata('ses_user',$user->username);
			$this->session->set_userdata('ses_id',$user->id_admin);
			redirect('survey','refresh');
		}
		else{
			$this->session->set_flashdata('error', 'username atau password salah');
			redirect('survey/admin','refresh');
		}
	}


	function errorpage()
	{
		$this->load->view('404');
	}

}

/* End of file Tema.php */
/* Location: ./application/modules/tema/controllers/Tema.php */