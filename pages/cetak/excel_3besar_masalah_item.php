<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=3Besar-Masalah-PerItem-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
include "../../koneksi.php";
//--
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
$Langganan = $_GET['langganan'];
?>
<body>

<strong>Periode: <?php echo $Awal; ?> s/d <?php echo $Akhir; ?></strong><br>
<table width="100%" border="1">
    <tr>
      <th bgcolor="#12C9F0">Item/Hanger</th>
      <th bgcolor="#12C9F0">Masalah</th>
      <th bgcolor="#12C9F0">KG</th>
      <th bgcolor="#12C9F0">Total Kirim Per Item</th>
      <th bgcolor="#12C9F0">% Dibandingkan Total Kirim</th>
      <th bgcolor="#12C9F0">% Masalah Per Item</th>
    </tr>
	<?php 
        $tkirim=0;
        if($Langganan!=''){$lgn=" AND langganan LIKE '%$Langganan%' ";}else{$lgn="";}
        $qry7=mysqli_query($con,"SELECT no_item, no_hanger, SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $lgn
        GROUP BY no_item
        ORDER BY qty_keluhan DESC
        LIMIT 3");
        while($ri7=mysqli_fetch_array($qry7)){
            $qryd7=mysqli_query($con,"SELECT masalah_dominan, SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $lgn
            AND no_item='$ri7[no_item]' 
            GROUP BY masalah_dominan
            ORDER BY qty_keluhan DESC
            LIMIT 3");
            $qrykirim=mysqli_query($con,"SELECT SUM(qty) AS qty_kirim FROM tbl_pengiriman WHERE DATE_FORMAT(tgl_kirim, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND no_item='$ri7[no_item]' AND tmp_hapus='0'");
            $rkirim=mysqli_fetch_array($qrykirim);
            $qrytitem=mysqli_query($con,"SELECT SUM(a.qty_keluhan) AS total_keluhan FROM
            (SELECT SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
            AND no_item='$ri7[no_item]' 
            GROUP BY masalah_dominan
            ORDER BY qty_keluhan DESC
            LIMIT 3) a");
            $ritem=mysqli_fetch_array($qrytitem);
            while($rdi7=mysqli_fetch_array($qryd7)){
    ?>
        <tr valign="top">
            <td align="center"><?php echo $ri7['no_item']."/".$ri7['no_hanger'];?></td>  
            <td align="right"><?php echo $rdi7['masalah_dominan'];?></td>
            <td align="right"><?php echo $rdi7['qty_keluhan'];?></td>
            <td align="right"><?php echo $rkirim['qty_kirim'];?></td>
            <td align="right"><?php if($rkirim['qty_kirim']!=''){echo number_format(($rdi7['qty_keluhan']/$rkirim['qty_kirim'])*100,2)." %";}else{echo "0";}?></td>
            <td align="right"><?php if($rkirim['qty_kirim']!=''){echo number_format(($ritem['total_keluhan']/$rkirim['qty_kirim'])*100,2)." %";}else{echo "0";}?></td>
        </tr>
    <?php  
    $tkirim=$tkirim+$rkirim['qty_kirim'];} } 
    ?>
</table>
</body>