<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
include "../../tgl_indo.php";
//--
$idkk=$_REQUEST['idkk'];
$act=$_GET['g'];
//-
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
$Dept=$_GET['dept'];
$Kategori=$_GET['kategori'];
$Cancel=$_GET['cancel'];
$qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%Y-%m-%d') as tgl_skrg,DATE_FORMAT(now(),'%H:%i:%s') as jam_skrg");
$rTgl=mysqli_fetch_array($qTgl);
if($Awal!=""){$tgl=substr($Awal,0,10); $jam=$Awal;}else{$tgl=$rTgl['tgl_skrg']; $jam=$rTgl['jam_skrg'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak Harian NCP</title>
<script>

// set portrait orientation

jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);

// set top margins in millimeters
jsPrintSetup.setOption('marginTop', 0);
jsPrintSetup.setOption('marginBottom', 0);
jsPrintSetup.setOption('marginLeft', 0);
jsPrintSetup.setOption('marginRight', 0);

// set page header
jsPrintSetup.setOption('headerStrLeft', '');
jsPrintSetup.setOption('headerStrCenter', '');
jsPrintSetup.setOption('headerStrRight', '');

// set empty page footer
jsPrintSetup.setOption('footerStrLeft', '');
jsPrintSetup.setOption('footerStrCenter', '');
jsPrintSetup.setOption('footerStrRight', '');

// clears user preferences always silent print value
// to enable using 'printSilent' option
jsPrintSetup.clearSilentPrint();

// Suppress print dialog (for this context only)
jsPrintSetup.setOption('printSilent', 1);

// Do Print 
// When print is submitted it is executed asynchronous and
// script flow continues after print independently of completetion of print process! 
jsPrintSetup.print();

window.addEventListener('load', function () {
    var rotates = document.getElementsByClassName('rotate');
    for (var i = 0; i < rotates.length; i++) {
        rotates[i].style.height = rotates[i].offsetWidth + 'px';
    }
});
// next commands

</script>
<style>
.hurufvertical {
 writing-mode:tb-rl;
    -webkit-transform:rotate(-90deg);
    -moz-transform:rotate(-90deg);
    -o-transform: rotate(-90deg);
    -ms-transform:rotate(-90deg);
    transform: rotate(180deg);
    white-space:nowrap;
    float:left;
}	

input{
text-align:center;
border:hidden;
}
@media print {
  ::-webkit-input-placeholder { /* WebKit browsers */
      color: transparent;
  }
  :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
      color: transparent;
  }
  ::-moz-placeholder { /* Mozilla Firefox 19+ */
      color: transparent;
  }
  :-ms-input-placeholder { /* Internet Explorer 10+ */
      color: transparent;
  }
  .pagebreak { page-break-before:always; }
  .header {display:block}
  table thead 
   {
    display: table-header-group;
   }
}	
</style>	
</head>

<?php 
if($Dept=="ALL"){		
	$Wdept=" ";	
	}else{	
	$Wdept=" dept='$Dept' AND ";	
	}
	if($Kategori=="ALL"){		
	$Wkategori=" ";	
	}
	else if($Kategori=="hitung"){	
	$Wkategori=" ncp_hitung='ya' AND ";	
	}else if($Kategori=="gerobak"){	
	$Wkategori=" kain_gerobak='ya' AND ";	
	}else if($Kategori=="tidakhitung"){	
	$Wkategori=" ncp_hitung='tidak' AND ";	
	}		
	if($Cancel !="1"){
		$sts=" AND NOT `status`='Cancel' "; 
	}else{
		$sts="  ";
  }
	
