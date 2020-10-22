<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_survey');
		$this->load->model('M_master');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$this->_auto_reset();
		$data = [
			'kepuasan' 		=> $this->_get_kepuasan(),
			'pengunjung' 	=> $this->M_survey->get_responden(),
			'hasil'			=>  $this->_get_hasil()
		];

		$soal = $this->M_master->getall('tb_pertanyaan')->result();
		$hasil = array();
		$no = 1;
		foreach ($soal as $v) {
			$hasil[$no] = [
				'id_soal'	=> $v->id_soal,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'kepuasan'	=> $this->_get_nilai($v->id_soal)
			];
			$no++;
		}
		$data['rekap'] = $hasil;
		$this->load->view('index',$data);
		//echo json_encode($data);
	}

	public function cek_user()
	{
		$responden		= $this->input->post('noreg');
		$cek = $this->M_master->getWhere('tb_hasil',['id_responden' => $responden])->num_rows();
		if ($cek > 0) {
			echo "<script>alert('responden Sudah Pernah Mengisi.,.')</script>";
			redirect('survey','refresh');
		}
		else
		{
			$this->pertanyaan($responden);
		}
	}

	private function _get_hasil()
	{
		$sangat_puas 	= $this->M_master->getWhere('tb_hasil',['jawaban' => 'd'])->num_rows();
		$puas 		 	= $this->M_master->getWhere('tb_hasil',['jawaban' => 'c'])->num_rows();
		$tidak_puas 	= $this->M_master->getWhere('tb_hasil',['jawaban' => 'b'])->num_rows();
		$kecewa 		= $this->M_master->getWhere('tb_hasil',['jawaban' => 'a'])->num_rows();

		$all = $sangat_puas+$puas+$tidak_puas+$kecewa;

		if($all != 0)
		{
			$data = [
				[
					'name' 	=> 'sangat_puas',
					'y'		=> intval(number_format(($sangat_puas/$all)*100,2)),
					'color' => '#00FF00'
				],
				[
					'name' 	=> 'puas',
					'y'		=> intval(number_format(($puas/$all)*100,2)),
					'color' => 'blue'
				],
				[
					'name' 	=> 'tidak_puas',
					'y'		=> intval(number_format(($tidak_puas/$all)*100,2)),
					'color' => 'purple'
				],
				[
					'name' 	=> 'kecewa',
					'y'		=> intval(number_format(($kecewa/$all)*100,2)),
					'color' => 'red'
				]
			];
			return $data;
		}
		else
		{
			return null;
		}

		
	}

	private function _get_kepuasan()
	{
		$total = $this->M_master->getall('tb_hasil')->num_rows();
		$soal = $this->M_master->getall('tb_pertanyaan')->num_rows();
		$total_responden = $this->M_survey->get_responden();
		$a = $this->M_master->getWhere('tb_hasil',['jawaban' => 'a'])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil',['jawaban' => 'b'])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil',['jawaban' => 'c'])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil',['jawaban' => 'd'])->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($total_responden*4*$soal);
			return number_format(($kepuasan*100),2);
		}

		return 0;
		
		
	}

	private function _get_nilai($id)
	{
		$total = $this->M_master->getall('tb_hasil')->num_rows();
		$soal = $this->M_master->getall('tb_pertanyaan')->num_rows();
		$total_responden = $this->M_survey->get_responden();
		$a = $this->M_master->getWhere('tb_hasil',['jawaban' => 'a','id_soal' => $id])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil',['jawaban' => 'b','id_soal' => $id])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil',['jawaban' => 'c','id_soal' => $id])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil',['jawaban' => 'd','id_soal' => $id])->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($total_responden*4);
			return number_format(($kepuasan*100),2);
		}
		return 0;
		
	}

	public function pertanyaan($responden)
	{
		//$responden		= $this->input->post('noreg');
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

		$cek 	= $this->M_survey->save('jawaban_sementara',$data);
		if($cek){
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

	function upload_jawaban($id)
	{
		$jawaban = $this->M_master->getWhere('jawaban_sementara',['id_responden' => $id])->result();
		
		$cek 	= $this->M_survey->save_batch($jawaban);
		if($cek){
			$this->M_master->delete('jawaban_sementara',['id_responden' => $id]);
			redirect('survey','refresh');
		} 
		else {
			echo json_encode(array(
				'hasil' => 'gagal'
			));
		}
	}

	function reset($id)
	{
		$cek 	= $this->M_master->delete('jawaban_sementara',['id_responden' => $id]);
		redirect('survey','refresh');
	}

	private function _auto_reset()
	{
/*		$where = [
			'HOUR(created_date) < ' => date('H'),
			'or DAY(created_date)'  => date('d')
		];*/
		$this->db->where('HOUR(created_date) < ', date('H'));
		$this->db->or_where('DAY(created_date) ', date('d'));
		$this->db->delete('jawaban_sementara');
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