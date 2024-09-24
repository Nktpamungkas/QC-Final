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
//$Dept=$_GET['dept'];
//$Cancel=$_GET['cancel'];
$qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%d-%b-%y') as tgl_skrg,DATE_FORMAT(now(),'%H:%i:%s') as jam_skrg");
$rTgl=mysqli_fetch_array($qTgl);
if($Awal!=""){$tgl=substr($Awal,0,10); $jam=$Awal;}else{$tgl=$rTgl['tgl_skrg']; $jam=$rTgl['jam_skrg'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak Ganti Kain</title>
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
//$nmBln=array(1 => "JANUARI","FEBUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");	
?>
<body>
<table width="100%">
  <thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
  <tr>
        <td align="center"><strong><font size="+1">LAPORAN GANTI KAIN</font>
          <br />
		<font size="-1">FW-14-QCF-27/03</font></strong></td>
    </tr>
  </table>

		</td>
    </tr>
	</thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1">
        <thead>
          <tr align="center">
			      <td><font size="-2">No</font></td>
            <td><font size="-2">Date Replacement Open</font></td>
            <td><font size="-2">Gmt Fcty</font></td>
            <td><font size="-2">Ftcy Ord Nbr</font></td>
            <td><font size="-2">Vend Ord Nbr</font></td>
            <td><font size="-2">G. No.</font></td>
            <td><font size="-2">No Item</font></td>
            <td><font size="-2">Description</font></td>
            <td><font size="-2">Width & Weight</font></td>
            <td><font size="-2">Color</font></td>
            <td><font size="-2">Total Order Qty</font></td>
            <td><font size="-2">Delivery Qty</font></td>
            <td><font size="-2">Extra Qty</font></td>
            <td><font size="-2">Replacement Qty</font></td>
            <td><font size="-2">Percent</font></td>
            <td><font size="-2">Defect</font></td>
            <td><font size="-2">Dept. Penanggung Jawab</font></td>
          </tr>
		</thead>
		<tbody>
    <tr>
        <td align="left" colspan="17"><strong><font size="-2">Periode: <?php echo date("d/m/Y", strtotime($Awal));?> s/d <?php echo date("d/m/Y", strtotime($Akhir));?></font></strong></td>
    </tr>  
		<?php
	$no=1;
	$Awal=$_GET['awal'];
	$Akhir=$_GET['akhir'];		
  $qry1=mysqli_query($con,"SELECT a.kd_ganti,b.*, SUM(b.qty_order) as qty_order_lgn, SUM(b.qty_kirim) as qty_kirim_lgn, SUM(b.qty_foc) as qty_foc_lgn, SUM(b.qty_claim) as qty_claim_lgn 
  FROM tbl_ganti_kain a LEFT JOIN tbl_aftersales b ON a.id_nsp=b.id
  WHERE DATE_FORMAT( a.tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' GROUP BY langganan, b.id WITH ROLLUP");
  //$qrygk=mysqli_query("");
  $torder="";
  $tkirim="";
  $tfoc="";
  $tclaim="";
  $tpersen="";
  $subtotalorder=0;
  $subtotalkirim=0;
  $subtotalfoc=0;
  $subtotalclaim=0;
  $persensubtotal=0;
			while($row1=mysqli_fetch_array($qry1)){
				if($row1['t_jawab']!="" and $row1['t_jawab1']!="" and $row1['t_jawab2']!="" and $row1['persen']!="0" and $row1['persen1']!="0" and $row1['persen2']!="0"){ $tjawab=$row1['t_jawab']." ".$row1['persen']."% ".$row1['t_jawab1']." ".$row1['persen1']."% ".$row1['t_jawab2']." ".$row1['persen2']."%";
        }else if($row1['t_jawab']!="" and $row1['persen']!="0" and $row1['t_jawab1']!="" and $row1['persen1']!="0" and $row1['t_jawab2']=="" and $row1['persen2']=="0"){
        $tjawab=$row1['t_jawab']." ".$row1['persen']."% ".$row1['t_jawab1']." ".$row1['persen1']."%";	
        }else if($row1['t_jawab']!="" and $row1['persen']!="0" and $row1['t_jawab1']=="" and $row1['persen1']=="0" and $row1['t_jawab2']!="" and $row1['persen2']!="0"){
        $tjawab=$row1['t_jawab']." ".$row1['persen']."% ".$row1['t_jawab2']." ".$row1['persen2']."%";	
        }else if($row1['t_jawab']=="" and $row1['persen']=="0" and $row1['t_jawab1']!="" and $row1['persen1']!="0" and $row1['t_jawab2']!="" and $row1['persen2']!="0"){
        $tjawab=$row1['t_jawab1']." ".$row1['persen1']."% ".$row1['t_jawab2']." ".$row1['persen2']."%";	
        }else if($row1['t_jawab']!="" and $row1['persen']!="0" and $row1['t_jawab1']=="" and $row1['persen1']=="0" and $row1['t_jawab2']=="" and $row1['persen2']=="0"){
        $tjawab=$row1['t_jawab']." ".$row1['persen']."%";
        }else if($row1['t_jawab']=="" and $row1['persen']=="0" and $row1['t_jawab1']!="" and $row1['persen1']!="0" and $row1['t_jawab2']=="" and $row1['persen2']=="0"){
        $tjawab=$row1['t_jawab1']." ".$row1['persen1']."%";
        }else if($row1['t_jawab']=="" and $row1['persen']=="0" and $row1['t_jawab1']=="" and $row1['persen1']=="0" and $row1['t_jawab2']!="" and $row1['persen2']!="0"){
        $tjawab=$row1['t_jawab2']." ".$row1['persen2']."%";	
        }else if($row1['t_jawab']=="" and $row1['persen']=="0" and $row1['t_jawab1']=="" and $row1['persen1']=="0" and $row1['t_jawab2']=="" and $row1['persen2']=="0"){
        $tjawab="";	
        }
		 ?>
         <?php if(!empty($row1['id'])){ ?>
          <tr valign="top">
            <td align="center" valign="middle"><font size="-2"><?php echo $no; ?></font></td>
            <td align="left" valign="middle"><font size="-2"><?php echo date("d/m/y", strtotime($row1['tgl_buat']));?></font></td>
            <td align="left" valign="middle"><font size="-2"><?php echo strtoupper($row1['langganan']);?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo strtoupper($row1['po']);?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo strtoupper($row1['no_order']);?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo strtoupper($row1['kd_ganti']);?></font></td>
            <td align="left" valign="middle"><font size="-2"><?php echo strtoupper($row1['no_item']);?></font></td>
            <td align="center"><font size="-2"><?php echo strtoupper($row1['jenis_kain']);?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo $row1['lebar']."X".$row1['gramasi'];?></font></td>
            <td align="left" valign="middle"><font size="-2"><?php echo strtoupper($row1['warna']);?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo $row1['qty_order'];?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo $row1['qty_kirim'];?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php if($row1['qty_foc']=="0.00" OR $row1['qty_foc']==NULL){echo "-";}else {echo $row1['qty_foc'];}?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo $row1['qty_claim'];?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo round(($row1['qty_claim']/$row1['qty_order'])*100,2)."%";?></font></td>
            <td align="left" valign="middle"><font size="-2"><?php echo $row1['masalah'];?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo $tjawab; ?></font></td>
          </tr>
          <?php } ?>
          <?php if(empty($row1['id'])){ ?>
          <tr valign="top">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center" valign="middle"><font size="-2"><strong><?php echo $row1['qty_order_lgn']; ?></strong></font></td>
              <td align="center" valign="middle"><font size="-2"><strong><?php echo $row1['qty_kirim_lgn']; ?></strong></font></td>
              <td align="center" valign="middle"><font size="-2"><strong><?php echo $row1['qty_foc_lgn']; ?></strong></font></td>
              <td align="center" valign="middle"><font size="-2"><strong><?php echo $row1['qty_claim_lgn']; ?></strong></font></td>
              <td align="center" valign="middle"><font size="-2"><strong><?php echo round(($row1['qty_claim_lgn']/$row1['qty_order_lgn'])*100,2)."%";?></strong></font></td>
              <td></td>
              <td></td>
            </tr>
          <?php }?>
          <!--<?php if(empty($row1['id']) AND empty($row1['langganan'])){ ?>
          <tr valign="top">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="right"><strong>GRAND TOTAL</strong></td>
              <td align="center" valign="middle"><strong><?php echo $row1['qty_order_lgn']; ?></strong></td>
              <td align="center" valign="middle"><strong><?php echo $row1['qty_kirim_lgn']; ?></strong></td>
              <td align="center" valign="middle"><strong><?php echo $row1['qty_foc_lgn']; ?></strong></td>
              <td align="center" valign="middle"><strong><?php echo $row1['qty_claim_lgn']; ?></strong></td>
              <td align="center" valign="middle"><strong><?php echo round(($row1['qty_claim_lgn']/$row1['qty_order_lgn'])*100,2)."%";?></strong></td>
              <td></td>
              <td></td>
            </tr>
          <?php }?>-->
        <?php $no++;
        $torder=$row1['qty_order_lgn'];
        $tkirim=$row1['qty_kirim_lgn'];
        $tfoc=$row1['qty_foc_lgn'];
        $tclaim=$row1['qty_claim_lgn'];
        $tpersen=round(($row1['qty_claim_lgn']/$row1['qty_order_lgn'])*100,2);
        } ?>
        <!--$torder=round($torder+$row1['qty_order'],2);
        $tkirim=round($tkirim+$row1['qty_kirim'],2);
        $tfoc=round($tfoc+$row1['qty_foc'],2);
        $tclaim=round($tclaim+$row1['qty_claim'],2);
        $tpersen=round(($tclaim/$torder)*100,2);-->
				
          <!--<tr valign="top">
            <td colspan="10" align="right"><strong>GRAND TOTAL</strong></td>
            <td align="right"><strong><?php echo number_format($torder,2);?></strong></td>
            <td align="right"><strong><?php echo number_format($tkirim,2);?></strong></td>
            <td align="right"><strong><?php echo number_format($tfoc,2);?></strong></td>
            <td align="right"><strong><?php echo number_format($tclaim,2);?></strong></td>
            <td align="right"><strong><?php echo $tpersen."%";?></strong></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>-->
			
        </tbody>
      </table></td>
    </tr>
    <tr>
    <td><table width="30%" border="0" class="table-list1">
    <tr align="center">
      <td colspan="2"><strong>KETERANGAN</strong></td>
    </tr>
    <tr>
      <td>TOTAL QTY GANTI KAIN</td>
      <td align="center"><?php echo $tclaim;?></td>
    </tr>
    <tr>
      <td>TOTAL QTY ORDER (REPLACEMENT)</td>
      <td align="center"><?php echo $torder;?></td>
    </tr>
    <tr>
      <td>PERSENTASE</td>
      <td align="center"><strong><?php echo $tpersen." %";?></strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>TOTAL QTY GANTI KAIN</td>
      <td align="center"><?php echo $tclaim;?></td>
    </tr>
    <tr>
      <td>TOTAL QTY KIRIM (<?php echo strtoupper(date("F Y", strtotime($Awal))); ?>)</td>
      <td align="center"><input type=text name=nama4 placeholder="Ketik disini" style="font-size: 11px;"></td>
    </tr>
    <tr>
      <td>PERSENTASE</td>
      <td align="center"><input type=text name=nama7 placeholder="Ketik disini" style="font-size: 11px;"></td>
    </tr>
    </table></td>
    </tr>
    <tr>
      <td><table width="30%" border="0" class="table-list1">
      <tr>
        <td>TOTAL QTY GANTI KAIN QCF</td>
        <td align="center">
        <?php
        $Awal=$_GET['awal'];
        $Akhir=$_GET['akhir'];
        if($Awal !="" AND $Akhir !=""){ $Where=" DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' ";} 
        $qryQC=mysqli_query($con,"SELECT SUM(qty_claim) AS qty_claim_qc FROM tbl_aftersales WHERE $Where AND (t_jawab='QCF' OR `t_jawab1`='QCF' OR `t_jawab2`='QCF')");
        $rowQC=mysqli_fetch_array($qryQC);
        ?>
        <?php echo $rowQC['qty_claim_qc'];?>
        </td>
      </tr>
      <tr>
        <td>TOTAL QTY ORDER (REPLACEMENT)</td>
        <td align="center"><?php echo $torder;?></td>
      </tr>
      <tr>
        <td>PERSENTASE</td>
        <td align="center"><?php echo round(($rowQC['qty_claim_qc']/$torder)*100,5)."%";?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>TOTAL QTY GANTI KAIN QCF</td>
        <td align="center"><?php echo $rowQC['qty_claim_qc'];?></td>
      </tr>
      <tr>
        <td>TOTAL QTY KIRIM (<?php echo strtoupper(date("F Y", strtotime($Awal))); ?>)</td>
        <td align="center"><input type=text name=nama5 placeholder="Ketik disini" style="font-size: 11px;"></td>
      </tr>
      <tr>
        <td>PERSENTASE</td>
        <td align="center"><input type=text name=nama6 placeholder="Ketik disini" style="font-size: 11px;"></td>
      </tr>
      </table></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" class="table-list1">
      <tr align="center" >
        <td>&nbsp;</td>
        <td>Dibuat Oleh</td>
        <td>Diperiksa Oleh</td>
        <td>Diketahui Oleh</td>
      </tr>
      <tr>
        <td>Nama</td>
        <td align="center"><input type=text name=nama placeholder="Ketik disini" style="font-size: 11px;"></td>
        <td align="center"><input type=text name=nama1 placeholder="Ketik disini" style="font-size: 11px;"></td>
        <td align="center">Agung Cahyono</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td align="center"><input type=text name=nama2 placeholder="Ketik disini" style="font-size: 11px;"></td>
        <td align="center"><input type=text name=nama3 placeholder="Ketik disini" style="font-size: 11px;"></td>
        <td align="center">Manager</td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td align="center">
          <?php echo $rTgl['tgl_skrg'];?>
        </td>
        <td align="center">
          <?php echo $rTgl['tgl_skrg'];?>
        </td>
        <td align="center">
          <?php echo $rTgl['tgl_skrg'];?>
        </td>
      </tr>
      <tr>
        <td height="60" valign="top">Tanda Tangan</td>
        <td>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    </tr>
  
</table>

<script>
//alert('cetak');window.print();
</script> 
</body>
</html>