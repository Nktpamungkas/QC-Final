<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Nego_Aftersales-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
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
$GShift=$_GET['shft'];
$Subdept=$_GET['subdept'];
$TotalKirim=$_GET['total'];
$TotalLot=$_GET['total_lot'];
$Langganan=$_GET['langganan'];
$Nego1=$_GET['nego'];
?>
<body>
<strong>LAPORAN KELUHAN PELANGGAN EKSTERNAL &quot;DISPOSISI NEGO AFTERSALES&quot;</strong><br>
<strong>Periode: <?php echo $Awal; ?> s/d <?php echo $Akhir; ?></strong><br>
<table width="100%" border="1">
    <tr>
      <th bgcolor="#12C9F0">NO.</th>
      <th bgcolor="#12C9F0">LANGGANAN</th>
      <th bgcolor="#12C9F0">ORDER</th>
      <th bgcolor="#12C9F0">JENIS KAIN</th>
      <th bgcolor="#12C9F0">LEBAR &amp; GRAMASI</th>
      <th bgcolor="#12C9F0">LOT</th>
      <th bgcolor="#12C9F0">WARNA</th>
      <th bgcolor="#12C9F0">QTY KIRIM</th>
      <th bgcolor="#12C9F0">QTY KELUHAN</th>
      <th bgcolor="#12C9F0">MASALAH</th>
      <th bgcolor="#12C9F0">SOLUSI</th>
      <th bgcolor="#12C9F0">NAMA PEJABAT</th>
      <th bgcolor="#12C9F0">HASIL NEGOSIASI</th>
      <th bgcolor="#12C9F0">KETERANGAN</th>
      <th bgcolor="#12C9F0">&nbsp;</th>
    </tr>
	<?php 
	$no=1;
	if($_GET['awal']!=""){ $Where =" AND DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' AND nama_nego!='' "; }
  if($_GET['shft']=="ALL" or $_GET['shft']==""){ $shft=" ";}else{$shft=" AND shift LIKE '$_GET[shft]' OR shift2 LIKE '$_GET[shft]' ";}
  if($_GET['subdept']!=""){ $subdpt=" AND subdept='$_GET[subdept]' "; }
  if($_GET['nego']=="1"){ $nego =" AND sts_nego='1' "; }else{$nego = " ";}
  //if($_GET['langganan']!=""){ $lgn =" AND langganan LIKE '%$_GET[langganan]%' "; }else{$lgn = " ";}
  //$qry1=mysqli_query($con,"SELECT * FROM tbl_aftersales $Where $shft $subdpt $nego $lgn ORDER BY nama_nego ASC");
  if($Awal!="" or $GShift!="" or $Subdept!="" or $Nego1=="1" or $Langganan!=""){
    $qry1=mysqli_query($con,"SELECT * FROM tbl_aftersales WHERE langganan LIKE '%$_GET[langganan]%' AND checknego!='' $Where $nego $shft $subdpt ORDER BY pejabat,personil ASC");
    }else{
    $qry1=mysqli_query($con,"SELECT * FROM tbl_aftersales WHERE langganan LIKE '$_GET[langganan]'  AND checknego!='' $Where $nego $shft $subdpt ORDER BY pejabat,personil ASC");
    }
  $tkirim=0;
  $tclaim=0;
			while($row1=mysqli_fetch_array($qry1)){
				if($row1['t_jawab']!="" and $row1['t_jawab1']!="" and $row1['t_jawab2']!=""){ $tjawab=$row1['t_jawab'].",".$row1['t_jawab1'].", ".$row1['t_jawab2'];
				}else if($row1['t_jawab']!="" and $row1['t_jawab1']!="" and $row1['t_jawab2']==""){
				$tjawab=$row1['t_jawab'].",".$row1['t_jawab1'];	
				}else if($row1['t_jawab']!="" and $row1['t_jawab1']=="" and $row1['t_jawab2']!=""){
				$tjawab=$row1['t_jawab'].",".$row1['t_jawab2'];	
				}else if($row1['t_jawab']=="" and $row1['t_jawab1']!="" and $row1['t_jawab2']!=""){
				$tjawab=$row1['t_jawab1'].",".$row1['t_jawab2'];	
				}else if($row1['t_jawab']!="" and $row1['t_jawab1']=="" and $row1['t_jawab2']==""){
				$tjawab=$row1['t_jawab'];
				}else if($row1['t_jawab']=="" and $row1['t_jawab1']!="" and $row1['t_jawab2']==""){
				$tjawab=$row1['t_jawab1'];
				}else if($row1['t_jawab']=="" and $row1['t_jawab1']=="" and $row1['t_jawab2']!=""){
				$tjawab=$row1['t_jawab2'];	
				}else if($row1['t_jawab']=="" and $row1['t_jawab1']=="" and $row1['t_jawab2']==""){
				$tjawab="";	
				}
	?>
    <tr>
      <td><?php echo $no;?></td>
      <td><?php echo strtoupper($row1['langganan']);?></td>
      <td><?php echo strtoupper($row1['no_order']);?></td>
      <td><?php echo strtoupper($row1['jenis_kain']);?></td>
      <td><?php echo $row1['lebar']."x".$row1['gramasi'];?></td>
      <td><?php echo strtoupper($row1['lot']);?></td>
      <td><?php echo strtoupper($row1['warna']);?></td>
      <td><?php echo strtoupper($row1['qty_kirim']);?></td>
      <td><?php echo strtoupper($row1['qty_claim']);?></td>
      <td><?php echo $row1['masalah'];?></td>
      <td><?php echo $row1['solusi'];?></td>
      <td><?php echo $row1['nama_nego'];?></td>
      <td><?php echo $row1['hasil_nego'];?></td>
      <td><?php echo $row1['ket'];?></td>
      <td><?php if($row1['checknego']=="Ceklis"){echo "&#10004";}else{echo "X";}?></td>
  </tr>
    <?php $no++; 
  $tkirim=$tkirim+$row1['qty_kirim'];
  $tclaim=$tclaim+$row1['qty_claim'];} ?>
  <tr>
    <td colspan="7" align="right"><strong>TOTAL</strong></td>
    <td align="right"><strong><?php echo $tkirim;?></strong></td>
    <td align="right"><strong><?php echo $tclaim;?></strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<br>
