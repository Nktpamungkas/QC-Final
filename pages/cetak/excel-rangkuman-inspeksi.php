<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=rangkuman-inspeksi-".date($_GET['awal'])." sd ".date($_GET['akhir']).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
ini_set("error_reporting", 1);
include "../../koneksi.php";
?>
<?php
$Awal	= isset($_GET['awal']) ? $_GET['awal'] : '';
$Akhir	= isset($_GET['akhir']) ? $_GET['akhir'] : '';
$Dept	= isset($_GET['dept']) ? $_GET['dept'] : '';
$Shift	= isset($_GET['shift']) ? $_GET['shift'] : '';
$GShift	= isset($_GET['gshift']) ? $_GET['gshift'] : '';	
$Proses	= isset($_GET['proses']) ? $_GET['proses'] : '';	
$jamA	= isset($_GET['jam_awal']) ? $_GET['jam_awal'] : '';
$jamAr	= isset($_GET['jam_akhir']) ? $_GET['jam_akhir'] : '';
$Buyer	= isset($_GET['buyer']) ? $_GET['buyer'] : '';	
if(strlen($jamA)==5){
	$start_date = $Awal.' '.$jamA;
}else{ 
	$start_date = $Awal.' 0'.$jamA;
}	
if(strlen($jamAr)==5){
	$stop_date  = $Akhir.' '.$jamAr;
}else{ 
	$stop_date  = $Akhir.' 0'.$jamAr;
}	
?>

