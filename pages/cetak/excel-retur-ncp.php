<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=sort-retur-ncp-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
include "../../koneksi.php";
//--
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
$Status=$_GET['status'];
$Order=$_GET['order'];
$Langganan=$_GET['langganan'];
$PO=$_GET['po'];
?>
<body>
<div align="center"> <h1>SORT RETUR DAN NCP</h1></div>
<h3>Periode : <?php echo $_GET['awal']." s/d ".$_GET['akhir'];?></h3>
<table width="100%" border="1">
    <tr>
      <th bgcolor="#12C9F0">NO.</th>
      <th bgcolor="#12C9F0">TANGGAL DARI GKJ</th>
      <th bgcolor="#12C9F0">LANGGANAN</th>
      <th bgcolor="#12C9F0">PO</th>
      <th bgcolor="#12C9F0">ORDER</th>
      <th bgcolor="#12C9F0">JENIS KAIN</th>
      <th bgcolor="#12C9F0">WARNA</th>
      <th bgcolor="#12C9F0">LOT</th>
      <th bgcolor="#12C9F0">ROLL</th>
      <th bgcolor="#12C9F0">KG</th>
      <th bgcolor="#12C9F0">SATUAN</th>
      <th bgcolor="#12C9F0">MASALAH</th>
      <th bgcolor="#12C9F0">T JAWAB</th>
      <th bgcolor="#12C9F0">ANALISA KERUSAKAN</th>
      <th bgcolor="#12C9F0">NO NCP</th>
      <th bgcolor="#12C9F0">PENYEBAB</th>
      <th bgcolor="#12C9F0">PEJABAT</th>
    </tr>
	<?php 
    $no=1;
    if($Awal!=""){ $Where =" AND DATE_FORMAT( a.tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; }
    if($Status!=""){ $sts=" AND a.`status`='$Status' ";}else{$sts=" ";}
    if($Awal!="" or $Order!="" or $PO!="" or $Langganan!=""){
        $query=mysqli_query($con,"SELECT a.*,
        GROUP_CONCAT( DISTINCT b.no_ncp SEPARATOR ', ' ) AS no_ncp,
        GROUP_CONCAT( DISTINCT b.masalah SEPARATOR ', ' ) AS masalah_ncp,
        c.penyebab,
        c.pejabat
        FROM tbl_detail_retur a LEFT JOIN tbl_ncp_qcf b ON a.nokk_ncp=b.nokk 
        LEFT JOIN tbl_aftersales c ON a.nokk_ncp=c.nokk
        WHERE a.no_order LIKE '%$Order%' AND a.po LIKE '%$PO%' AND a.langganan LIKE '%$Langganan%' $Where $sts GROUP BY a.id ORDER BY a.tgl_buat ASC ");
    }else{
        $query=mysqli_query($con,"SELECT a.*,
        GROUP_CONCAT( DISTINCT b.no_ncp SEPARATOR ', ' ) AS no_ncp,
        GROUP_CONCAT( DISTINCT b.masalah SEPARATOR ', ' ) AS masalah_ncp,
        c.penyebab,
        c.pejabat
        FROM tbl_detail_retur a LEFT JOIN tbl_ncp_qcf b ON a.nokk_ncp=b.nokk 
        LEFT JOIN tbl_aftersales c ON a.nokk_ncp=c.nokk
        WHERE a.no_order LIKE '$Order' AND a.po LIKE '$PO' AND a.langganan LIKE '$Langganan' $Where $sts GROUP BY a.id ORDER BY a.tgl_buat ASC");
    }
    $troll=0;
    $tkg=0;
    $tpjg=0;
	while($r=mysqli_fetch_array($query)){
        if($r['t_jawab']!="" and $r['t_jawab1']!="" and $r['t_jawab2']!=""){ $tjawab=$r['t_jawab'].",".$r['t_jawab1'].",".$r['t_jawab2'];
        }else if($r['t_jawab']!="" and $r['t_jawab1']!="" and $r['t_jawab2']==""){
        $tjawab=$r['t_jawab'].",".$r['t_jawab1'];	
        }else if($r['t_jawab']!="" and $r['t_jawab1']=="" and $r['t_jawab2']!=""){
        $tjawab=$r['t_jawab'].",".$r['t_jawab2'];	
        }else if($r['t_jawab']=="" and $r['t_jawab1']!="" and $r['t_jawab2']!=""){
        $tjawab=$r['t_jawab1'].",".$r['t_jawab2'];	
        }else if($r['t_jawab']!="" and $r['t_jawab1']=="" and $r['t_jawab2']==""){
        $tjawab=$r['t_jawab'];
        }else if($r['t_jawab']=="" and $r['t_jawab1']!="" and $r['t_jawab2']==""){
        $tjawab=$r['t_jawab1'];
        }else if($r['t_jawab']=="" and $r['t_jawab1']=="" and $r['t_jawab2']!=""){
        $tjawab=$r['t_jawab2'];	
        }else if($r['t_jawab']=="" and $r['t_jawab1']=="" and $r['t_jawab2']==""){
        $tjawab="";	
        }
	?>
    <tr>
      <td><?php echo $no;?></td>
      <td><?php echo $r['tgltrm_sjretur'];?></td>
      <td><?php echo $r['langganan'];?></td>
      <td><?php echo $r['po'];?></td>
      <td><?php echo $r['no_order'];?></td>
      <td><?php echo $r['jenis_kain'];?></td>
      <td><?php echo $r['warna'];?></td>
      <td>'<?php echo $r['lot'];?></td>
      <td><?php echo $r['roll']." Roll";?></td>
      <td><?php echo $r['kg']." KG";?></td>
      <td><?php echo $r['pjg']." ".$r['satuan'];?></td>
      <td><?php echo $r['masalah'];?></td>
      <td><?php echo $tjawab;?></td>
      <td><?php echo $r['masalah_ncp'];?></td>
      <td><?php echo $r['no_ncp'];?></td>
      <td><?php echo $r['penyebab'];?></td>
      <td><?php echo $r['pejabat'];?></td>
  </tr>
    <?php $no++;
    $troll=$troll+$r['roll'];
    $tkg=$tkg+$r['kg'];} ?>
    <tr>
        <td align="center" colspan="8"><strong>TOTAL</strong></td>
        <td align="left"><strong><?php echo $troll." Roll";?></strong></td>
        <td align="left"><strong><?php echo $tkg." KG";?></strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>