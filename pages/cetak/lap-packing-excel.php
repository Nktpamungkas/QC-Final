<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Lap-Packing-".date($_GET['awal']).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
ini_set("error_reporting", 1);
include "../../koneksi.php";
?>

           <div align="center"> <h1>LAPORAN HARIAN PACKING DEPT. QCF</h1></div>
<!--script disini -->
<?php 
if($_GET['awal']!="" and $_GET['akhir']!=""){$tgl=$_GET['awal']; $tgl1=$_GET['akhir']; $shift=$_GET['shift'];}
else{$tgl=$_GET['awal']; $tgl1=$_GET['akhir']; $shift=$_GET['shift'];}
?>
Tanggal : <?php echo $tgl;?> s/d <?php echo $tgl1;?><br>
Shift 	: <?php echo $shift;?><br>
Group	: <?php echo $_GET['group'];?><br>
No MC 	: <?php echo $_GET['nomc'];?>
<table width="100%" border="1">
  <tr>
    <th valign="middle" bgcolor="#006699"><font color="#FFFFFF" ><strong>No</strong></font></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Pelanggan</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >No Order</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Jenis Kain</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >No Item</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Warna</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Tgl Pengiriman</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Lot</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Group</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >No MC</font></strong></th>
    <th bgcolor="#006699"><strong><font color="#FFFFFF" >Bruto</font></strong></th>
    <th bgcolor="#006699"><strong><font color="#FFFFFF" >Netto</font></strong></th>
    <th valign="middle" bgcolor="#006699"><font color="#FFFFFF" ><strong>Yard/Meter</strong></font></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Proses</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Status</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Jam Mutasi</font></strong></th>
    <th valign="middle" bgcolor="#006699"><strong><font color="#FFFFFF" >Catatan</font></strong></th>
  </tr>
  <?php
  if($shift!="ALL"){$shft=" AND `shift`='$shift' ";}else{$shft=" ";}
  if($_GET['nomc']!="ALL"){ $nomc=" AND `no_mc` LIKE '%$_GET[nomc]' ";}else{$nomc=" ";}
  if($_GET['group']!="ALL"){ $grp=" AND `inspektor` LIKE '%$_GET[group]' ";}else{$grp=" ";}
  $no=1;
  $sql=mysqli_query($con,"SELECT * FROM tbl_lap_inspeksi WHERE `tgl_update` BETWEEN '$tgl' and '$tgl1' ".$shft." ".$nomc." ".$grp." AND `dept`='PACKING' ORDER BY id ASC");
  while($row=mysqli_fetch_array($sql)){
	  $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
  <tr bgcolor="<?php echo $bgcolor;?>">
  <td><?php echo $no;?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo $row['no_item'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><?php echo $row['tgl_pengiriman'];?></td>
    <td>'<?php echo $row['lot'];?></td>
    <td><?php echo $row['inspektor'];?></td>
    <td><?php echo $row['no_mc'];?></td>
    <td><?php echo $row['jml_roll']."x".$row['bruto'];?></td>
    <td><?php echo $row['netto'];?></td>
    <td><?php echo $row['panjang'];?></td>
    <td><?php echo $row['satuan'];?></td>
    <td><?php echo $row['proses'];?></td>
    <td><?php echo $row['status'];?></td>
    <td><?php echo $row['catatan'];?></td>
  </tr>
  <?php $no++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