<div align="center"> <h1>RANGKUMAN INSPEKSI QC</h1></div>
<!--script disini -->
<?php 
if($_GET['awal']!=""){$tgl=$_GET['awal'];$tgl1=$_GET['akhir'];}else{$tgl=$_GET['awal'];$tgl1=$_GET['akhir'];}
?>
Tanggal : <?php echo $tgl." s/d ".$tgl1;?>
<table width="100%" border="1">
  <tr>
    <td rowspan="2"><div align="center"><h4>Shift</h4></div></td>
    <td colspan="2"><div align="center"><h4>FIN</h4></div></td>
    <td rowspan="2"><div align="center"><h4>PR</h4></div></td>
    <td rowspan="2"><div align="center"><h4>Oven</h4></div></td>
    <td rowspan="2"><div align="center"><h4>Pisah</h4></div></td>
    <td rowspan="2"><div align="center"><h4>Perbaikan</h4></div></td>
    <td rowspan="2"><div align="center"><h4>Kragh</h4></div></td>
    <td colspan="2"><div align="center"><h4>ALL</h4></div></td>
    <td rowspan="2"><div align="center"><h4>Inspektor</h4></div></td>
  </tr>
  <tr>
    <td><div align="center"><h4>OK</h4></div></td>
    <td><div align="center"><h4>X</h4></div></td>
    <td><div align="center"><h4>Kg</h4></div></td>
    <td><div align="center"><h4>Yard</h4></div></td>
  </tr>
  <?php
 if($Shift=="ALL"){		
	$Wshift=" ";	
	}else{	
	$Wshift=" b.shift='$Shift' AND ";	
	}
	if($GShift=="ALL"){		
	$WGshift=" ";	
	}else{	
	$WGshift=" b.g_shift='$GShift' AND ";	
	}	
	if($Proses==""){		
	$WProses=" ";	
	}else{	
	$WProses=" b.proses='$Proses' AND ";	
	}
	if($Buyer!=""){ $WBuyer=" AND b.buyer='$Buyer' ";}else{ $WBuyer=" ";}		
	$qry1=mysqli_query($con,"SELECT
	COUNT(DISTINCT a.personil) as inspektor,
	sum( a.qty ) AS bruto,
	sum( a.yard ) AS panjang,
  b.g_shift,
  	SUM(IF(c.status_produk = '1' AND (b.proses='Inspect Finish' OR b.proses='Inspect Packing' OR b.proses='Inspect White' OR b.proses='Inspect Qty Kecil'),a.qty,0)) AS `sts_ok`,
	SUM(IF(c.status_produk = '2' AND (b.proses='Inspect Finish' OR b.proses='Inspect Packing' OR b.proses='Inspect White' OR b.proses='Inspect Qty Kecil'),a.qty,0)) AS `sts_x`,	
	SUM(IF(c.status_produk = '3' AND (b.proses='Inspect Finish' OR b.proses='Inspect Packing' OR b.proses='Inspect White' OR b.proses='Inspect Qty Kecil'),a.qty,0)) AS `sts_pr`,
	sum(if(b.proses='Inspect Finish',a.qty,0)) as `sts_fin`,
	sum(if(b.proses='Inspect Oven',a.qty,0)) as `sts_oven`,	
	sum(if(b.proses='Pisah',a.qty,0)) as `sts_pisah`,
	sum(if(b.proses='Perbaikan' OR b.proses='Perbaikan Grade' OR b.proses='Tandai Defect' OR b.proses='Inspect Ulang (Setelah Perbaikan)',a.qty,0)) as `sts_perbaikan`,
	sum(if(b.proses='Kragh',a.qty,0)) as `sts_kragh`,
	sum(a.qty) as `sts_tot`,
	sum(a.yard) as `sts_yard`
FROM
	tbl_inspection a 
INNER JOIN tbl_schedule b ON a.id_schedule = b.id
INNER JOIN tbl_gerobak c ON c.id_schedule = b.id
WHERE
    $Wshift $WGshift $WProses
	DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$start_date' 
	AND '$stop_date' and a.`status`='selesai'
GROUP BY b.g_shift	");
		$totOKS=0;$totXS=0;$totPRS=0;$totFINS=0;$totOVENS=0;$totPisahS=0;$totPerbaikanS=0;$totKraghS=0;$totTOTS=0;$totYardS=0;
		$pOK=0;$pX=0;$pPR=0;$pF=0;$pO=0;$pP=0;$pPb=0;$pKr=0;$pT=0;
			while($row1=mysqli_fetch_array($qry1)){
  ?>
    <tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
      <td align="center"><?php echo $row1['g_shift']; ?></td>
      <td align="right"><?php echo $row1['sts_ok']; ?></td>
      <td align="right"><?php echo $row1['sts_x']; ?></td>
      <td align="right"><?php echo $row1['sts_pr']; ?></td>
      <td align="right"><?php echo $row1['sts_oven']; ?></td>
      <td align="right"><?php echo $row1['sts_pisah']; ?></td>
			<td align="right"><?php echo $row1['sts_perbaikan']; ?></td>
			<td align="right"><?php echo $row1['sts_kragh']; ?></td>
      <td align="right"><?php echo $row1['sts_tot']; ?></td>
			<td align="right"><?php echo $row1['sts_yard']; ?></td>
      <td align="center"><?php echo $row1['inspektor']; ?></td>            
    </tr>          
  <?php 
        $totOKS+=$row1['sts_ok'];
				$totXS+=$row1['sts_x'];
				$totPRS+=$row1['sts_pr'];
				$totFINS+=$row1['sts_fin'];
				$totOVENS+=$row1['sts_oven'];
				$totPisahS+=$row1['sts_pisah'];
				$totPerbaikanS+=$row1['sts_perbaikan'];
				$totKraghS+=$row1['sts_kragh'];
				$totTOTS+=$row1['sts_tot'];
				$totYardS+=$row1['sts_yard'];
				
				$no++;  } 
				if($Awal!=""){
				if($totTOTS==0){$pOK=0;}else{$pOK=round(($totOKS/$totTOTS)*100,2);}
				if($totTOTS==0){$pX=0;}else{$pX=round(($totXS/$totTOTS)*100,2);}
				if($totTOTS==0){$pPR=0;}else{$pPR=round(($totPRS/$totTOTS)*100,2);}
				if($totTOTS==0){$pF=0;}else{$pF=round(($totFINS/$totTOTS)*100,2);}
				if($totTOTS==0){$pO=0;}else{$pO=round(($totOVENS/$totTOTS)*100,2);}
				if($totTOTS==0){$pP=0;}else{$pP=round(($totPisahS/$totTOTS)*100,2);}
				if($totTOTS==0){$pPb=0;}else{$pPb=round(($totPerbaikanS/$totTOTS)*100,2);}
				if($totTOTS==0){$pKr=0;}else{$pKr=round(($totKraghS/$totTOTS)*100,2);}
				$pT=round($pF+$pO+$pP+$pPb+$pKr,0);
				} 
  ?>
    <tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
      <td align="center">Tot</td>
      <td align="right"><?php echo $totOKS; ?></td>
      <td align="right"><?php echo $totXS; ?></td>
      <td align="right"><?php echo $totPRS; ?></td>
      <td align="right"><?php echo $totOVENS; ?></td>
      <td align="right"><?php echo $totPisahS; ?></td>
			<td align="right"><?php echo $totPerbaikanS; ?></td>
			<td align="right"><?php echo $totKraghS; ?></td>
      <td align="right"><?php echo $totTOTS; ?></td>
			<td align="right"><?php echo $totYardS; ?></td>
      <td align="center">&nbsp;</td>
    </tr>
	  <tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
	  	<td align="center">%</td>
	  	<td align="center"><?php echo $pOK; ?></td>
	  	<td align="center"><?php echo $pX; ?></td>
	  	<td align="center"><?php echo $pPR; ?></td>
	  	<td align="center"><?php echo $pO; ?></td>
	  	<td align="center"><?php echo $pP; ?></td>
			<td align="center"><?php echo $pPb; ?></td>
			<td align="center"><?php echo $pKr; ?></td>
	  	<td align="center"><?php echo $pT; ?></td>
	  	<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
	  </tr>
		<?php 
			$qrySI=mysqli_query($con,"SELECT SUM(bruto) AS kg, COUNT(*) AS sisa_kk FROM tbl_schedule WHERE NOT STATUS = 'selesai' AND `status`='antri mesin' AND NOT proses='Perbaikan'"); 
			$rSI=mysqli_fetch_array($qrySI); 
			$qrySPR=mysqli_query($con,"SELECT COUNT(*) AS kk_pr, SUM(a.bruto-b.qty) AS qty_pr
			FROM tbl_schedule a 
			LEFT JOIN tbl_inspection b ON a.id=b.id_schedule
			LEFT JOIN tbl_gerobak c ON a.id=c.id_schedule 
			WHERE DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$start_date' 
			AND '$stop_date' AND a.status='selesai' AND c.status_produk = '3'");
			$rSPR=mysqli_fetch_array($qrySPR);
		  ?>
		  <tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
	  		<td align="center" colspan="3">SISA SIAP INSPECT</td>
	  		<td align="left" ><?php if($_POST['awal']!=""){echo $rSI['kg'];}else{echo "0";} ?></td>
			  <td align="left" ><?php if($_POST['awal']!=""){echo $rSI['sisa_kk']." KK";}else{echo "0";} ?></td>
			  <td align="center" colspan="2">SISA PR</td>
			  <td align="left" colspan="2"><?php if($_POST['awal']!=""){echo $rSPR['qty_pr'];}else{echo "0";} ?></td>
			  <td align="left" colspan="2"><?php if($_POST['awal']!=""){echo $rSPR['kk_pr']." KK";}else{echo "0";} ?></td>
	    </tr>
		  <?php 
			$qrySP=mysqli_query($con,"SELECT SUM(bruto) AS kg, COUNT(*) AS sisa_kk FROM tbl_schedule WHERE NOT STATUS = 'selesai' AND `status`='antri mesin' AND proses='Perbaikan'"); 
			$rSP=mysqli_fetch_array($qrySP); 
		  ?>
		  <tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
	  		<td align="center" colspan="3">SISA SIAP INSPECT PERBAIKAN</td>
	  		<td align="left" ><?php if($_POST['awal']!=""){echo $rSP['kg'];}else{echo "0";} ?></td>
			  <td align="left" ><?php if($_POST['awal']!=""){echo $rSP['sisa_kk']." KK";}else{echo "0";} ?></td>
			  <td align="center" colspan="2"></td>
			  <td align="left" colspan="2"></td>
			  <td align="left" colspan="2"></td>
	    </tr>
</table>
<br>
<table width="100%" border="1"  >
  <tr>
    <td colspan="3"><div align="center"><h4>SUMMARY LAPORAN INSPECT 2022</h4></div></td>
  </tr>
  <tr>
    <td><div align="center"><h4>BULAN</h4></div></td>
    <td><div align="center"><h4>KG</h4></div></td>
    <td><div align="center"><h4>YARD</h4></div></td>
  </tr>
  <?php
  $sqlr=mysqli_query($con,"SELECT 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-01-01 07:00' and '2022-01-31 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-02-01 07:00' and '2022-02-28 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-03-01 07:00' and '2022-03-31 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-04-01 07:00' and '2022-04-30 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-05-01 07:00' and '2022-05-31 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-06-01 07:00' and '2022-06-30 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-07-01 07:00' and '2022-07-31 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-08-01 07:00' and '2022-08-31 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-09-01 07:00' and '2022-09-30 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-10-01 07:00' and '2022-10-31 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-11-01 07:00' and '2022-11-30 07:00' and a.status ='selesai'
  union
  select 
  date_format(a.tgl_update, '%m') as bulan,
  SUM(a.qty) as jml_qty,
  SUM(a.yard) as jml_yard
  FROM
    db_qc.tbl_inspection a 
  INNER JOIN db_qc.tbl_schedule b ON a.id_schedule = b.id
  INNER JOIN db_qc.tbl_gerobak c ON c.id_schedule = b.id
  where date_format(a.tgl_update, '%Y-%m-%d %H:%i') between '2022-12-01 07:00' and '2022-12-31 07:00' and a.status ='selesai'");
  while($row=mysqli_fetch_array($sqlr)){
  ?>
    <tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
      <td align="center"><?php echo $row['bulan']; ?></td>
      <td align="center"><?php echo $row['jml_qty']; ?></td>
      <td align="center"><?php echo $row['jml_yard']; ?></td>           
    </tr>
  <?php } ?>   
</table>
