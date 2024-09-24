<?php
function tanggal_indo($tanggal, $cetak_hari = false)
{
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);
			
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split 	  = explode('-', $tanggal);
	$tgl_indo = substr($split[2],0,2) . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0]. ' '. substr($split[2],2,20);
	//$tgl_indo = $split[1] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0] . ' ' .$split[2] ;
	//$tgl_indo = $bulan[ (int)$split[1] ] . ' ' . $split[0] . ' ' . $split[2] ;
	
	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}
?>