$qryTotNNCP=mysqli_query($con," SELECT count(x.no_ncp) as tot FROM
(SELECT no_ncp FROM tbl_ncp_qcf_new WHERE $Wdept $Wkategori 
DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'  $sts GROUP BY no_ncp) x ");
$rNNCP=mysqli_fetch_array($qryTotNNCP);
	?>
<body>
<table width="100%">
  <thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
  <tr>
    <td width="6%" align="center"><img src="indo.jpg" width="60" height="60"  /></td>
    <td width="94%" align="center" valign="middle"><strong><font size="+1" >LAPORAN MASUK NCP</font></strong></td>
    </tr>
  </table>
<table width="100%" border="0">
    <tbody>
      <tr>
        <td>Dept : <?php echo $_GET['dept'];?><br />
          Kategori : <?php if($_GET['kategori']=="gerobak"){echo "Kain diGerobak";}else if($_GET['kategori']=="hitung"){echo "NCP diHitung";}else if($_GET['kategori']=="tidakhitung"){echo "NCP Tidak Hitung";}else{echo "ALL";}?><br />
          Periode : <?php echo tanggal_indo($_GET['awal']);?> s/d <?php echo tanggal_indo($_GET['akhir']);?><br />
          Total No NCP: <?php echo $rNNCP['tot']; ?></td>
        </tr>
    </tbody>
  </table>
		</td>
    </tr>
	</thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1">
        <tbody>
          <tr align="center">
            <td rowspan="2">DEPT</td>
            <td colspan="2">1X</td>
            <td colspan="2">2X</td>
            <td colspan="2">3X</td>
            <td colspan="2">4X</td>
            <td colspan="2">5X</td>
            <td colspan="2">6X</td>
            <td colspan="2">7X</td>
            <td colspan="2">8X</td>
            <td colspan="2">9X</td>
            <td colspan="2">10X</td>
            <td colspan="2">11X</td>
            <td colspan="2">12X</td>
            <td colspan="2">13X</td>
            <td colspan="2">14X</td>
            <td colspan="2">15X</td>
            <td colspan="2">16X</td>
            <td colspan="2">17X</td>
            <td colspan="2">18X</td>
            <td colspan="2">19X</td>
            <td colspan="2">20X</td>
          </tr>
          <tr align="center">
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
            <td >KK</td>
            <td >%</td>
          </tr>
		<?php
	function JmlNCP($revisi){
	include "../../koneksi.php";	
	$qryk1T=mysqli_query($con,"SELECT count(x.revisi) as jmlkk FROM
	(SELECT dept,no_ncp,max(revisi) as revisi FROM tbl_ncp_qcf_new WHERE $Wkategori 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts 
	GROUP BY no_ncp,dept) x 
	WHERE x.revisi='$revisi' 
	GROUP BY x.revisi");
	$rowk1T=mysqli_fetch_array($qryk1T);
	echo $rowk1T['jmlkk'];	
	}		
	$no=1;	
	$qry1=mysqli_query($con,"SELECT dept FROM tbl_ncp_qcf_new WHERE $Wdept $Wkategori 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts GROUP BY dept");
			while($row1=mysqli_fetch_array($qry1)){
	/* $qryk1T=mysqli_query($con,"SELECT count(x.revisi) as jmlkk FROM
(SELECT dept,no_ncp,max(revisi) as revisi FROM tbl_ncp_qcf_new WHERE $Wkategori 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts 
GROUP BY no_ncp,dept) x 
WHERE x.revisi='1' 
GROUP BY x.revisi");
	$rowk1T=mysqli_fetch_array($qryk1T);
	$qryk2T=mysqli_query($con,"SELECT count(x.revisi) as jmlkk FROM
(SELECT dept,no_ncp,max(revisi) as revisi FROM tbl_ncp_qcf_new WHERE $Wkategori 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts 
GROUP BY no_ncp,dept) x 
WHERE x.revisi='2' 
GROUP BY x.revisi");
	$rowk2T=mysqli_fetch_array($qryk2T);
	$qryk3T=mysqli_query($con,"SELECT count(x.revisi) as jmlkk FROM
(SELECT dept,no_ncp,max(revisi) as revisi FROM tbl_ncp_qcf_new WHERE $Wkategori 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts 
GROUP BY no_ncp,dept) x 
WHERE x.revisi='3' 
GROUP BY x.revisi");
	$rowk3T=mysqli_fetch_array($qryk3T);			
	$qryk4T=mysqli_query($con,"SELECT count(x.revisi) as jmlkk FROM
(SELECT dept,no_ncp,max(revisi) as revisi FROM tbl_ncp_qcf_new WHERE $Wkategori 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts 
GROUP BY no_ncp,dept) x 
WHERE x.revisi='4' 
GROUP BY x.revisi");
	$rowk4T=mysqli_fetch_array($qryk4T);			
	$qryk1=mysqli_query($con,"SELECT count(x.revisi) as jmlkk FROM
(SELECT dept,no_ncp,max(revisi) as revisi FROM tbl_ncp_qcf_new WHERE $Wkategori dept='$row1[dept]' AND 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts 
GROUP BY no_ncp) x 
WHERE x.revisi='1' 
GROUP BY x.revisi");
	$rowk1=mysqli_fetch_array($qryk1);
	$qryk2=mysqli_query($con,"SELECT count(x.revisi) as jmlkk FROM
(SELECT dept,no_ncp,max(revisi) as revisi FROM tbl_ncp_qcf_new WHERE $Wkategori dept='$row1[dept]' AND 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts 
GROUP BY no_ncp) x 
WHERE x.revisi='2' 
GROUP BY x.revisi");
	$rowk2=mysqli_fetch_array($qryk2);
	$qryk3=mysqli_query($con,"SELECT count(x.revisi) as jmlkk FROM
(SELECT dept,no_ncp,max(revisi) as revisi FROM tbl_ncp_qcf_new WHERE $Wkategori dept='$row1[dept]' AND 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts 
GROUP BY no_ncp) x 
WHERE x.revisi='3' 
GROUP BY x.revisi");
	$rowk3=mysqli_fetch_array($qryk3);
	$qryk4=mysqli_query($con,"SELECT count(x.revisi) as jmlkk FROM
(SELECT dept,no_ncp,max(revisi) as revisi FROM tbl_ncp_qcf_new WHERE $Wkategori dept='$row1[dept]' AND 
	DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $sts 
GROUP BY no_ncp) x 
WHERE x.revisi='4' 
GROUP BY x.revisi");
	$rowk4=mysqli_fetch_array($qryk4); */
				
				
		 ?>
          <tr valign="top">
            <td align="center"><?php echo $row1['dept']; ?></td>
            <td align="center" style="text-align: center"><?php JmlNCP("1");//echo round($rowk1['jmlkk']); ?></td>
            <td align="center" style="text-align: center"><?php echo number_format(round(($rowk1['jmlkk']/$rowk1T['jmlkk'])*100,2),2); ?></td>
            <td style="text-align: center"><?php echo round($rowk2['jmlkk']); ?></td>
            <td style="text-align: center"><?php echo number_format(round(($rowk2['jmlkk']/$rowk2T['jmlkk'])*100,2),2); ?></td>
            <td style="text-align: center"><?php echo round($rowk3['jmlkk']); ?></td>
            <td align="center" style="text-align: center"><?php if($rowk3T['jmlkk']>0){echo number_format(round(($rowk3['jmlkk']/$rowk3T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk4T['jmlkk']>0){echo number_format(round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2),2);} ?></td>
            <td style="text-align: center"><?php echo round($rowk4['jmlkk']); ?></td>
            <td style="text-align: center"><?php if($rowk20T['jmlkk']>0){echo number_format(round(($rowk20['jmlkk']/$rowk20T['jmlkk'])*100,2),2);} ?></td>
          </tr>
		<?php	$no++; 
				$kk1 =$rowk1['jmlkk']+$kk1;
				$kk2 =$rowk2['jmlkk']+$kk2;
				$kk3 =$rowk3['jmlkk']+$kk3;
				$kk4 =$rowk4['jmlkk']+$kk4;
				if($rowk1T['jmlkk']>0){$kk1pT=round(($rowk1['jmlkk']/$rowk1T['jmlkk'])*100,2)+$kk1pT;}else{$kk1pT=0;}
				if($rowk2T['jmlkk']>0){$kk2pT=round(($rowk2['jmlkk']/$rowk2T['jmlkk'])*100,2)+$kk2pT;}else{$kk2pT=0;}
				if($rowk3T['jmlkk']>0){$kk3pT=round(($rowk3['jmlkk']/$rowk3T['jmlkk'])*100,2)+$kk3pT;}else{$kk3pT=0;}
				if($rowk4T['jmlkk']>0){$kk4pT=round(($rowk4['jmlkk']/$rowk4T['jmlkk'])*100,2)+$kk4pT;}else{$kk4pT=0;}
				$gtotKK=$kk1+$kk2+$kk3+$kk4;
			} ?>	
          <tr valign="top">
            <td align="right" style="text-align: left">TOTAL</td>
            <td align="right" style="text-align: center"><?php echo round($kk1); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk1pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk2); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk2pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk3); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk3pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
            <td align="right" style="text-align: center"><?php echo round($kk4); ?></td>
            <td align="right" style="text-align: center"><?php echo $kk4pT; ?></td>
          </tr>
			
        </tbody>
      </table>
		<table width="200" border="1" class="table-list1">
  <tbody>
    <tr>
      <td width="57" style="text-align: center">NCP</td>
      <td width="81" style="text-align: center">TOTAL KK</td>
      <td width="40" style="text-align: center">%</td>
    </tr>
    <tr>
      <td style="text-align: center">1X</td>
      <td style="text-align: right"><span style="text-align: center"><?php echo round($kk1); ?></span></td>
      <td style="text-align: right"><?php echo number_format(round(($kk1/$gtotKK)*100,2),2); ?></td>
    </tr>
    <tr>
      <td style="text-align: center">2X</td>
      <td style="text-align: right"><span style="text-align: center"><?php echo round($kk2); ?></span></td>
      <td style="text-align: right"><?php echo number_format(round(($kk2/$gtotKK)*100,2),2); ?></td>
    </tr>
    <tr>
      <td style="text-align: center">3X</td>
      <td style="text-align: right"><span style="text-align: center"><?php echo round($kk3); ?></span></td>
      <td style="text-align: right"><?php echo number_format(round(($kk3/$gtotKK)*100,2),2); ?></td>
    </tr>
    <tr>
      <td style="text-align: center">4X</td>
      <td style="text-align: right"><span style="text-align: center"><?php echo round($kk4); ?></span></td>
      <td style="text-align: right"><?php echo number_format(round(($kk4/$gtotKK)*100,2),2); ?></td>
    </tr>
    <tr>
      <td style="text-align: center">Total</td>
      <td style="text-align: right"><span style="text-align: center"><?php echo round($gtotKK); ?></span></td>
      <td style="text-align: right">&nbsp;</td>
    </tr>
  </tbody>
</table>

	  </td>
    </tr>
  
</table>

<script>
//alert('cetak');window.print();
</script> 
</body>
</html>