<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$idnsp=$_POST['idnsp'];
if ($_POST) {
    extract($_POST);
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $status=str_replace("'","''",$_POST['status']);
    $tgl_packing=$_POST['tgl_packing'];
    $serah_qai=$_POST['serah_qai'];
    $ket=str_replace("'","''",$_POST['ket']);
    $masalah=str_replace("'","''",$_POST['masalah']);
    $penyelidik_qcf=str_replace("'","''",$_POST['penyelidik_qcf']);
    $tgl_kpe=str_replace("'","''",$_POST['tgl_kpe']);
    $tgl_conform=str_replace("'","''",$_POST['tgl_conform']);
    $cegah_qcf=str_replace("'","''",$_POST['cegah_qcf']);
    $kpi=str_replace("'","''",$_POST['no_kpi']);
    $ft=str_replace("'","''",$_POST['no_ft']);
    $kpe=str_replace("'","''",$_POST['no_kpe']);
    $qty=str_replace("'","''",$_POST['qty']);
    $sqlupdate=mysqli_query($con,"UPDATE `tbl_tpukpe` SET
		`status`='$status',
    `masalah`='$masalah',
		`tgl_packing`='$tgl_packing',
		`serah_qai`='$serah_qai',
		`ket`='$ket',
    `penyelidik_qcf`='$penyelidik_qcf',
    `cegah_qcf`='$cegah_qcf',
    `tgl_kpe`='$tgl_kpe',
    `tgl_conform`='$tgl_conform',
    `qty`='$qty',
    `masalah_dominan`='$_POST[masalah_dominan]',
    `t_jawab`='$_POST[t_jawab]',
		`t_jawab1`='$_POST[t_jawab1]',
		`t_jawab2`='$_POST[t_jawab2]',
    `tgl_update`=now()
				WHERE `id`='$id' LIMIT 1");
    echo "<script>swal({
      title: 'Data Telah diUbah',
      text: 'Klik Ok untuk melanjutkan',
      type: 'success',
      }).then((result) => {
      if (result.value) {
        window.location='TambahTPUKPE-$idnsp';
      }
    });</script>";
}
