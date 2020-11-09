<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_admin');

		date_default_timezone_set("Asia/Bangkok");

		//cek session
		if ($this->session->userdata('ses_id') == null) {
			redirect('survey/admin','refresh');
		}
	}

	function index()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'title'			=> 'Dashboard',
			'sub'			=> '',
			'icon'			=> 'clip-home-3',
			'soal'			=> $this->M_admin->getSoal()->result(),
			'kepuasan' 		=> $this->_get_kepuasan(),
			'pendidikan'	=> $this->_get_pendidikan(),
			'pekerjaan'		=> $this->_get_pekerjaan(),
			'pengunjung' 	=> $this->M_master->get_responden(),
			'hasil'			=> $this->_get_hasil(),
			'responden'		=> $this->M_master->get_responden(),
			's_publish'		=> $this->M_master->getWhere('tb_hasil',['published' => '2'])->num_rows(),
			'b_publish'		=> $this->M_master->getWhere('tb_hasil',['published' => '1'])->num_rows()
		];

		//menentukan tingkat kepuasan
		$kepuasan = $data['kepuasan'];
		if ($kepuasan >88.31){
			$mutu = 'A';
			$index = "Sangat Baik";
		}else if($kepuasan > 76.61){
			$mutu = 'B';
			$index = 'Baik';
		}else if($kepuasan > 65.00){
			$mutu = 'C';
			$index = 'Kurang Baik';
		}
		else if($kepuasan > 25.00 ) {
			$mutu = 'D';
			$index = 'Tidak Baik';
		}
		else {
			$mutu = null;
		}
		$data['tingkat_kepuasan']	= $index;
		$data['mutu'] 				= $mutu;


		//hasilnya untuk index kepuasan per soal
		$soal = $this->M_master->getall('tb_pertanyaan')->result();
		$hasil = array();
		$no = 1;
		foreach ($soal as $v) {
			$hasil[$no] = [
				'kepuasan'	=> $this->_get_nilai($v->id_soal),
				'id_soal'	=> $v->id_soal,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'sp'		=> $this->_get_rataan($v->id_soal,'d'),
				'p'			=> $this->_get_rataan($v->id_soal,'c'),
				'tp'		=> $this->_get_rataan($v->id_soal,'b'),
				'kec'		=> $this->_get_rataan($v->id_soal,'a'),
			];
			$no++;
		}
		sort($hasil);

		$data_short = $this->_get_prioritas($hasil);
		sort($data_short);
		$data['rekap'] 	= $data_short;
		//echo json_encode($data['rekap']);
		$this->template->load('tema/index','index',$data);
	} 

	/*PERTANYAAN*/
	function pertanyaan()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'title'		=> 'Dashboard',
			'sub'		=> 'overview',
			'icon'		=> 'clip-home-3',
			'soal'		=> $this->M_admin->getSoal()->result()
		];
		$this->template->load('tema/index','pertanyaan',$data);
	}

	function detilpertanyaan($id)
	{
		$data = $this->M_master->getWhere('tb_pertanyaan',['id_soal' => $id])->row();
		echo json_encode($data);
	}

	function addpertanyaan()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'soal'		=> $this->input->post('pertanyaan'),
			'kategori'	=> $this->input->post('kategori'),
			'a'			=> $this->input->post('a'),
			'b'			=> $this->input->post('b'),
			'c'			=> $this->input->post('c'),
			'd'			=> $this->input->post('d'),
			'id_soal' 	=> $this->input->post('id_soal')
		];

		$cek = $this->M_master->getWhere('tb_pertanyaan',['id_soal' => $this->input->post('id_soal')])->num_rows();
		if ($cek > 0) {
			$this->session->set_flashdata('error', 'Nomor Pertanyaan Sudah Terdaftar, Silahkan Ganti Nomor atau Edit Nomor Pertanyaan Yang Sudah Ada...');
			redirect('admin/pertanyaan','refresh');
		}
		else
		{			
			$cek = $this->M_master->input('tb_pertanyaan',$data);
			if (!$cek) {
				$this->session->set_flashdata('success', 'Data Updated');
				redirect('admin/pertanyaan','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error...');
				redirect('admin/pertanyaan','refresh');
			}
		}

	}

	function updatepertanyaan()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$where = ['id_soal' => $this->input->post('id_soal')];
		$data = [
			'soal'		=> $this->input->post('pertanyaan'),
			'kategori'	=> $this->input->post('kategori'),
			'a'			=> $this->input->post('a'),
			'b'			=> $this->input->post('b'),
			'c'			=> $this->input->post('c'),
			'd'			=> $this->input->post('d')
		];
		$cek = $this->M_master->update('tb_pertanyaan',$where,$data);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data inserted');
			redirect('admin/pertanyaan','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/pertanyaan','refresh');
		}
	}

	function hapuspertanyaan($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$cek = $this->M_master->delete('tb_pertanyaan',['id_soal' => $id]);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data Deleted');
			redirect('admin/pertanyaan','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/pertanyaan','refresh');
		}
	}


	/*publish*/
	function publish()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$responden = $this->M_admin->get_responden_1()->result();

		$hasil = array();
		$no = 1;
		foreach ($responden as $h) {
			$hasil[$no]	= [
				'id_responden'	=> $h->id_responden,
				'rata'			=> $this->_get_rataan_2($h->id_responden)
			];
			$no++;
		}

		$data = [
			'title'			=> 'Survey',
			'sub'			=> 'pre publish',
			'icon'			=> 'fa-share',
			'rekap'			=> $hasil
		];
		//echo json_encode($data);
		$this->template->load('tema/index','publish',$data);
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
			'rekap'			=> $this->M_admin->getdetil($id_responden)
		];
		$this->template->load('tema/index','detil',$data);
		//echo json_encode($data);
	}

	function aksipublish($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$where = ['id_responden' => $id];
		$this->db->where($where);
		$this->db->update('tb_hasil', ['published' => '2']);
		redirect('admin','refresh');
	}

	/*SARAN*/
	function saran()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'title'			=> 'Kritik Dan Saran',
			'sub'			=> '',
			'icon'			=> 'clip-file',
			'rekap'			=> $this->M_admin->getSaran()->result()
		];
		$this->template->load('tema/index','saran',$data);
	}

	function tanggapisaran($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$cek = $this->M_master->update('tb_saran',['id_responden' => $id],['status' => '2']);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data Updated');
			redirect('admin/saran','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/saran','refresh');
		}

	}

	function log_out()
	{
		session_destroy();
		redirect('survey','refresh');
	}

	/*cetak*/
	function cetaklaporan()
	{
		$data['tgl_indo']	= $this->M_master->tglindo(date('m'));
		$data['pengunjung']	= $this->M_master->getall('tb_detil_responden')->num_rows();

		//data umur
		$up40 	= $this->M_admin->get_umur('up40')->num_rows();
		$min40 	= $this->M_admin->get_umur('min40')->num_rows();
		//presentase umur
		$p40	= $up40/($up40+$min40);
		$m40 	= $min40/($up40+$min40);

		$data['umur'] = [
			'up40'	=> [
				'index'			=> '< 40',
				'jumlah'		=> $up40,
				'presentase'	=> number_format($p40*100,2)
			],
			'min40'	=> [
				'index'			=> '>= 40',
				'jumlah'		=> $min40,
				'presentase'	=> number_format($m40*100,2)
			]
		];

		//data JK
		$lk 	= $this->M_master->getWhere('tb_detil_responden',['jk' => 'Laki-laki'])->num_rows();
		$pr 	= $this->M_master->getWhere('tb_detil_responden',['jk' => 'Perempuan'])->num_rows();
		//presentase umur
		$plk	= $lk/($lk+$pr);
		$ppr 	= $pr/($lk+$pr);
		$data['jk'] = [
			'laki'	=> [
				'jk'		=> 'Laki-laki',
				'jumlah'	=> $lk,
				'presentase'=> number_format($plk*100,2)
			],
			'pr'	=> [
				'jk'		=> 'Perempuan',
				'jumlah'	=> $pr,
				'presentase'=> number_format($ppr*100,2)
			],
		];

		//index kepuasan
		$soal = $this->M_master->getall('tb_pertanyaan')->result();
		$no = 1;
		foreach ($soal as $v) {
			$hasil[$no] = [
				'kepuasan'	=> $this->_get_nilai($v->id_soal),
				'id_soal'	=> $v->id_soal,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'sp'		=> $this->_get_rataan($v->id_soal,'d'),
				'p'			=> $this->_get_rataan($v->id_soal,'c'),
				'tp'		=> $this->_get_rataan($v->id_soal,'b'),
				'kec'		=> $this->_get_rataan($v->id_soal,'a'),
			];
			$no++;
		}
		$data['hasil']	= $hasil;
		$data['min']	= min($hasil);
		$data['max']	= max($hasil);

		//Index Kepuasan
		$kepuasan = $this->_get_kepuasan();
		if ($kepuasan >88.31){
			$mutu = 'A';
			$index = "Sangat Baik";
		}else if($kepuasan > 76.61){
			$mutu = 'B';
			$index = 'Baik';
		}else if($kepuasan > 65.00){
			$mutu = 'C';
			$index = 'Kurang Baik';
		}
		else if($kepuasan > 25.00 ) {
			$mutu = 'D';
			$index = 'Tidak Baik';
		}
		else {
			$mutu = null;
		}

		$data['tingkat_kepuasan'] = [
			'index'			=> $index,
			'mutu'			=> $mutu,
			'presentase'	=> $this->_get_kepuasan()
		];
		//echo json_encode($data);
		$this->load->view('cetak/cetak_laporan', $data);
	}

	function cetaksaran()
	{
		$data['rekap']	= $this->M_admin->getSaran()->result();
		$this->load->view('cetak/cetak_saran', $data);
	}

	function cetakrekap()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		//hasilnya untuk index kepuasan per soal
		$soal = $this->M_master->getall('tb_pertanyaan')->result();
		$hasil = array();
		$hasil_2 = array();
		$no = 1;
		foreach ($soal as $v) {
			$hasil[$no]= [
				'kepuasan'	=> $this->_get_nilai($v->id_soal),
				'id_soal'	=> $v->id_soal,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'sp'		=> $this->_get_rataan($v->id_soal,'d'),
				'p'			=> $this->_get_rataan($v->id_soal,'c'),
				'tp'		=> $this->_get_rataan($v->id_soal,'b'),
				'kec'		=> $this->_get_rataan($v->id_soal,'a'),
			];
			$no++;
		}
		sort($hasil);

		//mengembalikan urutan by ID
		$data_short = $this->_get_prioritas($hasil);
		sort($data_short);
		$data['rekap'] 	= $data_short;
		$this->load->view('cetak/cetak1', $data);
	}

	function cetakrekapdetil()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}
		
		$res = $this->M_admin->get_responden_1()->result();
		$data['soal'] = $this->M_master->getall('tb_pertanyaan')->result();
		$hasil =array();
		$jawaban = array();
		$no= 1;
		foreach ($res as $key) {
			$hasil[$no]= [
				'id_responden'	=> $key->id_responden,
				'jawaban' 		=> $this->_get_jawaban($key->id_responden)
			];
			$no++;
		}
		$data['rekap'] = $hasil;
		//echo json_encode($data['rekap']);
		$this->load->view('cetak/cetakrekapdetil', $data);
	}


	//private function
	private function _get_jawaban($id_responden)
	{
		$dt	= $this->M_master->getWhere('tb_hasil',['id_responden' => $id_responden])->result();
		$soal = $this->M_master->getall('tb_pertanyaan')->result();
		$data = array();
		$no = 1;
		foreach ($soal as $soal) {
			$jw = $this->_jawaban($soal->id_soal,$id_responden);
			if ($jw == 'd') {
				$nilai = '4';
			}
			else if($jw == 'c')
			{
				$nilai = '3';
			}
			else if($jw == 'b')
			{
				$nilai = '2';
			}
			else
			{
				$nilai = '1';
			}

			array_push($data, $nilai);	
			$no++;
		}
		return $data;
	}

	private function _jawaban($soal,$id_responden)
	{
		$this->db->select('jawaban');
		$this->db->where('id_responden', $id_responden);
		$this->db->where('id_soal', $soal);
		$data =  $this->db->get('tb_hasil')->row();
		$hasil = $data->jawaban;
		return $hasil;
	}

	private function _get_prioritas($data)
	{
		$hasil = array();
		$no = 1;
		foreach ($data as $v) {
			$hasil[$no] = [
				'id_soal'	=> $v['id_soal'],
				'kepuasan'	=> $v['kepuasan'],
				'kategori'	=> $v['kategori'],
				'soal'		=> $v['soal'],
				'sp'		=> $v['sp'],
				'p'			=> $v['p'],
				'tp'		=> $v['tp'],
				'kec'		=> $v['kec'],
				'prioritas' => $no
			];
			$no++;
		}

		return $hasil;
	}


	private function _get_hasil()
	{
		$sangat_puas 	= $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'd'])->num_rows();
		$puas 		 	= $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'c'])->num_rows();
		$tidak_puas 	= $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'b'])->num_rows();
		$kecewa 		= $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'a'])->num_rows();

		$all = $sangat_puas+$puas+$tidak_puas+$kecewa;

		if($all != 0)
		{
			$data = [
				[
					'name' 	=> 'sangat_puas',
					/*'y'		=> floatval(number_format(($sangat_puas/$all)*100,2)),*/
					'y'		=> $sangat_puas,
					'color' => '#00FF00'
				],
				[
					'name' 	=> 'puas',
					/*'y'		=> floatval(number_format(($puas/$all)*100,2)),*/
					'y'		=> $puas,
					'color' => 'blue'
				],
				[
					'name' 	=> 'tidak_puas',
					/*'y'		=> floatval(number_format(($tidak_puas/$all)*100,2)),*/
					'y'		=> $tidak_puas,
					'color' => 'purple'
				],
				[
					'name' 	=> 'kecewa',
					/*'y'		=> floatval(number_format(($kecewa/$all)*100,2)),*/
					'y'		=> $kecewa,
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

	private function _get_pendidikan()
	{
		$pendidikan = $this->M_master->getall('tb_pendidikan')->result();
		$no = 1;
		foreach ($pendidikan as $p) {
			$hasil[$no] = [
				'pendidikan'	=> $p->pendidikan,
				'jumlah'		=> $this->M_admin->join_get_responden_2('pendidikan',$p->pendidikan)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}

	private function _get_pekerjaan()
	{
		$pekerjaan = $this->M_master->getall('tb_pekerjaan')->result();
		$no = 1;
		foreach ($pekerjaan as $p) {
			$hasil[$no] = [
				'pekerjaan'		=> $p->pekerjaan,
				'jumlah'		=> $this->M_admin->join_get_responden_2('pekerjaan',$p->pekerjaan)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}

	private function _get_kepuasan()
	{
		$total = $this->M_master->getall('tb_hasil')->num_rows();
		$soal = $this->M_master->getall('tb_pertanyaan')->num_rows();
		$total_responden = $this->M_master->get_responden();
		$a = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'a'])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'b'])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'c'])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'd'])->num_rows();

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
		$total_responden = $this->M_master->get_responden();
		$a = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'a','id_soal' => $id])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'b','id_soal' => $id])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'c','id_soal' => $id])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'd','id_soal' => $id])->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($total_responden);
			return number_format($kepuasan,2);
		}
		return 0;
	}

	private function _get_rataan($id_soal,$jawaban)
	{
		$data = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => $jawaban,'id_soal' => $id_soal])->num_rows();
		return $data;
	}

	private function _get_rataan_2($id_responden)
	{
		$soal = $this->M_master->getall('tb_pertanyaan')->num_rows();
		$a = $this->M_master->getWhere('tb_hasil',['published' => '1','jawaban' => 'a','id_responden' => $id_responden])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil',['published' => '1','jawaban' => 'b','id_responden' => $id_responden])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil',['published' => '1','jawaban' => 'c','id_responden' => $id_responden])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil',['published' => '1','jawaban' => 'd','id_responden' => $id_responden])->num_rows();

		$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($soal);
		return number_format($kepuasan,2);
	}


}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */