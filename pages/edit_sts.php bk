<?php
if ($_POST) {
    extract($_POST);
    $id = mysql_real_escape_string($_POST['id']);
    $sts =mysql_real_escape_string($_POST['sts']);
	$peninjau =mysql_real_escape_string($_POST['disposisi']);
	$catat =mysql_real_escape_string($_POST['catat']);
	$ck1 =mysql_real_escape_string($_POST['ck1']);
	$ck2 =mysql_real_escape_string($_POST['ck2']);
	$ck3 =mysql_real_escape_string($_POST['ck3']);
	$ck4 =mysql_real_escape_string($_POST['ck4']);
	if($_POST[tgl_kembali]!=""){$tkembali=" `tgl_kembali`='$_POST[tgl_kembali]', "; }else{ $tkembali=" `tgl_kembali`=null,";}
	if($_POST[tgl_serah]!=""){$tserah=" `tgl_serah`='$_POST[tgl_serah]', ";}else{ $tserah=" `tgl_serah`=null, ";}
	if($_POST[tgl_selesai]!=""){$tselesai=" `tgl_selesai`='$_POST[tgl_selesai]', ";}else{ $tselesai=" `tgl_selesai`=null,";}
    $sqlupdate=mysql_query("UPDATE `tbl_ncp_qcf` SET
				`status`='$sts',
				`peninjau_akhir`='$peninjau',
				`catat_verify`='$catat',
				`ck1`='$ck1',
				`ck2`='$ck2',
				`ck3`='$ck3',
				`ck4`='$ck4',
				$tkembali
				$tserah
				$tselesai
				`tgl_update`=now()
				WHERE `id`='$id' LIMIT 1");
    //echo " <script>window.location='?p=Batas-Produksi';</script>";
    echo "<script>swal({
  title: 'Data Telah diUbah',
  text: 'Klik Ok untuk melanjutkan',
  type: 'success',
  }).then((result) => {
  if (result.value) {
    window.location='./StatusNCP';
  }
});</script>";
}
