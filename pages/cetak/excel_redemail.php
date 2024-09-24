<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Red_Email-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
ini_set("error_reporting", 1);
include "../../koneksi.php";
//--
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
?>
<body>
<strong>RED CATEGORY EMAIL REPORT</strong><br>
<strong>Periode: <?php echo $Awal; ?> s/d <?php echo $Akhir; ?></strong><br>
<table width="100%" border="1">
    <tr>
      <th bgcolor="#12C9F0">NO.</th>
      <th bgcolor="#12C9F0">TGL EMAIL</th>
      <th bgcolor="#12C9F0">TGL JAWAB</th>
      <th bgcolor="#12C9F0">LEADTIME > 2 HARI</th>
      <th bgcolor="#12C9F0">LANGGANAN</th>
      <th bgcolor="#12C9F0">PO</th>
      <th bgcolor="#12C9F0">ORDER</th>
      <th bgcolor="#12C9F0">HANGER</th>
      <th bgcolor="#12C9F0">LOT</th>
      <th bgcolor="#12C9F0">WARNA</th>
      <th bgcolor="#12C9F0">MASALAH</th>
    </tr>
	<?php 
	$no=1;
	$qry1=mysqli_query($con,"SELECT * FROM tbl_aftersales
  WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts_red='1'");
	while($row1=mysqli_fetch_array($qry1)){
	?>
    <tr>
      <td><?php echo $no;?></td>
      <td><?php echo date("l, d/m/y", strtotime($row1['tgl_email']));?></td>
      <td><?php echo date("l, d/m/y", strtotime($row1['tgl_jawab']));?></td>
      <td><?php if($row1['leadtime_email']=="1 Hari Kerja" OR $row1['leadtime_email']=="2 Hari Kerja"){echo "<font color='#10890C'>$row1[leadtime_email]</font>";}
        else if($row1['leadtime_email']=="3 Hari Kerja" OR $row1['leadtime_email']=="4 Hari Kerja" OR $row1['leadtime_email']=="5 Hari Kerja" OR $row1['leadtime_email']=="6 Hari Kerja"){echo "<font color='#F20505'>$row1[leadtime_email]</font>";}?></td>
      <td><?php echo strtoupper($row1['langganan']);?></td>
      <td><?php echo strtoupper($row1['po']);?></td>
      <td><?php echo strtoupper($row1['no_order']);?></td>
      <td><?php echo strtoupper($row1['no_hanger']);?></td>
      <td><?php echo $row1['lot'];?></td>
      <td><?php echo strtoupper($row1['warna']);?></td>
      <td><?php echo $row1['masalah'];?></td>
  </tr>
    <?php $no++;} ?>
</table>
</body>