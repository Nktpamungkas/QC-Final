<?php
ini_set("error_reporting", 1);
session_start();
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "../../koneksi.php";
include "../../tgl_indo.php";
//--
$idkk=$_REQUEST['idkk'];
$act=$_GET['g'];
//-
$Demand=$_GET['demand'];
$Ispacking=$_GET['ispacking'];
$Operator=$_GET['operator'];
$qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%Y-%m-%d') as tgl_skrg,DATE_FORMAT(now(),'%H:%i:%s') as jam_skrg");
$rTgl=mysqli_fetch_array($qTgl);
if($Awal!=""){$tgl=substr($Awal,0,10); $jam=$Awal;}else{$tgl=$rTgl['tgl_skrg']; $jam=$rTgl['jam_skrg'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak Inspection Report QC</title>
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
<body>
<table width="100%" border="0">
  <thead>
    <tr>
      <td><table width="100%" border="0" class="table-list1"> 
        <tr>
          <td align="center"><strong><font size="+1">PT. INDO TAICHEN PRODUCTION INSPECTION REPORT</font></strong></td>
        </tr>
        </table></td>
    </tr>
	</thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1">
        <thead>
          <tr>
			      <td width="10%" align="left"><font size="-2">Card No</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Prod. Order)</font></td>
            <td width="10%" align="left"><font size="-2">Color No</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Color No)</font></td>
            <td width="10%" align="left"><font size="-2">IM No</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(IM No)</font></td>
            <td width="10%" align="left"><font size="-2">Width</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Width)</font></td>
          </tr>
          <tr>
			      <td width="10%" align="left"><font size="-2">Customer</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Customer)</font></td>
            <td width="10%" align="left"><font size="-2">Date</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Date)</font></td>
            <td width="10%" align="left"><font size="-2">Style No</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Style No)</font></td>
            <td width="10%" align="left"><font size="-2">Gramasi</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Gramasi)</font></td>
          </tr>
          <tr>
			      <td width="10%" align="left"><font size="-2">Order</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Order)</font></td>
            <td width="10%" align="left"><font size="-2">No Demand</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(No Demand)</font></td>
            <td width="10%" align="left"><font size="-2">Color</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Color)</font></td>
            <td width="10%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="3%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="12%" align="left"><font size="-2">&nbsp;</font></td>
          </tr>
          <tr>
			      <td width="10%" align="left"><font size="-2">PO</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(PO)</font></td>
            <td width="10%" align="left"><font size="-2">Description</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Description)</font></td>
            <td width="10%" align="left"><font size="-2">No Item</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(No Item)</font></td>
            <td width="10%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="3%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="12%" align="left"><font size="-2">&nbsp;</font></td>
          </tr>
          <tr>
			      <td width="10%" align="left"><font size="-2">Buyer</font></td>
            <td width="3%" align="left"><font size="-2">:</font></td>
            <td width="12%" align="left"><font size="-2">(Buyer)</font></td>
            <td width="10%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="3%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="12%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="10%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="3%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="12%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="10%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="3%" align="left"><font size="-2">&nbsp;</font></td>
            <td width="12%" align="left"><font size="-2">&nbsp;</font></td>
          </tr>
        </thead>
      </table></td>
    </tr>
    <tr>
      <td><table width="100%" border="1" class="table-list1">
        <tr>

        </tr>
      </table></td>
    </tr>
</table>

<script>
//alert('cetak');window.print();
</script> 
</body>
</html>