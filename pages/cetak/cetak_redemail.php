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
<title>Cetak Red Category Email</title>
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
        <td align="center"><strong><font size="+1">RED CATEGORY EMAIL REPORT</font><br />
		<font size="-1">Periode: <?php echo date("d/m/Y", strtotime($Awal));?> s/d <?php echo date("d/m/Y", strtotime($Akhir));?></font>
    </tr>
  </table>

		</td>
    </tr>
	</thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1">
        <thead>
          <tr align="center">
            <td><font size="-2"><strong>NO</strong></font></td>
			      <td><font size="-2"><strong>TGL EMAIL</strong></font></td>
            <td><font size="-2"><strong>TGL JAWAB</strong></font></td>
            <td><font size="-2"><strong>LEADTIME > 2 HARI</strong></font></td>
            <td><font size="-2"><strong>LANGGANAN</strong></font></td>
            <td><font size="-2"><strong>PO</strong></font></td>
            <td><font size="-2"><strong>ORDER</strong></font></td>
            <td><font size="-2"><strong>HANGER</strong></font></td>
            <td><font size="-2"><strong>LOT</strong></font></td>
            <td><font size="-2"><strong>WARNA</strong></font></td>
            <td><font size="-2"><strong>MASALAH</strong></font></td>
          </tr>
		</thead>
		<tbody>  
		<?php
	$no=1;
	$Awal=$_GET['awal'];
	$Akhir=$_GET['akhir'];		
  $qry1=mysqli_query($con,"SELECT * FROM tbl_aftersales
  WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts_red='1'");
            while($row1=mysqli_fetch_array($qry1)){
              //$tglemail = new DateTime($row1['tgl_email']);
              //$tgljawab = new DateTime($row1['tgl_jawab']);
              //$delay = $tglemail->diff($tgljawab);
		 ?>
          <tr valign="top">
            <td align="center" valign="middle"><font size="-2"><?php echo $no;?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo date("l, d/m/y", strtotime($row1['tgl_email']));?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo date("l, d/m/y", strtotime($row1['tgl_jawab']));?></font></td>
            <td align="center" valign="middle"><font size="-2">
            <?php if($row1['leadtime_email']=="1 Hari Kerja" OR $row1['leadtime_email']=="2 Hari Kerja"){echo "<font color='#10890C'>$row1[leadtime_email]</font>";}
            else if($row1['leadtime_email']=="3 Hari Kerja" OR $row1['leadtime_email']=="4 Hari Kerja" OR $row1['leadtime_email']=="5 Hari Kerja" OR $row1['leadtime_email']=="6 Hari Kerja"){echo "<font color='#F20505'>$row1[leadtime_email]</font>";}?>
            <!--<?php if($delay->d==0){echo "<font color='#10890C'>1 Hari Kerja</font>"; 
            }else if($delay->d==1){echo "<font color='#10890C'>$delay->d Hari Kerja</font>";
            }else if($delay->d==2){echo "<font color='#10890C'>$delay->d Hari Kerja</font>";
            }else if($delay->d>2){echo "<font color='#F20505'>$delay->d Hari Kerja</font>";}?>-->
            </font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo strtoupper($row1['langganan']);?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo strtoupper($row1['po']);?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo strtoupper($row1['no_order']);?></font></td>
            <td align="left" valign="middle"><font size="-2"><?php echo strtoupper($row1['no_hanger']);?></font></td>
            <td align="center" valign="middle"><font size="-2"><?php echo $row1['lot'];?></font></td>
            <td align="left" valign="middle"><font size="-2"><?php echo strtoupper($row1['warna']);?></font></td>
            <td align="left" valign="middle"><font size="-2"><?php echo $row1['masalah'];?></font></td>
          </tr>
        <?php $no++;
        } 
        ?>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><table border="0" class="table-list1" width="100%">
        <tr align="center">
          <td width="14%">&nbsp;</td>
          <td width="17%">Dibuat Oleh :</td>
          <td width="14%">Menyetujui :</td>
        </tr>
        <tr>
          <td>Nama</td>
          <td align="center"><strong>Arif</strong></td>
          <td align="center"><input name="nama1" type="text" placeholder="Ketik" style="font-size: 11px;"/></td>
        </tr>
        <tr>
          <td>Jabatan</td>
          <td align="center">Asst.Spv</td>
          <td align="center"><input name="nama2" type="text" placeholder="Ketik" style="font-size: 11px;"/></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td align="center"><?php echo date("d F Y", strtotime($rTgl['tgl_skrg']));?></td>
          <td align="center"><?php echo date("d F Y", strtotime($rTgl['tgl_skrg']));?></td>
        </tr>
        <tr>
          <td valign="top" style="height: 0.6in;" >Tanda Tangan</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  
</table>

<script>
//alert('cetak');window.print();
</script> 
</body>
</html>