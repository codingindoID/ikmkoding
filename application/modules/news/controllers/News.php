<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
	}
	public function index()
	{
		$data = [
			'title'			=> 'News',
			'sub'			=> '',
			'icon'			=> 'fa-rss-square',
			'news'			=> $this->M_master->getall('news')->result()
		];

		$this->template->load('tema/index','news',$data);
	}

	/*FAQ*/
	function faq()
	{
		$data = [
			'title'			=> 'FAQ',
			'sub'			=> '',
			'icon'			=> 'fa-question',
			'faq'			=> $this->M_master->getall('faq')->result()
		];

		$this->template->load('tema/index','faq',$data);	
	}

	function hapusfaq($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('survey/satpam','refresh');
		}

		$cek = $this->M_master->delete('faq',['id' => $id]);
		if (!$cek) {
			$this->session->set_flashdata('success', 'FAQ dihapus');
			redirect('news/faq','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal');
			redirect('news/faq','refresh');
		}
	}

	function detilfaq($id)
	{
		$data = $this->M_master->getWhere('faq',['id'=> $id])->row();
		echo json_encode($data);
	}

	function updatefaq()
	{
		$data = [
			'pertanyaan'	=> $this->input->post('pertanyaan'),
			'jawaban'		=> $this->input->post('jawaban')
		];

		$cek = $this->M_master->update('faq',['id' => $this->input->post('id_faq')],$data);
		if (!$cek) {
			$this->session->set_flashdata('success', 'FAQ diupdate');
			redirect('news/faq','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal');
			redirect('news/faq','refresh');
		}
	}

	function addfaq()
	{
		$data = [
			'pertanyaan'	=> $this->input->post('pertanyaan'),
			'jawaban'		=> $this->input->post('jawaban')
		];

		$cek = $this->M_master->input('faq',$data);
		if (!$cek) {
			$this->session->set_flashdata('success', 'FAQ ditambah');
			redirect('news/faq','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal');
			redirect('news/faq','refresh');
		}
	}

}

/* End of file News.php */
/* Location: ./application/modules/news/controllers/News.php */