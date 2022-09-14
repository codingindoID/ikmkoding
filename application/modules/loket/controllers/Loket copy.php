<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loket extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_loket');
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam', 'refresh');
		}
	}
	public function index($bulan = null, $tahun = null, $cetak = null)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');

		$this->db->order_by('nama_loket', 'asc');
		$loket = $this->db->get('tb_loket')->result();

		// totalResponsen
		if ($bulan == 'setahun') {
			$query2 = "SELECT * FROM tb_hasil JOIN tb_detil_responden ON tb_detil_responden.id_responden = tb_hasil.id_responden  WHERE YEAR ( tb_hasil.created_date ) = '$tahun' AND published = '2'";
		} else {
			$query2 = "SELECT * FROM tb_hasil JOIN tb_detil_responden ON tb_detil_responden.id_responden = tb_hasil.id_responden  WHERE YEAR ( tb_hasil.created_date ) = '$tahun' and MONTH(tb_hasil.created_date) = '$bulan'  AND published = '2'";
		}
		$totalResponden = $this->db->query($query2)->result();

		$resp = [];
		foreach ($totalResponden as $a) {
			$array = [];
			if (!in_array($a->id_responden, $array, true)) {
				array_push($array, $a->id_responden);
				array_push($resp, $a);
			}
		}

		echo json_encode($resp);

		// $repondenLoket = $this->M_loket->detil_loket($loket, $tahun, $bulan, $totalResponden);
		// $respondenLain = array_column($repondenLoket, 'jumlah_responden');
		// $respondenLain	= array_sum($respondenLain);

		// $data = [
		// 	'title'				=> 'Monitoring Kepuasan',
		// 	'sub'				=> 'Loket Pelayanan',
		// 	'icon'				=> 'fa-user-circle',
		// 	'loket'				=> $repondenLoket,
		// 	'loket_lainnya'		=> $totalResponden - $respondenLain,
		// 	'total_responden' 	=> $totalResponden,
		// 	'menu'				=> 'loket',
		// 	'f_bulan'			=> $bulan,
		// 	'f_tahun'			=> $tahun,
		// 	'bulan'				=> $this->M_master->getall('bulan')->result(),
		// 	'tahun'				=> $this->M_master->getall('tahun')->result(),
		// ];
		// // echo json_encode($data);
		// if ($cetak != null) {
		// 	$this->load->view('cetakLaporan', $data);
		// } else {
		// 	$this->template->load('tema/index', 'loket', $data);
		// }
	}


	function detil_loket($id)
	{

		$data = $this->M_master->getWhere('tb_loket', ['id_loket' => $id])->row();
		echo json_encode($data);
	}

	function tambah_loket()
	{

		$data = [
			'id_loket'		=> uniqid(),
			'nama_loket'	=> $this->input->post('nama')
		];

		$cek = $this->M_master->input('tb_loket', $data);
		if (!$cek) {
			$this->session->set_flashdata('success', 'loket berhasil ditambahkan');
			redirect('loket', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'penambahan loket gagal..');
			redirect('loket', 'refresh');
		}
	}

	function update_loket()
	{

		$data = [
			'nama_loket'	=> $this->input->post('nama_loket')
		];

		$where = [
			'id_loket'		=> $this->input->post('id_loket')
		];

		$cek = $this->M_master->update('tb_loket', $where, $data);
		if (!$cek) {
			$this->session->set_flashdata('success', 'loket berhasil diupdate');
			redirect('loket', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'update loket gagal..');
			redirect('loket', 'refresh');
		}
	}

	function hapus_loket($id)
	{

		$cek = $this->M_master->delete('tb_loket', ['id_loket' => $id]);
		if (!$cek) {
			$this->session->set_flashdata('success', 'loket berhasil dihapus');
			redirect('loket', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Hapus loket gagal..');
			redirect('loket', 'refresh');
		}
	}

	function kecewa($id_soal, $bulan, $tahun, $pilihan)
	{
		/*Mengetahui Pertanyaan by id soal*/
		$pertanyaan = $this->M_master->getWhere('tb_pertanyaan', ['id_soal' => $id_soal])->row();
		$kategori 	= $pertanyaan->kategori;

		/*MEnghitung jumlah Jawaban*/
		$no = 1;
		$rekap = array();
		$loket = $this->M_loket->get_pilihan(
			$id_soal,
			$bulan,
			$tahun,
			$pilihan
		)->result();

		if (count($loket) > 0) {
			foreach ($loket as $loket) {
				$rekap[$no] = [
					'id_loket'		=> $loket->id_loket,
					'id_soal'		=> $loket->id_soal,
					'nama_loket'	=> $loket->nama_loket,
					'jumlah'		=> $this->M_loket->get_hasil_pilihan(
						$id_soal,
						$bulan,
						$tahun,
						$pilihan,
						$loket->id_loket
					)->num_rows()
				];

				$no++;
			}
		}

		/*sub Menu*/
		if ($pilihan == 'a') {
			$jenis = 'Kecewa';
		} else if ($pilihan == 'b') {
			$jenis = 'Kurang Puas';
		} else if ($pilihan == 'c') {
			$jenis = 'Puas';
		} else if ($pilihan == 'd') {
			$jenis = 'Sangat Puas';
		}

		$data = [
			'title'			=> 'Loket',
			'sub'			=> 'Jawaban ' . $jenis,
			'icon'			=> 'fa-user-circle',
			'menu'			=> 'loket',
			'kategori'		=> $kategori,
			'bulan'			=> $bulan,
			'bulan_indo'	=> $this->M_master->tglindo($bulan),
			'tahun'			=> $tahun,
			'rekap'			=> $rekap
		];
		//echo json_encode($data);
		$this->template->load('tema/index', 'pilihan_loket', $data);
	}

	/*PRIVATE FUNCTION*/
	//loket
	private function _get_loket($bulan, $tahun)
	{
		$loket = $this->M_master->getall('tb_loket')->result();
		$no = 1;
		foreach ($loket as $loket) {
			$data[$no] = [
				'nama_loket'	=> $loket->nama_loket,
				'id_loket'		=> $loket->id_loket,
				'responden'		=> $this->M_loket->get_responden_by_loket($loket->id_loket, $bulan, $tahun)->num_rows(),
				'nilai'			=> $this->_get_nilai_loket($loket->id_loket, $bulan, $tahun)
			];
			$no++;
		}
		sort($data);
		return $data;
	}

	private function _get_nilai_loket($id, $bulan, $tahun)
	{
		$data 		= $this->M_loket->get_nilai_loket($id, $bulan, $tahun)->result();

		$responden 	= $this->M_loket->get_responden_by_loket($id, $bulan, $tahun)->num_rows();
		$total_soal	= $this->M_master->getall('tb_pertanyaan')->num_rows();

		$no = 1;
		$total = 0;
		foreach ($data as $data) {
			if ($data->jawaban == 'd') {
				$n = 4;;
			} else if ($data->jawaban == 'c') {
				$n = 3;
			} else if ($data->jawaban == 'b') {
				$n = 2;
			} else {
				$n = 1;
			}
			$nilai[$no] = [
				'jawaban' => $n
			];
			$total += $nilai[$no]['jawaban'];
			$no++;
		}

		$nilai_max = $total_soal * 4 * $responden;
		if ($responden > 0) {
			$kepuasan = ($total / $nilai_max) * 100;
		} else {
			$kepuasan = 0;
		}

		return $kepuasan;
	}
}

/* End of file Loket.php */
/* Location: ./application/modules/loket/controllers/Loket.php */