<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=3Besar-Masalah-NCP-PerItem-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
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
      <th bgcolor="#12C9F0">Masalah</th>
      <th bgcolor="#12C9F0">Buyer</th>
      <th bgcolor="#12C9F0">KG</th>
      <th bgcolor="#12C9F0">Total Produksi Dyeing Per Item</th>
      <th bgcolor="#12C9F0">% Dibandingkan Total Produksi Dyeing Per Item</th>
      <th bgcolor="#12C9F0">% Masalah Per Item</th>
    </tr>
	<?php 
        $tpro=0;
		if($_GET['hitung']=="1"){
			$wHitung = " and ncp_hitung ='ya' ";
		}else{
			$wHitung = " ";
		}
        $qry7=mysqli_query($con,"SELECT no_item, no_hanger, buyer, SUM(berat) AS qty_kg FROM tbl_ncp_qcf_new WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
        GROUP BY no_item
        ORDER BY qty_kg DESC
        LIMIT 3");
        while($ri7=mysqli_fetch_array($qry7)){
            $qryd7=mysqli_query($con,"SELECT masalah_dominan, SUM(berat) AS qty_kg FROM tbl_ncp_qcf_new WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
            AND no_item='$ri7[no_item]' $wHitung
            GROUP BY masalah_dominan
            ORDER BY qty_kg DESC
            LIMIT 3");
            $qrypro=mysqli_query($condye,"SELECT SUM(a.bruto) AS qty_produksi FROM tbl_montemp a LEFT JOIN tbl_schedule b ON a.id_schedule = b.id
            WHERE DATE_FORMAT(a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND b.no_item='$ri7[no_item]' AND b.status='selesai' and b.proses ='Celup Greige' and not b.ket_status =''");
            $rpro=mysqli_fetch_array($qrypro);
            $qrytitem=mysqli_query($con,"SELECT SUM(a.qty_kg) AS total_kg FROM
            (SELECT SUM(berat) AS qty_kg FROM tbl_ncp_qcf_new WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
            AND no_item='$ri7[no_item]' $wHitung 
            GROUP BY masalah_dominan
            ORDER BY qty_kg DESC
            LIMIT 3) a");
            $ritem=mysqli_fetch_array($qrytitem);
            while($rdi7=mysqli_fetch_array($qryd7)){
    ?>
        <tr valign="top">
            <td align="center"><?php echo $ri7['no_item']."/".$ri7['no_hanger'];?></td>  
            <td align="right"><?php echo $rdi7['masalah_dominan'];?></td>
            <td align="right"><?php echo $ri7['buyer'];?></td>
            <td align="right"><?php echo $rdi7['qty_kg'];?></td>
            <td align="right"><?php echo $rpro['qty_produksi'];?></td>
            <td align="right"><?php if($rpro['qty_produksi']!=''){echo number_format(($rdi7['qty_kg']/$rpro['qty_produksi'])*100,2)." %";}else{echo "0";}?></td>
            <td align="right"><?php if($rpro['qty_produksi']!=''){echo number_format(($ritem['total_kg']/$rpro['qty_produksi'])*100,2)." %";}else{echo "0";}?></td>
        </tr>
    <?php  
        $tpro=$tpro+$rpro['qty_produksi'];}} 
    ?>
</table>
</body>