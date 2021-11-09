<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indo {

	public function konversi($date)
	{
		$date 	= date('Y-m-d', strtotime($date));
		$d 		= explode("-", $date);

		$bulan = $this->bulan($d[1]);

		$tanggal = $d[2].' '.$bulan.' '.$d[0];
		return $tanggal;
	}

	public function bulan($bl)
	{
		switch ($bl) {
			case '01':
			$bulan = "Januari";
			break;
			case '02':
			$bulan = "Februari";
			break;
			case '03':
			$bulan = "Maret";
			break;
			case '04':
			$bulan = "April";
			break;
			case '05':
			$bulan = "Mei";
			break;
			case '06':
			$bulan = "Juni";
			break;
			case '07':
			$bulan = "Juli";
			break;
			case '08':
			$bulan = "Agustus";
			break;
			case '09':
			$bulan = "September";
			break;
			case '10':
			$bulan = "Oktober";
			break;
			case '11':
			$bulan = "November";
			break;
			case '12':
			$bulan = "Desember";
			break;
			default:
			break;
		}

		return $bulan;
	}
}