<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$idnsp=$_POST['idnsp'];
if ($_POST) {
    extract($_POST);
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $analisa =mysqli_real_escape_string($con,$_POST['analisa']);
  $pencegahan =mysqli_real_escape_string($con,$_POST['pencegahan']);
  $kg1 =mysqli_real_escape_string($con,$_POST['kg1']);
  $kg2 =mysqli_real_escape_string($con,$_POST['kg2']);
  $kg3 =mysqli_real_escape_string($con,$_POST['kg3']);
  $pjg1 =mysqli_real_escape_string($con,$_POST['pjg1']);
  $pjg2 =mysqli_real_escape_string($con,$_POST['pjg2']);
  $pjg3 =mysqli_real_escape_string($con,$_POST['pjg3']);
  $satuan1 =mysqli_real_escape_string($con,$_POST['satuan1']);
  $satuan2 =mysqli_real_escape_string($con,$_POST['satuan2']);
  $satuan3 =mysqli_real_escape_string($con,$_POST['satuan3']);
  $tjawab =mysqli_real_escape_string($con,$_POST['t_jawab']);
  $tjawab1 =mysqli_real_escape_string($con,$_POST['t_jawab1']);
  $tjawab2 =mysqli_real_escape_string($con,$_POST['t_jawab2']);
  $persen =mysqli_real_escape_string($con,$_POST['persen']);
  $persen1 =mysqli_real_escape_string($con,$_POST['persen1']);
  $persen2 =mysqli_real_escape_string($con,$_POST['persen2']);
  $qty_email =mysqli_real_escape_string($con,$_POST['qty_email']);
  $pjg_email =mysqli_real_escape_string($con,$_POST['pjg_email']);
  $satuan_email =mysqli_real_escape_string($con,$_POST['satuan_email']);
  $masalah= mysqli_real_escape_string($con,$_POST['masalah']);
  $sub_defect= mysqli_real_escape_string($con,$_POST['sub_defect']);
  $checkbox1=$_POST['penyebab'];
  $chkp="";
    foreach($checkbox1 as $chk1)  
   		  {  
      		$chkp .= $chk1.",";  
        }
    $sqlupdate=mysqli_query($con,"UPDATE `tbl_ganti_kain` SET
		    `analisa`='$analisa',
        `pencegahan`='$pencegahan',
        `kg1`='$kg1',
        `kg2`='$kg2',
        `kg3`='$kg3',
        `pjg1`='$pjg1',
        `pjg2`='$pjg2',
        `pjg3`='$pjg3',
        `satuan1`='$satuan1',
        `satuan2`='$satuan2',
        `satuan3`='$satuan3',
        `t_jawab`='$tjawab',
        `t_jawab1`='$tjawab1',
        `t_jawab2`='$tjawab2',
        `persen`='$persen',
        `persen1`='$persen1',
        `persen2`='$persen2',
        `qty_email`='$qty_email',
        `pjg_email`='$pjg_email',
        `satuan_email`='$satuan_email',
        `masalah`='$masalah',
        `sub_defect`='$sub_defect',
        `sebab`='$chkp'
				WHERE `id`='$id' LIMIT 1");
    echo "<script>swal({
      title: 'Data Telah diUbah',
      text: 'Klik Ok untuk melanjutkan',
      type: 'success',
      }).then((result) => {
      if (result.value) {
        window.location='TambahBon-$idnsp';
      }
    });</script>";
}
