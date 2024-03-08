<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
	/*IMPORT*/
	function importData()
	{
		$nama = uniqid() . '.xlsx';
		$config['upload_path']          = './assets/excel/';
		$config['allowed_types']        = 'xls|xlsx';
		$config['file_name']           	= $nama;
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;
		if (!$this->upload->do_upload('file')) {
			$response = $this->upload->display_errors();
			return [
				'kode'		=> 'error',
				'msg'		=> $response
			];
		} else {
			$spreadsheet 	= \PhpOffice\PhpSpreadsheet\IOFactory::load($config['upload_path'] . $config['file_name']);
			$worksheet 		= $spreadsheet->getActiveSheet()->toArray();

			$dataResponden = [];
			$dataJawaban = [];
			for ($i = 1; $i < count($worksheet); $i++) {
				if ($worksheet[$i][0] != "") {
					$id_responden = uniqid();
					$dat = [
						'id' 			=> uniqid(),
						'id_responden' 	=> $id_responden,
						'created_date'	=> date('Y-m-d H:i:s', strtotime($worksheet[$i][0])),
						'loket' 		=> $worksheet[$i][1],
						'nama'			=> $worksheet[$i][2],
						'umur'			=> $worksheet[$i][3],
						'jk'			=> $worksheet[$i][4],
						'pekerjaan'		=> $worksheet[$i][5],
						'pendidikan'	=> $worksheet[$i][6],
					];
					array_push($dataResponden, $dat);

					for ($colom = 1; $colom < 10; $colom++) {
						$index = 6 + $colom;
						switch ($worksheet[$i][$index]) {
							case '4':
								$jawaban = 'd';
								break;
							case '3':
								$jawaban = 'c';
								break;
							case '2':
								$jawaban = 'b';
								break;

							default:
								$jawaban = 'a';
								break;
						}

						$dat2 = [
							'id_kuis' 		=> uniqid(),
							'id_responden' 	=> $id_responden,
							'id_soal'		=> "U" . $colom,
							'jawaban'		=> $jawaban,
							'created_date'	=> date('Y-m-d H:i:s', strtotime($worksheet[$i][0])),
							'published'		=> '2'
						];
						array_push($dataJawaban, $dat2);
					}
				}
			}

			$this->db->insert_batch('tb_detil_responden', $dataResponden);
			$this->db->insert_batch('tb_hasil', $dataJawaban);
			unlink("./assets/excel/$nama");

			return [
				'hasil'		=> $dataJawaban,
				'resp'		=> $dataResponden,
				'kode'		=> 'success',
				'msg'		=> 'success'
			];
		}
	}

	/* FUNCTION YANG DIPAKAI UPDATE 2024*/
	function belumPublish($bulan, $tahun, $unsur)
	{
		$where = [
			'published'				=> '1',
			'jenis_pertanyaan'		=> $unsur,
			'YEAR(created_date)'	=> $tahun
		];
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->select('id_responden,created_date as tanggal_mengisi, sum(jawaban) as total_nilai, jenis_pertanyaan');
		$this->db->group_by('id_responden');
		return $this->db->get_where('tb_hasil', $where)->result();
	}

	function getdetil($id_responden, $unsur)
	{
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = tb_hasil.id_soal');
		$this->db->where('id_responden', $id_responden);
		$this->db->where('tb_hasil.jenis_pertanyaan', $unsur);
		return $this->db->get('tb_hasil')->result();
	}

	function aksipublish($id_responden, $jenisPertanyaan)
	{
		$where = [
			'id_responden'		=> $id_responden,
			'jenis_pertanyaan'	=> $jenisPertanyaan
		];
		$this->db->where($where);
		$this->db->update('tb_hasil', ['published'	=> '2']);

		$this->db->where(['id_responden'		=> $id_responden,]);
		$this->db->update('tb_detil_responden', ['status'	=> '2']);

		/* UPDATE REKAP HASIL JENIS PELAYANAN */
		$this->db->where('jenis_pertanyaan', $jenisPertanyaan);
		$hasil = $this->db->get_where('tb_hasil', $where)->result();
		$jawabanPelayanan = [];
		foreach ($hasil as $h) {
			array_push($jawabanPelayanan, $h->jawaban);
		}
		$data = [
			'id_responden'		=> $id_responden,
			'jenis_pertanyaan'	=> $jenisPertanyaan,
			'jawaban'			=> json_encode($jawabanPelayanan),
			'created_date'		=> $hasil[0]->created_date,
		];
		$this->db->insert('rekap_hasil', $data);

		/* UPDATE REKAP HASIL JENIS KPK */
		// $this->db->where('jenis_pertanyaan', KODEKPK);
		// $hasil = $this->db->get_where('tb_hasil', $where)->result();
		// if ($hasil) {
		// 	$jawabanKpk = [];
		// 	foreach ($hasil as $h) {
		// 		array_push($jawabanKpk, $h->jawaban);
		// 	}
		// 	$data = [
		// 		'id_responden'		=> $id_responden,
		// 		'jenis_pertanyaan'	=> KODEKPK,
		// 		'jawaban'			=> json_encode($jawabanKpk),
		// 		'created_date'		=> $hasil[0]->created_date,
		// 	];
		// 	$this->db->insert('rekap_hasil', $data);
		// }

		$isianResponden = $this->db->get_where('tb_hasil', $where)->result();
		$string = 'jumlah_';
		foreach ($isianResponden as $i) {
			$kolom = $string . $i->jawaban;

			$whereHasil = [
				'tahun_isi'	=> date('Y', strtotime($i->created_date)),
				'bulan_isi'	=> date('m', strtotime($i->created_date)),
				'id_soal'	=> $i->id_soal
			];
			$cekCount = $this->db->get_where('count_point', $whereHasil)->row();
			if ($cekCount) {
				$hasilHitung = intval($cekCount->$kolom);
				$hasilHitung = $hasilHitung + 1;

				$this->db->where($whereHasil);
				$this->db->update('count_point', [$kolom	=> $hasilHitung]);
			} else {
				$databaru = [
					'id_soal'		=> $i->id_soal,
					'tahun_isi'		=> date('Y', strtotime($i->created_date)),
					'bulan_isi'		=> date('m', strtotime($i->created_date)),
					$kolom 			=> 1
				];
				$this->db->insert('count_point', $databaru);
			}
		}
		return [
			'kode'		=> 'success',
			'msg'		=> 'berhasil simpan data',
			'jenis'		=> $jenisPertanyaan
		];
	}

	/* AJAX */
	function ajaxColumnPilihan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$label = [];
		$data = [];
		$jawaban = 0;
		$where = [
			'jenis_pertanyaan'		=> KODEPELAYANAN,
			'tahun_isi'				=> $tahun
		];

		$this->db->select('kode_soal,sum(jumlah_4) as jumlah_4,sum(jumlah_3) as jumlah_3,sum(jumlah_2) as jumlah_2,sum(jumlah_1) as jumlah_1');
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
		if ($bulan) {
			$this->db->where('bulan_isi', $bulan);
		}
		$this->db->group_by('kode_soal');
		$kategori = $this->db->get_where('count_point', $where)->result();

		foreach ($kategori as $var) {
			array_push($label, $var->kode_soal);
			$totalresponden = intval($var->jumlah_4) + intval($var->jumlah_3) + intval($var->jumlah_2) + intval($var->jumlah_1);
			$jawaban 		= intval($var->jumlah_4 * 4) + intval($var->jumlah_3 * 3) + intval($var->jumlah_2 * 2) + intval($var->jumlah_1);
			$persen = $totalresponden > 0 ? $jawaban / $totalresponden : 0;
			$persen = number_format($persen, 2);
			$persen = floatval($persen);
			array_push($data, $persen);
		}

		return [
			'label'		=> $label,
			'data'		=> $data,
		];
	}

	function ajaxPiePilihan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$label = [
			[
				'label'		=> 'Sangat Puas',
				'nilai'		=> 4
			],
			[
				'label'		=> 'Puas',
				'nilai'		=> 3
			],
			[
				'label'		=> 'Tidak Puas',
				'nilai'		=> 2
			],
			[
				'label'		=> 'Sangat Tidak Puas',
				'nilai'		=> 1
			],
		];

		$arrayLabel = [];
		$arrayPersen = [];
		$string = 'jumlah_';

		$jumlahSoal = $this->db->get_where('tb_pertanyaan', ['jenis_pertanyaan'	=> KODEPELAYANAN])->num_rows();

		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '2');
		if ($bulan != null) {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->group_by('id_responden');
		$totalResponden = $this->db->select('id_responden')->get('tb_hasil')->num_rows();

		foreach ($label as $l) {
			array_push($arrayLabel, $l['label']);
			$nilai = strval($l['nilai']);
			$kolom = $string . $nilai;
			$where = [
				'jenis_pertanyaan'		=> KODEPELAYANAN,
				'tahun_isi'				=> $tahun
			];

			$this->db->select('SUM(' . $kolom . ') /' . ($totalResponden * $jumlahSoal) . ' as total');
			$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
			if ($bulan) {
				$this->db->where('bulan_isi', $bulan);
			}
			$cek = $this->db->get_where('count_point', $where)->row();

			array_push($arrayPersen, floatval(number_format(floatval($cek->total * 100), 2)));
		}

		return [
			'label'		=> $arrayLabel,
			'data'		=> $arrayPersen,
		];
	}

	function ajaxPiePendidikan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$label = [];
		$data = [];
		$where = [
			'YEAR(created_date)' 	=> date('Y', strtotime($tahun)),
			'status'				=> '2'
		];
		$this->db->select('pendidikan,count(pendidikan) as total');
		$this->db->group_by('pendidikan');
		if ($bulan) {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$array = $this->db->get_where('tb_detil_responden', $where)->result();
		$total = array_column($array, 'total');
		$totalData = array_sum($total);

		foreach ($array as $a) {
			array_push($label, $a->pendidikan);
			$persen = ($a->total / $totalData) * 100;
			$persen = number_format($persen, 2);
			$persen = floatval($persen);
			array_push($data, $persen);
		}

		return [
			'label'		=> $label,
			'data'		=> $data,
		];
	}

	function ajaxPiePekerjaan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$label = [];
		$data = [];
		$where = [
			'YEAR(created_date)' 	=> date('Y', strtotime($tahun)),
			'status'				=> '2'
		];
		$this->db->select('pekerjaan,count(pekerjaan) as total');
		$this->db->group_by('pekerjaan');
		if ($bulan) {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$array = $this->db->get_where('tb_detil_responden', $where)->result();
		$total = array_column($array, 'total');
		$totalData = array_sum($total);

		foreach ($array as $a) {
			array_push($label, $a->pekerjaan);
			$persen = ($a->total / $totalData) * 100;
			$persen = number_format($persen, 2);
			$persen = floatval($persen);
			array_push($data, $persen);
		}

		return [
			'label'		=> $label,
			'data'		=> $data,
		];
	}

	function ajaxTableMutu()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '2');
		if ($bulan != null) {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->group_by('id_responden');
		$totalresponden = $this->db->select('id_responden')->get('tb_hasil')->num_rows();

		$where = [
			'jenis_pertanyaan'		=> KODEPELAYANAN,
			'tahun_isi'				=> $tahun,
		];
		$this->db->select('kode_soal,kategori,sum(jumlah_4) as jumlah_4,sum(jumlah_3) as jumlah_3,sum(jumlah_2) as jumlah_2,sum(jumlah_1) as jumlah_1');
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
		$this->db->group_by('kode_soal');
		$this->db->order_by('urutan', 'asc');
		if ($bulan != null) {
			$this->db->where('bulan_isi', $bulan);
		}
		$kategori = $this->db->get_where('count_point', $where)->result();

		$html = '';
		foreach ($kategori as $var) {
			$jawaban 		= intval($var->jumlah_4 * 4) + intval($var->jumlah_3 * 3) + intval($var->jumlah_2 * 2) + intval($var->jumlah_1);
			$persen 		= $jawaban / $totalresponden;

			if ($persen >= 1 && $persen <= 2.5996) {
				$index = 'D';
			} else if ($persen >= 2.60 && $persen <= 3.064) {
				$index = 'C';
			} else if ($persen >= 3.0644 && $persen < 3.532) {
				$index = 'B';
			} else if ($persen >= 3.5324 && $persen <= 4) {
				$index = 'A';
			} else {
				$index = null;
			}

			$persen = number_format($persen, 2);
			$html .= '<tr class="font-weight-bold">';
			$html .= '<td class="text-center" style="font-weight: bold;">' . $var->kode_soal . '</td>';
			$html .= '<td style="font-weight: bold;">' . $var->kategori . '</td>';
			$html .= '<td class="text-center">' . number_format($var->jumlah_4) . '</td>';
			$html .= '<td class="text-center">' . number_format($var->jumlah_3) . '</td>';
			$html .= '<td class="text-center">' . number_format($var->jumlah_2) . '</td>';
			$html .= '<td class="text-center">' . number_format($var->jumlah_1) . '</td>';
			$html .= '<td class="text-center" style="font-weight: bold;">' . $persen . '</td>';
			$html .= '<td class="text-center" style="font-weight: bold;">' . $index . '</td>';
			$html .= '<tr>';
		}

		return $html;
	}

	function ajaxCount()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$jumlahSoal = $this->db->get_where('tb_pertanyaan', ['jenis_pertanyaan'	=> KODEPELAYANAN])->num_rows();

		$this->db->select('(IFNULL(sum(jumlah_4),0) *4) + (IFNULL(sum(jumlah_3),0) *3) + (IFNULL(sum(jumlah_2),0) *2) + IFNULL(sum(jumlah_1),0) as total');
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
		if ($bulan != null) {
			$this->db->where('bulan_isi', $bulan);
		}
		$totalNilai = $this->db->get_where('count_point', [
			'jenis_pertanyaan'	=> KODEPELAYANAN,
			'tahun_isi'			=> $tahun,
		])->row();
		$totalNilai = $totalNilai ? $totalNilai->total : 0;

		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '2');
		if ($bulan != null) {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->group_by('id_responden');
		$totalResponden = $this->db->select('id_responden')->get('tb_hasil')->num_rows();

		$kepuasan = $totalResponden ? ($totalNilai / ($totalResponden * 4 * $jumlahSoal)) * 100 : 0;
		if ($kepuasan > 81.25 && $kepuasan < 100) {
			$index = "Sangat Baik";
			$index_huruf = "A";
		} else if ($kepuasan > 62.50 && $kepuasan < 81.26) {
			$index = 'Baik';
			$index_huruf = "B";
		} else if ($kepuasan > 43.75 && $kepuasan < 62.51) {
			$index = 'Kurang Baik';
			$index_huruf = "C";
		} else if ($kepuasan > 24.9 && $kepuasan < 43.76) {
			$index = 'Tidak Baik';
			$index_huruf = "D";
		} else {
			$index = '-';
			$index_huruf = "-";
		}

		$where = [
			'published'				=> '1',
			'jenis_pertanyaan'		=> KODEPELAYANAN,
			'YEAR(tb_hasil.created_date)'	=> $tahun
		];
		if ($bulan != null) {
			$this->db->where('MONTH(tb_hasil.created_date)', $bulan);
		}
		$this->db->select('id_responden,created_date as tanggal_mengisi, sum(jawaban) as total_nilai');
		$this->db->group_by('id_responden');
		$belumPublish = $this->db->get_where('tb_hasil', $where)->num_rows();

		return [
			'totalNilai'		=> $totalResponden * 4 * $jumlahSoal,
			'persen'			=> $kepuasan ? number_format($kepuasan, 2) : '-',
			'kategori_kepuasan'	=> $index,
			'mutu'				=> '( ' . $index_huruf . ' )',
			'total_responden' 	=> $totalResponden > 0 ? $totalResponden : '-',
			'belum_publish'		=> number_format($belumPublish, 0),

		];
	}

	/* CETAK */
	function exportData($bulan, $tahun)
	{
		$where = [
			'jenis_pertanyaan'		=> KODEPELAYANAN,
			'tahun_isi'				=> $tahun,
		];
		$this->db->select('kode_soal,kategori,sum(jumlah_4) as jumlah_4,sum(jumlah_3) as jumlah_3,sum(jumlah_2) as jumlah_2,sum(jumlah_1) as jumlah_1');
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
		$this->db->group_by('kode_soal');
		$this->db->order_by('urutan', 'asc');
		if ($bulan != 'setahun') {
			$this->db->where('bulan_isi', $bulan);
		}
		$kategori = $this->db->get_where('count_point', $where)->result();

		$this->db->where('YEAR(created_date)', $tahun);
		$this->db->where('published', '2');
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(created_date)', $bulan);
		}
		$this->db->group_by('id_responden');
		$totalResponden = $this->db->select('id_responden')->get('tb_hasil')->num_rows();

		/* EXCEL */
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$style_col = [
			'font' => ['bold' => true], // Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];

		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];

		$sheet->setCellValue('A1', "REKAP KEPUASAN MASYARAKAT");
		$sheet->mergeCells('A1:I1');
		$sheet->getStyle('A1')->getFont()->setBold(true);
		$sheet->getStyle('A1')->getFont()->setSize(15);

		$sheet->setCellValue('A2', "BULAN : $bulan | TAHUN : $tahun");
		$sheet->mergeCells('A2:I2');

		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A3', "NO");
		$sheet->mergeCells('A3:A4');
		$sheet->setCellValue('B3', "UNSUR PELAYANAN");
		$sheet->mergeCells('B3:B4');

		$sheet->setCellValue('C3', "Jumlah Responden Yang Menjawab (orang)");
		$sheet->mergeCells('C3:F3');

		$sheet->setCellValue('G3', "NILAI RATA2");
		$sheet->mergeCells('G3:G4');

		$sheet->setCellValue('H3', "KATEGORI MUTU");
		$sheet->mergeCells('H3:H4');

		$sheet->setCellValue('I3', "PRIORITAS");
		$sheet->mergeCells('I3:I4');

		$sheet->setCellValue('C4', "Sangat Puas");
		$sheet->setCellValue('D4', "Puas");
		$sheet->setCellValue('E4', "Kurang Puas");
		$sheet->setCellValue('F4', "Kecewa");

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('A4')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('B4')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
		$sheet->getStyle('C4')->applyFromArray($style_col);
		$sheet->getStyle('D4')->applyFromArray($style_col);
		$sheet->getStyle('E4')->applyFromArray($style_col);
		$sheet->getStyle('F4')->applyFromArray($style_col);
		$sheet->getStyle('G3')->applyFromArray($style_col);
		$sheet->getStyle('G4')->applyFromArray($style_col);
		$sheet->getStyle('H3')->applyFromArray($style_col);
		$sheet->getStyle('H4')->applyFromArray($style_col);
		$sheet->getStyle('I3')->applyFromArray($style_col);
		$sheet->getStyle('I4')->applyFromArray($style_col);

		/* ISI DATA */
		$no = 1;
		$row = 5;
		foreach ($kategori as $var) {
			// $totalresponden = intval($var->jumlah_4) + intval($var->jumlah_3) + intval($var->jumlah_2) + intval($var->jumlah_1);
			$jawaban 		= intval($var->jumlah_4 * 4) + intval($var->jumlah_3 * 3) + intval($var->jumlah_2 * 2) + intval($var->jumlah_1);
			$persen 		= $jawaban / $totalResponden;

			if ($persen >= 1 && $persen <= 2.5996) {
				$index = 'D';
			} else if ($persen >= 2.60 && $persen <= 3.064) {
				$index = 'C';
			} else if ($persen >= 3.0644 && $persen < 3.532) {
				$index = 'B';
			} else if ($persen >= 3.5324 && $persen <= 4) {
				$index = 'A';
			} else {
				$index = null;
			}

			$persen = number_format($persen, 2);
			$sheet->setCellValue('A' . $row, $var->kode_soal);
			$sheet->setCellValue('B' . $row, $var->kategori);
			$sheet->setCellValue('C' . $row, $var->jumlah_4);
			$sheet->setCellValue('D' . $row, $var->jumlah_3);
			$sheet->setCellValue('E' . $row, $var->jumlah_2);
			$sheet->setCellValue('F' . $row, $var->jumlah_1);
			$sheet->setCellValue('G' . $row, $persen);
			$sheet->setCellValue('H' . $row, $index);
			$sheet->setCellValue('I' . $row, "");

			$sheet->getStyle('A' . $row)->applyFromArray($style_row);
			$sheet->getStyle('B' . $row)->applyFromArray($style_row);
			$sheet->getStyle('C' . $row)->applyFromArray($style_row);
			$sheet->getStyle('D' . $row)->applyFromArray($style_row);
			$sheet->getStyle('E' . $row)->applyFromArray($style_row);
			$sheet->getStyle('F' . $row)->applyFromArray($style_row);
			$sheet->getStyle('G' . $row)->applyFromArray($style_row);
			$sheet->getStyle('H' . $row)->applyFromArray($style_row);
			$sheet->getStyle('I' . $row)->applyFromArray($style_row);

			$sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			$sheet->getStyle('H' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getRowDimension($row)->setRowHeight(20);

			$no++;
			$row++;
		}

		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(5);
		$sheet->getColumnDimension('B')->setWidth(30);
		$sheet->getColumnDimension('C')->setWidth(15);
		$sheet->getColumnDimension('D')->setWidth(15);
		$sheet->getColumnDimension('E')->setWidth(15);
		$sheet->getColumnDimension('F')->setWidth(15);
		$sheet->getColumnDimension('G')->setWidth(15);
		$sheet->getColumnDimension('H')->setWidth(20);
		$sheet->getColumnDimension('I')->setWidth(15);

		// Set judul file excel nya
		$sheet->setTitle("SURVEY KEPUASAN MASYARAKAT");

		$date = date('Y-m-d H:i:s');
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="survey Kepuasan Masyarakat MPP' . $date . '.xls"');
		$writer->save('php://output');
	}

	function exportDataDetail($bulan, $tahun, $jenis)
	{
		$bulan = $bulan ? $bulan : date('m');
		$tahun = $tahun ? $tahun : date('Y');

		if ($bulan != 'setahun') {
			$this->db->where('MONTH(rekap_hasil.created_date)', $bulan);
		}
		$this->db->where('YEAR(rekap_hasil.created_date)', $tahun);
		$this->db->where('jenis_pertanyaan', $jenis);
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = rekap_hasil.id_responden');
		$jawaban = $this->db->get('rekap_hasil')->result();

		$soal = $this->db->get_where('tb_pertanyaan', ['jenis_pertanyaan'	=> $jenis]);
		$hasil = [];
		foreach ($jawaban as $j) {
			$arr = [];
			$jawaban = json_decode($j->jawaban);
			for ($i = 0; $i < count($jawaban); $i++) {
				if ($i <= $soal->num_rows()) {
					$arr[]	= [
						'jawaban'		=> $jawaban[$i]
					];
				} else {
					$arr[]	= [
						'jawaban'	=> ''
					];
				}
			}

			$hasil[] = [
				'nama'				=> $j->nama,
				'id_responden'		=> $j->id_responden,
				'created_date'		=> $j->created_date,
				'jawaban'			=> $arr
			];
		}

		$data = [
			'soal'		=> $soal->result(),
			'bulan'		=> $this->M_master->tglindo($bulan),
			'tahun'		=> $tahun,
			'unsur'		=> $this->db->select('keperluan')->get_where('jenis_pertanyaan', ['id_jenispertanyaan'	=> $jenis])->row(),
			'rekap'		=> $hasil
		];
		$this->load->view('cetak/cetakrekapdetil', $data);
	}

	function cetaklaporan($bulan, $tahun, $jenis)
	{
		$bulan = $bulan == 'setahun' ? date('m') : $bulan;
		/* Pertanyaan */
		$totalPertanyaan = $this->db->get_where('tb_pertanyaan', ['jenis_pertanyaan'	=> $jenis])->num_rows();

		/* PENGUNJUNG */
		$this->db->select('tb_hasil.id_responden, umur,jk');
		$this->db->where('YEAR(tb_hasil.created_date)', $tahun);
		$this->db->where('published', '2');
		$this->db->where('jenis_pertanyaan', $jenis);
		$this->db->where('MONTH(tb_hasil.created_date) <=', $bulan);
		$this->db->group_by('tb_hasil.id_responden');
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$responden = $this->db->get('tb_hasil');

		/* UMUR */
		$up40 = 0;
		$min40 = 0;
		$lk = 0;
		$pr = 0;
		foreach ($responden->result() as $r) {
			if ($r->umur >= 40) {
				$up40++;
			} else {
				$min40++;
			}

			if ($r->jk == 'Perempuan') {
				$pr++;
			} else {
				$lk++;
			}
		}
		$totalUmur = $up40 + $min40;
		$umur = [
			'up40'	=> [
				'index'			=> '>= 40',
				'jumlah'		=> $up40,
				'presentase'	=> $totalUmur ? number_format(($up40 / $totalUmur) * 100, 2) : 0
			],
			'min40'	=> [
				'index'			=> '< 40',
				'jumlah'		=> $min40,
				'presentase'	=> $totalUmur ? number_format(($min40 / ($up40 + $min40)) * 100, 2) : 0
			]
		];

		$totalJk = $lk + $pr;
		$jk =  [
			'laki'	=> [
				'jk'		=> 'Laki-laki',
				'jumlah'	=> $lk,
				'presentase' => $totalJk ? number_format(($lk / $totalJk) * 100, 2) : 0
			],
			'pr'	=> [
				'jk'		=> 'Perempuan',
				'jumlah'	=> $pr,
				'presentase' => $totalJk ? number_format(($pr / ($lk + $pr)) * 100, 2) : 0
			],
		];

		/* ANALISA */
		$where = [
			'jenis_pertanyaan'		=> $jenis,
			'tahun_isi'				=> $tahun,
		];
		$this->db->select('kode_soal,kategori,sum(jumlah_4) as jumlah_4,sum(jumlah_3) as jumlah_3,sum(jumlah_2) as jumlah_2,sum(jumlah_1) as jumlah_1');
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = count_point.id_soal');
		$this->db->group_by('kode_soal');
		$this->db->order_by('urutan', 'asc');
		$this->db->where('CAST(bulan_isi as INT) <=', intval($bulan));
		$kategori = $this->db->get_where('count_point', $where)->result();

		$hasil = [];
		$totalNilai = 0;
		$pembagi = $responden->num_rows() * $totalPertanyaan;
		foreach ($kategori as $k) {
			$sumBaris = (intval($k->jumlah_4) * 4) + (intval($k->jumlah_3) * 3) + (intval($k->jumlah_2) * 2) + intval($k->jumlah_1);
			$hasil[] = [
				'kode_soal'		=> $k->kode_soal,
				'kategori'		=> $k->kategori,
				'kepuasan'		=> $responden->num_rows() > 0 ?  $sumBaris / $responden->num_rows() : 0,
			];
			$totalNilai += $sumBaris;
		}

		/* PRIORITAS */
		sort($hasil);
		$data_short = $hasil;
		usort($data_short, fn ($a, $b) => $a['kepuasan'] <=> $b['kepuasan']);

		$data = [
			'tgl_indo'		=> $this->M_master->tglindo($bulan),
			'tahun'			=> $tahun,
			'pengunjung'	=> $responden->num_rows(),
			'umur'			=> $umur,
			'jk'			=> $jk,
			'kepuasan' 		=> $pembagi > 0 ? ($totalNilai / ($pembagi * 4)) * 100 : 0,
			'min' 			=> $hasil ? min($hasil) : [],
			'max'			=> $hasil ? max($hasil) : [],
			'prioritas'		=> $data_short,
			'hasil'			=> $hasil,
			'unsur'			=> $this->db->select('keperluan')->get_where('jenis_pertanyaan', ['id_jenispertanyaan'	=> $jenis])->row()->keperluan
		];
		$this->load->view('cetak/cetak_laporan', $data);
	}
}

/* End of file M_admin.php */
/* Location: ./application/modules/admin/models/M_admin.php */