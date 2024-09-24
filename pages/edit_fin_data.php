<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if ($_POST) {
    extract($_POST);
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $jmlperbaikan = mysqli_real_escape_string($con,$_POST['jmlperbaikan']);
	$mesin = mysqli_real_escape_string($con,$_POST['mesin']);
	$mcperbaikan = mysqli_real_escape_string($con,$_POST['mesin_perbaikan']);
	$shift = mysqli_real_escape_string($con,$_POST['shift']);
	$kategori = mysqli_real_escape_string($con,$_POST['kategori']);
	$penyebab = mysqli_real_escape_string($con,$_POST['penyebab']);
	$perbaikan = mysqli_real_escape_string($con,$_POST['perbaikan']);
    $sqlupdate=mysqli_query($con,"UPDATE `tbl_ncp_qcf_new` SET
				`penyebab`='$penyebab',
		  		`perbaikan`='$perbaikan',
				`mesin`='$mesin',
				`mesin_perbaikan`='$mcperbaikan',
				`jml_perbaikan`='$jmlperbaikan',
				`shift`='$shift',
				`kategori`='$kategori',
				`tgl_update`=now()
				WHERE `id`='$id' LIMIT 1");
    //echo " <script>window.location='?p=Batas-Produksi';</script>";
    echo "<script>swal({
  title: 'Data Telah diUbah',
  text: 'Klik Ok untuk melanjutkan',
  type: 'success',
  }).then((result) => {
  if (result.value) {
    window.location='./StatusNCPNew';
  }
});</script>";
}