<strong>DETAIL HASIL NEGOSIASI</strong><br>
<table width="100%" border="1">
  <tr>
    <td align="center" width="15%"><strong>Nama</strong></td>
    <td align="center" width="5%"><strong>Qty Keluhan</strong></td>
    <td align="center" width="5%"><strong>% (Qty Keluhan)</strong></td>
    <td align="center" width="7%"><strong>Total Kasus</strong></td>
    <td align="center" width="7%"><strong>Gagal Negosiasi</strong></td>
    <td align="center" width="5%"><strong>% (Total Kasus)</strong></td>
    <td align="center" width="5%"><strong>% Keberhasilan Negosiasi</strong></td>
    <!-- <td align="center" width="10%" colspan="12"><strong>SOLUSI</strong></td> -->
  </tr>
  <!-- <tr>
    <td align="center" width="10%" colspan="2"><strong>OK (NEGOSIASI)</strong></td>
    <td align="center" width="10%" colspan="2"><strong>RETUR</strong></td>
    <td align="center" width="10%" colspan="2"><strong>CUTTING LOSS (GANTI KAIN)</strong></td>
    <td align="center" width="10%" colspan="2"><strong>PERBAIKAN GARMENT</strong></td>
    <td align="center" width="10%" colspan="2"><strong>LETTER OF GUARANTEE (LG)</strong></td>
    <td align="center" width="10%" colspan="2"><strong>DEBIT NOTE</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>LOT</strong></td>
    <td align="center"><strong>KG</strong></td>
    <td align="center"><strong>LOT</strong></td>
    <td align="center"><strong>KG</strong></td>
    <td align="center"><strong>LOT</strong></td>
    <td align="center"><strong>KG</strong></td>
    <td align="center"><strong>LOT</strong></td>
    <td align="center"><strong>KG</strong></td>
    <td align="center"><strong>LOT</strong></td>
    <td align="center"><strong>KG</strong></td>
    <td align="center"><strong>LOT</strong></td>
    <td align="center"><strong>KG</strong></td>
  </tr> -->
  <tr>
    <?php
      if($_GET['langganan']!=""){ $lgn =" AND langganan LIKE '%$_GET[langganan]%' "; }else{$lgn = " ";}
      $qry1=mysqli_query($con,"SELECT nama_nego FROM tbl_aftersales WHERE
      DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
      AND '$Akhir' AND sts_nego='1' AND checknego!='' $lgn GROUP BY nama_nego"); 
      $tot_a=0;
      while($row1=mysqli_fetch_array($qry1)){
      $qryTotal = mysqli_query($con,"SELECT COUNT(checknego) AS total_lot_nego FROM tbl_aftersales WHERE checknego!='' 
      AND DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND nama_nego!='' AND sts_nego='1' $lgn");
      $rTotal=mysqli_fetch_array($qryTotal);
      $qryBN = mysqli_query($con,"SELECT COUNT(checknego) AS total_berhasil_nego FROM tbl_aftersales WHERE checknego='Ceklis' 
      AND DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND nama_nego='$row1[nama_nego]' AND sts_nego='1' $lgn");
      $rBN=mysqli_fetch_array($qryBN);
      $qryGN = mysqli_query($con,"SELECT COUNT(checknego) AS total_gagal_nego FROM tbl_aftersales WHERE checknego='Silang' 
      AND DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND nama_nego='$row1[nama_nego]' AND sts_nego='1' $lgn");
      $rGN=mysqli_fetch_array($qryGN);
      $qryDQ=mysqli_query($con,"SELECT SUM(qty_claim) as qty_claim FROM tbl_aftersales WHERE
      DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
      AND '$Akhir' AND sts_nego='1' AND checknego!='' AND nama_nego='$row1[nama_nego]' $lgn");
      $rDQ=mysqli_fetch_array($qryDQ);
      $qryjml=mysqli_query($con,"SELECT COUNT(*) as jml FROM tbl_aftersales WHERE
      DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
      AND '$Akhir' AND sts_nego='1' AND checknego!='' AND nama_nego='$row1[nama_nego]' $lgn");
      $rowjml=mysqli_fetch_array($qryjml);
      $qryOK=mysqli_query($con,"SELECT COUNT(*) as jml, SUM(qty_claim) as qty_claim FROM tbl_aftersales WHERE
      DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
      AND '$Akhir' AND sts_nego='1' AND checknego!='' AND nama_nego='$row1[nama_nego]' AND solusi='OK (NEGOSIASI)' $lgn");
      $rowOK=mysqli_fetch_array($qryOK);
      $qryR=mysqli_query($con,"SELECT COUNT(*) as jml, SUM(qty_claim) as qty_claim FROM tbl_aftersales WHERE
      DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
      AND '$Akhir' AND sts_nego='1' AND checknego!='' AND nama_nego='$row1[nama_nego]' AND solusi='RETUR' $lgn");
      $rowR=mysqli_fetch_array($qryR);
      $qryCut=mysqli_query($con,"SELECT COUNT(*) as jml, SUM(qty_claim) as qty_claim FROM tbl_aftersales WHERE
      DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
      AND '$Akhir' AND sts_nego='1' AND checknego!='' AND nama_nego='$row1[nama_nego]' AND solusi='CUTTING LOSS (GANTI KAIN)' $lgn");
      $rowCut=mysqli_fetch_array($qryCut);
      $qryPG=mysqli_query($con,"SELECT COUNT(*) as jml, SUM(qty_claim) as qty_claim FROM tbl_aftersales WHERE
      DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
      AND '$Akhir' AND sts_nego='1' AND checknego!='' AND nama_nego='$row1[nama_nego]' AND solusi='PERBAIKAN GARMENT' $lgn");
      $rowPG=mysqli_fetch_array($qryPG);
      $qryLG=mysqli_query($con,"SELECT COUNT(*) as jml, SUM(qty_claim) as qty_claim FROM tbl_aftersales WHERE
      DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
      AND '$Akhir' AND sts_nego='1' AND checknego!='' AND nama_nego='$row1[nama_nego]' AND solusi='LETTER OF GUARANTEE (LG)' $lgn");
      $rowLG=mysqli_fetch_array($qryLG);
      $qryDN=mysqli_query($con,"SELECT COUNT(*) as jml, SUM(qty_claim) as qty_claim FROM tbl_aftersales WHERE
      DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
      AND '$Akhir' AND sts_nego='1' AND checknego!='' AND nama_nego='$row1[nama_nego]' AND solusi='DEBIT NOTE' $lgn");
      $rowDN=mysqli_fetch_array($qryDN);
      ?>
      <td align="left"><?php echo $row1['nama_nego']?></td>
      <td align="right"><?php echo number_format($rDQ['qty_claim'],2)." Kg";?></td>
      <td align="center"><?php echo number_format(($rDQ['qty_claim']/$TotalKirim)*100,2)." %";?></td>
      <td align="center"><?php echo $rowjml['jml']." Kasus"; ?></td>
      <td align="center"><?php echo $rGN['total_gagal_nego']." Kasus"; ?></td>
      <td align="center"><?php echo number_format(($rowjml['jml']/$TotalLot)*100,2)." %";?></td>
      <td align="center"><?php echo number_format((100-($rGN['total_gagal_nego']/$rowjml['jml'])*100),2)." %";?></td>
      <!-- <td align="center"><?php if($rowOK['jml']!='' OR $rowOK['jml']!=NULL){echo $rowOK['jml'];}else{echo "0";} ?></td>
      <td align="right"><?php if($rowOK['qty_claim']!='' OR $rowOK['qty_claim']!=NULL){echo number_format($rowOK['qty_claim'],2)." Kg";} else{echo "0.00 Kg";}?></td>
      <td align="center"><?php if($rowR['jml']!='' OR $rowR['jml']!=NULL){echo $rowR['jml'];}else{echo "0";} ?></td>
      <td align="right"><?php if($rowR['qty_claim']!='' OR $rowR['qty_claim']!=NULL){echo number_format($rowR['qty_claim'],2)." Kg";}else{echo "0.00 Kg";}?></td>
      <td align="center"><?php if($rowCut['jml']!='' OR $rowCut['jml']!=NULL){echo $rowCut['jml'];}else{echo "0";} ?></td>
      <td align="right"><?php if($rowCut['qty_claim']!='' OR $rowCut['qty_claim']!=NULL){echo number_format($rowCut['qty_claim'],2)." Kg";}else{echo "0.00 Kg";}?></td>
      <td align="center"><?php if($rowPG['jml']!='' OR $rowPG['jml']!=NULL){echo $rowPG['jml'];}else{echo "0";} ?></td>
      <td align="right"><?php if($rowPG['qty_claim']!='' OR $rowPG['qty_claim']!=NULL){echo number_format($rowPG['qty_claim'],2)." Kg";}else{echo "0.00 Kg";}?></td>
      <td align="center"><?php if($rowLG['jml']!='' OR $rowLG['jml']!=NULL){echo $rowLG['jml'];}else{echo "0";} ?></td>
      <td align="right"><?php if($rowLG['qty_claim']!='' OR $rowLG['qty_claim']!=NULL){echo number_format($rowLG['qty_claim'],2)." Kg";}else{echo "0.00 Kg";}?></td>
      <td align="center"><?php if($rowDN['jml']!='' OR $rowDN['jml']!=NULL){echo $rowDN['jml'];} ?></td>
      <td align="right"><?php if($rowDN['qty_claim']!='' OR $rowDN['qty_claim']!=NULL){echo number_format($rowDN['qty_claim'],2)." Kg";}else{echo "0.00 Kg";}?></td> -->
  </tr>
  <?php } ?>
  <tr>
    <td align="left"><strong>Total Kirim</strong></td>
    <td align="left" colspan="6"><strong><?php echo number_format($TotalKirim,2)." Kg"; ?></strong></td>
  </tr>
  <tr>
    <td align="left"><strong>Total Lot Negosiasi</strong></td>
    <td align="left" colspan="6"><strong><?php echo $rTotal['total_lot_nego']; ?></strong></td>
  </tr>
</table>
</body>