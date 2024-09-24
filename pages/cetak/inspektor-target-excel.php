<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=lap-inspeksi-inspektor.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
ini_set("error_reporting", 1);
include "../../koneksi.php";
?>

           <div align="center"> <h1>LAPORAN HARIAN INSPEKTOR DEPT. QCF</h1></div>
<!--script disini -->
Tanggal : <?php echo $_GET['awal']." s/d ".$_GET['akhir'];?>
<table width="100%" border="1">
  <tr>
    <td width="5%"><h4>No</h4></td>
    <td width="34%"><h4>Inspektor</h4></td>
    <td width="17%"><h4>Roll</h4></td>
    <td width="23%"><h4>Qty Bruto</h4></td>
    <td width="21%"><h4>Panjang</h4></td>
  </tr>
  <?php
   	
  $no=1;
  if($_GET['shift']=="ALL"){		
    $Wshift=" ";	
  }else{	
    $Wshift=" AND b.shift='$_GET[shift]' ";	
  }
  if($_GET['gshift']=="ALL"){		
    $WGshift=" ";	
  }else{	
    $WGshift=" AND b.g_shift='$_GET[gshift]' ";	
  }
  if($_GET['personil']=="ALL"){		
    $Wnama=" ";	
  }else{	
    $Wnama=" AND a.personil='$_GET[personil]'  ";	
  }
  $sql=mysqli_query($con,"SELECT
	b.shift,
	b.g_shift,
	a.personil,
	sum( a.jml_rol ) AS rol,
	sum( a.qty ) AS bruto,
	sum( a.yard ) AS panjang  
FROM
  tbl_inspection a
LEFT JOIN 
	tbl_schedule b 
ON 
	a.id_schedule=b.id  
WHERE
	DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' 
	AND '$_GET[akhir]' $Wnama $Wshift $WGshift
GROUP BY a.personil
ORDER BY
	a.personil ASC");
  while($row=mysqli_fetch_array($sql)){
	    ?>
  <tr>
    <td><?php echo $no;?></td>
    <td><?php echo $row['personil'];?></td>
    <td><?php echo $row['rol'];?></td>
    <td><?php echo $row['bruto'];?></td>
    <td><?php echo $row['panjang'];?></td>
  </tr>
  <?php
	  $roll += $row['rol'];
	  $bruto += $row['bruto'];
	  $yds += $row['panjang'];
	  $no++;
	  }
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF" class="table-list1">&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF" class="table-list1">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF" class="table-list1">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Total</strong></td>
    <td align="center" bgcolor="#FFFFFF" class="table-list1"><strong><?php echo $roll;?></strong></td>
    <td align="center" bgcolor="#FFFFFF" class="table-list1"><strong><?php echo number_format($bruto,'2');?></strong></td>
    <td><strong><?php echo number_format($yds,'2');?></strong></td>
  </tr>
</table>
