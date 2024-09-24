<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=3Besar-NCP-PerItem-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
include "../../koneksi.php";
//--
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
?>
<body>

<strong>Periode: <?php echo $Awal; ?> s/d <?php echo $Akhir; ?></strong><br>
<table width="100%" border="1">
    <tr>
      <th bgcolor="#12C9F0">Item/Hanger</th>
      <th bgcolor="#12C9F0">Buyer</th>
      <th bgcolor="#12C9F0">KG</th>
      <th bgcolor="#12C9F0">% Dibandingkan Total Produksi Dyeing</th>
      <th bgcolor="#12C9F0">% Dibandingkan Total NCP</th>
    </tr>
	<?php 
        $tpro=0;
        $tdll=0;
        $qry7=mysqli_query($con,"SELECT no_item, no_hanger, buyer, SUM(berat) AS qty_kg FROM tbl_ncp_qcf WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
        GROUP BY no_item
        ORDER BY qty_kg DESC
        LIMIT 3");
        $qryt3=mysqli_query($con,"SELECT SUM(a.qty_kg) AS total_kg FROM
        (SELECT no_item, no_hanger, SUM(berat) AS qty_kg FROM tbl_ncp_qcf WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
        GROUP BY no_item
        ORDER BY qty_kg DESC
        LIMIT 3) a");
        $rt3=mysqli_fetch_array($qryt3);
        $qrytall=mysqli_query($con,"SELECT SUM(berat) AS qty_kg_all FROM tbl_ncp_qcf WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'");
        $rtall=mysqli_fetch_array($qrytall);
        $qrypro1=mysqli_query($condye,"SELECT SUM(a.bruto) AS qty_produksi FROM tbl_montemp a LEFT JOIN tbl_schedule b ON a.id_schedule = b.id
        WHERE DATE_FORMAT(a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND b.status='selesai'");
        $rpro1=mysqli_fetch_array($qrypro1);
        while($ri7=mysqli_fetch_array($qry7)){
    ?>
       <tr valign="top">
            <td align="center"><?php echo $ri7['no_item']."/".$ri7['no_hanger'];?></td>  
            <td align="center"><?php echo $ri7['buyer'];?></td> 
            <td align="right"><?php echo $ri7['qty_kg'];?></td>
            <td align="right"><?php if($rpro1['qty_produksi']!=''){echo number_format(($ri7['qty_kg']/$rpro1['qty_produksi'])*100,2)." %";}else{echo "0";}?></td>
            <td align="right"><?php if($rtall['qty_kg_all']!=''){echo number_format(($ri7['qty_kg']/$rtall['qty_kg_all'])*100,2)." %";}else{echo "0";}?></td>
        </tr>
    <?php  
    } 
    ?>
        <tr valign="top">
            <td align="center">DLL</td>  
            <td align="center">&nbsp;</td> 
            <td align="right"><?php echo number_format($tdll=$rtall['qty_kg_all']-$rt3['total_kg'],2);?></td>
            <td align="right"><?php if($rpro1['qty_produksi']!=''){echo number_format(($tdll/$rpro1['qty_produksi'])*100,2)." %";}else{echo "0";}?></td>
            <td align="right"><?php if($rtall['qty_kg_all']!=''){echo number_format(($tdll/$rtall['qty_kg_all'])*100,2)." %";}else{echo "0";}?></td>
        </tr>
        <tr valign="top">
            <td align="center" ><strong>TOTAL PRODUKSI DYEING</strong></td>
            <td align="right" colspan="4"><strong><?php if($rpro1['qty_produksi']!=""){echo number_format($rpro1['qty_produksi'],2);}else{echo "0";} ?></strong></td>
        </tr>
        <tr valign="top">
            <td align="center"><strong>TOTAL NCP</strong></td>
            <td align="right" colspan="4"><strong><?php if($rtall['qty_kg_all']!=""){echo number_format($rtall['qty_kg_all'],2);}else{echo "0";} ?></strong></td>
        </tr>
</table>
</body>