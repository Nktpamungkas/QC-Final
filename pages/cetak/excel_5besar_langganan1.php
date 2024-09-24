<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Summary-5Besar-Langganan-TotalKirim-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
include "../../koneksi.php";
//--
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
$TotalKirim=$_GET['total'];
?>
<body>

<strong>Periode: <?php echo $Awal; ?> s/d <?php echo $Akhir; ?></strong><br>
<table width="100%" border="1">
    <tr>
      <th bgcolor="#12C9F0">NO.</th>
      <th bgcolor="#12C9F0">LANGGANAN</th>
      <th bgcolor="#12C9F0">QTY KELUHAN (KG)</th>
      <th bgcolor="#12C9F0">% DIBANDINGKAN TOTAL KIRIM</th>
    </tr>
	<?php 
	$no1=1;
    $total=0;
    $totaldll=0;
    $qryAll=mysqli_query($con,"SELECT COUNT(*) AS jml_all, SUM(qty_claim) AS qty_claim_all FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'");
    $rAll=mysqli_fetch_array($qryAll);
    $qrylgn=mysqli_query($con,"SELECT SUM(qty_claim) AS qty_claim_lgn, ROUND(COUNT(langganan)/(SELECT COUNT(*) FROM tbl_aftersales WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir')*100,1) AS persen,
    langganan
    FROM
    `tbl_aftersales`
    WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
    GROUP BY langganan
    ORDER BY qty_claim_lgn DESC LIMIT 5");
    while($r=mysqli_fetch_array($qrylgn)){
	?>
        <tr valign="top">
            <td align="center"><?php echo $no1; ?></td>
            <td align="left"><?php echo $r['langganan'];?></td>
            <td align="right"><?php echo $r['qty_claim_lgn']; ?></td>
            <td align="right"><?php echo number_format(($r['qty_claim_lgn']/$TotalKirim)*100,2)." %";?></td>
        </tr>
    <?php	$no1++;  
    $total=$total+$r['qty_claim_lgn'];
    } 
    $totaldll=$rAll['qty_claim_all']-$total;?>
    <tr valign="top">
        <td align="center" colspan="2"><strong>DLL</strong></td>
        <td align="right"><strong><?php echo number_format($totaldll,2); ?></strong></td>
        <td align="right"><strong><?php echo number_format(($totaldll/$TotalKirim)*100,2)." %"; ?></strong></td>
    </tr>
    <tr valign="top">
        <td align="center" colspan="2"><strong>TOTAL KIRIM</td>
        <td align="right"><strong><?php echo number_format($TotalKirim,2); ?></strong></td>
        <td align="right">&nbsp;</strong></td>
    </tr>
</table>
</body>