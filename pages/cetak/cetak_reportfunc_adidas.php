<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
//$con=mysqli_connect("localhost","root","");
//$db=mysqli_select_db("db_qc",$con)or die("Gagal Koneksi");
//--
//$idkk=$_GET['idkk'];
$now=date("Y-m-d");
$idkk=$_GET['idkk'];
$noitem=$_GET['noitem'];
$nohanger=$_GET['nohanger'];
$act=$_GET['g'];
$data=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',dry_note,wick_note,absor_note) AS note_g FROM tbl_tq_test WHERE id_nokk='$idkk' ORDER BY id DESC LIMIT 1");
$rcek1=mysqli_fetch_array($data);
$sqlCekR=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',rdry_note,rwick_note,rabsor_note) AS rnote_g FROM tbl_tq_randomtest WHERE no_item='$noitem' OR no_hanger='$nohanger'");
$rcekR=mysqli_fetch_array($sqlCekR);
$sqlCekD=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',ddry_note,dwick_note,dabsor_note) AS dnote_g FROM tbl_tq_disptest WHERE id_nokk='$idkk' ORDER BY id DESC LIMIT 1");
$rcekD=mysqli_fetch_array($sqlCekD);
$data1=mysqli_query($con,"SELECT nokk FROM tbl_tq_nokk WHERE id='$idkk'");
$rd=mysqli_fetch_array($data1);
$data2=mysqli_query($con,"SELECT a.*,b.hangtag FROM tbl_tq_nokk a LEFT JOIN tbl_master_hangtag b ON a.no_item = b.no_item WHERE a.id='$idkk'");
$rd2=mysqli_fetch_array($data2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Print Report Functional Adidas</title>
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
<table width="100%">
    <thead>
    <td><table width="100%" border="0" class="table-list1">  
                <tr>
                    <td align="center" colspan="8" valign="middle" style="border-top:0px #000000 solid; 
                                border-bottom:0px #000000 solid;
                                border-left:0px #000000 solid; 
                                border-right:0px #000000 solid;"><strong><font size="-2" >FABRIC TEST REPORT</font> <br> FW-12-QCF-04/01</strong></td>
                </tr>
                <tr>
                    <td align="right" colspan="8" style="border-top:0px #000000 solid; 
                                border-bottom:0px #000000 solid;
                                border-left:0px #000000 solid; 
                                border-right:0px #000000 solid;"><img src="adidas.jpg" width="130" height="30"/></td>
                </tr>
                <tr>
                    <td align="left" style="border-top:0px #000000 solid; 
                                border-bottom:0px #000000 solid;
                                border-left:0px #000000 solid; 
                                border-right:0px #000000 solid;">Test Report No. ITC<?php echo $rd2['no_test'];?></td>
                    <td align="left" style="border-top:0px #000000 solid; 
                                border-bottom:0px #000000 solid;
                                border-left:0px #000000 solid; 
                                border-right:0px #000000 solid;">Submission No. -</td>
                    <td align="right" style="border-top:0px #000000 solid; 
                                border-bottom:0px #000000 solid;
                                border-left:0px #000000 solid; 
                                border-right:0px #000000 solid;">Version : March 2021</td>
                </tr>
                </table>
                <table width="100%" border="1" class="table-list1">
                <tr>
                    <td align="left" colspan="8"><strong><font size="-2" >MATERIAL SPESIFICATION:</font></strong></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 8px;">Testing Type:</td>
                    <td align="left" style="font-size: 8px;">New Development Testing (<?php if($rd2['development']=="Development"){echo "&#10003";}?>)</td>
                    <td colspan="4" align="left" style="font-size: 8px;">1st Bulk Testing (<?php if($rd2['development']=="1st Bulk"){echo "&#10003";}?>)</td>
                    <td colspan="2" align="left" style="font-size: 8px;">Reorder Testing (<?php if($rd2['development']=="Reorder"){echo "&#10003";}?>)</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 8px;">Material Supplier</td>
                    <td align="left" style="font-size: 8px;">Indo Taichen Textile Industry</td>
                    <td colspan="4" align="left" style="font-size: 8px;">Season : <?php echo $rd2['season'];?></td>
                    <td align="left" style="font-size: 8px;">P.O.No.</td>
                    <td align="left" style="font-size: 8px;"><?php echo $rd2['no_po'];?></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 8px;">adidas Ref. No.</td>
                    <td align="left" style="font-size: 8px;"><?php echo $rd2['no_item'];?></td>
                    <td align="left" style="font-size: 8px;">Weight</td>
                    <td align="left" style="font-size: 8px;"><?php echo $rd2['gramasi'];?>g/m<sup>2</sup></td>
                    <td align="left" style="font-size: 8px;">Width</td>
                    <td align="left" style="font-size: 8px;"><?php echo $rd2['lebar'];?> inch</td>
                    <td align="left" style="font-size: 8px;">Order</td>
                    <td align="left" style="font-size: 8px;"><?php echo $rd2['no_order'];?></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 8px;">Supplier Ref.</td>
                    <td align="left" style="font-size: 8px;">134001</td>
                    <td align="left" style="font-size: 8px;">Garment Maker</td>
                    <td colspan="3" align="left" style="font-size: 8px;"><?php echo $rd2['pelanggan'];?></td>
                    <td align="left" style="font-size: 8px;">Color Code/Name :</td>
                    <td align="left" style="font-size: 8px;"><?php echo $rd2['warna'];?></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 8px;">&nbsp;</td>
                    <td align="left" style="font-size: 8px;">
                    <?php
                    $sql = "SELECT * From tbl_tq_nokk WHERE id='$idkk'";
                    $result=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($result)){ 
                    $detail=explode(",",$row['jenis_kain']);?>
                    <!-- <?php echo $detail[0];?> -->
                    &nbsp;
                    </td>
                    <td align="left" style="font-size: 8px;">Construction</td>
                    <td align="left" style="font-size: 8px;">
                    <?php 
                        if($detail[0]!=""){echo $detail[0];}else{echo "";}
                    ?>
                    </td>
                    <td align="left" style="font-size: 8px;">Color No.</td>
                    <td align="left" style="font-size: 8px;"><?php echo $rd2['no_warna'];?></td>
                    <td align="left" style="font-size: 8px;">Lot</td>
                    <td align="left" style="font-size: 8px;"><?php echo $rd2['lot'];?></td>
                </tr>
                <tr>
                    <td rowspan="2" align="left" style="font-size: 8px;"><strong>Hangtag:</strong></td>
                    <td rowspan="2" colspan="3" align="left" style="font-size: 8px;"><?php echo $rd2['hangtag'];?></td>
                    <td rowspan="2" align="left" valign="top" style="font-size: 8px;"><strong>Remarks:</strong></td>
                    <td rowspan="2" colspan="3" align="left" style="font-size: 8px;"><?php 
                        if($detail[1]!=""){echo $detail[1];}else{echo "";}
                    ?></td>
                    <?php }?>
                </tr>
                <tr>
                    <!-- <td align="left" style="font-size: 8px;"></td> -->
                    <!-- <td align="left" style="font-size: 8px;"></td> -->
                </tr>
                <tr>
                    <td colspan="8" align="center" style="font-size: 11px;"><strong>Fabric Functional Tests</strong></td>
                </tr>
            </table></td>
        
    </thead>
    <tr>
        <td><table width="100%" border="1" class="table-list1">
            <tr>
            <thead>	  
                <tr>
                    <td width="4%" rowspan="4" scope="col" style="font-size: 8px;"><div align="center"><strong>Method ID</strong></div></td>
                    <td width="4%" rowspan="4" scope="col" style="font-size: 8px;"><div align="left"><strong>Fabric<br>Tech.<br>K: Knit<br>W: Woven</strong></div></td>
                    <td width="4%" rowspan="4" scope="col" style="font-size: 8px;"><div align="left"><strong>Composition<br>N: Natural<br>S: Synthetic</strong></div></td>
                    <td width="11%" rowspan="4" scope="col" style="font-size: 8px;"><div align="center"><strong>Test Standard Name</strong></div></td>
                    <td width="13%" rowspan="4" scope="col" style="font-size: 8px;"><div align="center"><strong>Minimum Requirements<br>Underlined requirements are mandatory<br>on material level!</strong></div></td>
                    <td width="4%" rowspan="4" scope="col" style="font-size: 8px;"><div align="center"><strong>Test Result</strong></div></td>
                    <td width="4%" rowspan="4" scope="col" style="font-size: 8px;"><div align="center"><strong>Test Details</strong></div></td>
                    <td width="2%" rowspan="4" scope="col" style="font-size: 8px;"><div align="center"><strong>A</strong></div></td>
                    <td width="2%" rowspan="4" scope="col" style="font-size: 8px;"><div align="center"><strong>R</strong></div></td>
                </tr>
            </thead>
            </tr>
        <!--Absorbency-->
        <tr>
            <td align="left" rowspan="2" style="font-size: 8px;" valign="top"><strong>PHM-AP0604</strong></td>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>KW</strong></td>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>NS</strong></td>
            <td align="left" rowspan="2" style="font-size: 8px;" valign="top"><strong>Water Absorbency (drop test)</strong><br><br>*PHX-AP0604 is required as well for all<br>fabrics with hydrophilic finish</td>
            <td align="left" rowspan="2" style="font-size: 8px;" >Depends On RDY Label<br><br>&ge; 3 sec Knits / &le; 5 sec Woven<br>&le; 5 sec Seamless (Knits & Woven)</td>
            <td align="center" rowspan="2" style="font-size: 8px;" >
            <?php if($rcek1['stat_abs']=="RANDOM"){echo $rcekR['rabsor_f1'];}else if($rcek1['stat_abs']=="DISPOSISI"){echo $rcekD['dabsor_f1'];}else{echo $rcek1['absor_f1'];}?><br><br>
            <?php if($rcek1['stat_abs1']=="RANDOM"){echo $rcekR['rabsor_b1'];}else if($rcek1['stat_abs1']=="DISPOSISI"){echo $rcekD['dabsor_b1'];}else{echo $rcek1['absor_b1'];}?>
            </td>
            <td align="left" style="font-size: 8px;" >[sec] Before Wash</td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if(($rcek1['stat_abs']=="A" OR $rcek1['stat_abs']=="PASS" OR $rcek1['stat_abs']=="FAIL" OR $rcek1['stat_abs']=="RANDOM" OR $rcek1['stat_abs']=="DISPOSISI") AND ($rcek1['stat_abs1']=="A" OR $rcek1['stat_abs1']=="PASS" OR $rcek1['stat_abs1']=="FAIL" OR $rcek1['stat_abs1']=="RANDOM" OR $rcek1['stat_abs1']=="DISPOSISI")){echo "A";}?></td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if($rcek1['stat_abs']=="R" OR $rcek1['stat_abs1']=="R"){echo "R";}?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 8px;" >[sec] After 5 Wash</td>
        </tr>
        <!--Wicking-->
        <tr>
            <td align="left" rowspan="4" style="font-size: 8px;" valign="top"><strong>PHM-AP0616</strong></td>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>KW</strong></td>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>NS</strong></td>
            <td align="left" rowspan="2" style="font-size: 8px;" valign="top"><strong>Wicking Height-Vertical</strong></td>
            <td align="left" rowspan="2" style="font-size: 8px;" >Depends On RDY Label<br><br>&ge; 100 mm Knits (incl. Seamless)<br>&ge; 90 mm Woven_[mm/30min]</td>
            <td align="center" rowspan="2" style="font-size: 8px;" >
            <?php if($rcek1['stat_wic']=="RANDOM"){echo $rcekR['rwick_l1'];}else if($rcek1['stat_wic']=="DISPOSISI"){echo $rcekD['dwick_l1'];}else{echo $rcek1['wick_l1'];}?><br><br>
            <?php if($rcek1['stat_wic2']=="RANDOM"){echo $rcekR['rwick_l2'];}else if($rcek1['stat_wic2']=="DISPOSISI"){echo $rcekD['dwick_l2'];}else{echo $rcek1['wick_l2'];}?>
            </td>
            <td align="left" style="font-size: 8px;" >(mm) Before Wash</td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if(($rcek1['stat_wic']=="A" OR $rcek1['stat_wic']=="PASS" OR $rcek1['stat_wic']=="FAIL" OR $rcek1['stat_wic']=="RANDOM" OR $rcek1['stat_wic']=="DISPOSISI") AND ($rcek1['stat_wic2']=="A" OR $rcek1['stat_wic2']=="PASS" OR $rcek1['stat_wic2']=="FAIL" OR $rcek1['stat_wic2']=="RANDOM" OR $rcek1['stat_wic2']=="DISPOSISI")){echo "A";}?></td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if($rcek1['stat_wic']=="R" OR $rcek1['stat_wic2']=="R"){echo "R";}?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 8px;" >(mm) After 5 Wash</td>
        </tr>
        <tr>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>KW</strong></td>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>NS</strong></td>
            <td align="left" rowspan="2" style="font-size: 8px;" valign="top"><strong>Wicking Height-Horizontal</strong></td>
            <td align="left" rowspan="2" style="font-size: 8px;" >Depends On RDY Label<br><br>&ge; 100 mm Knits (incl. Seamless)<br>&ge; 90 mm Woven_[mm/30min]</td>
            <td align="center" rowspan="2" style="font-size: 8px;" >
            <?php if($rcek1['stat_wic1']=="RANDOM"){echo $rcekR['rwick_w1'];}else if($rcek1['stat_wic1']=="DISPOSISI"){echo $rcekD['dwick_w1'];}else{echo $rcek1['wick_w1'];}?><br><br>
            <?php if($rcek1['stat_wic3']=="RANDOM"){echo $rcekR['rwick_w2'];}else if($rcek1['stat_wic3']=="DISPOSISI"){echo $rcekD['dwick_w2'];}else{echo $rcek1['wick_w2'];}?>
            </td>
            <td align="left" style="font-size: 8px;" >(mm) Before Wash</td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if(($rcek1['stat_wic1']=="A" OR $rcek1['stat_wic1']=="PASS" OR $rcek1['stat_wic1']=="FAIL" OR $rcek1['stat_wic1']=="RANDOM" OR $rcek1['stat_wic1']=="DISPOSISI") AND ($rcek1['stat_wic3']=="A" OR $rcek1['stat_wic3']=="PASS" OR $rcek1['stat_wic3']=="FAIL" OR $rcek1['stat_wic3']=="RANDOM" OR $rcek1['stat_wic3']=="DISPOSISI")){echo "A";}?></td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if($rcek1['stat_wic1']=="R" OR $rcek1['stat_wic3']=="R"){echo "R";}?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 8px;" >(mm) After 5 Wash</td>
        </tr>
        <!--Evaporation Rate-->
        <tr>
            <td align="left" rowspan="2" style="font-size: 8px;" valign="top"><strong>PHM-AP0617</strong></td>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>KW</strong></td>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>NS</strong></td>
            <td align="left" rowspan="2" style="font-size: 8px;" valign="top"><strong>Evaporation Rate</strong><br><br>*PHM-AP0617 is to replace PHX-AP0607</td>
            <td align="left" rowspan="2" style="font-size: 8px;" >Depends On RDY Label<br><br>&ge; 0.2</td>
            <td align="center" rowspan="2" style="font-size: 8px;" >
            <?php if($rcek1['stat_dry']=="RANDOM"){echo $rcekR['rdry1'];}else if($rcek1['stat_dry']=="DISPOSISI"){echo $rcekD['ddry1'];}else{echo $rcek1['dry1'];}?><br><br>
            <?php if($rcek1['stat_dry1']=="RANDOM"){echo $rcekR['rdryaf1'];}else if($rcek1['stat_dry1']=="DISPOSISI"){echo $rcekD['ddryaf1'];}else{echo $rcek1['dryaf1'];}?>
            </td>
            <td align="left" style="font-size: 8px;" >(g/h) Before Wash</td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if(($rcek1['stat_dry']=="A" OR $rcek1['stat_dry']=="PASS" OR $rcek1['stat_dry']=="FAIL" OR $rcek1['stat_dry']=="RANDOM" OR $rcek1['stat_dry']=="DISPOSISI") AND ($rcek1['stat_dry1']=="A" OR $rcek1['stat_dry1']=="PASS" OR $rcek1['stat_dry1']=="FAIL" OR $rcek1['stat_dry1']=="RANDOM" OR $rcek1['stat_dry1']=="DISPOSISI")){echo "A";}?></td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if($rcek1['stat_dry']=="R" OR $rcek1['stat_dry1']=="R"){echo "R";}?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 8px;" >(g/h) After 5 Wash</td>
        </tr>
        <!--Water Reppelent-->
        <tr>
            <td align="left" rowspan="2" style="font-size: 8px;" valign="top"><strong>PHM-AP0601</strong></td>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>KW</strong></td>
            <td align="center" rowspan="2" style="font-size: 8px;" valign="top"><strong>NS</strong></td>
            <td align="left" rowspan="2" style="font-size: 8px;" valign="top"><strong>Water reppelency Spray test</strong><br><br>*PHX-AP0601 is required as well for all<br>fabrics with WR &amp; DWR finish</td>
            <td align="left" style="font-size: 8px;" >&ge; 4</td>
            <!--<td align="left" style="font-size: 8px;" >&ge; 4</td>-->
            <td align="center" rowspan="2" style="font-size: 8px;" >
            <?php if($rcek1['stat_wp']=="RANDOM"){echo $rcekR['rrepp1'];}else if($rcek1['stat_wp']=="DISPOSISI"){echo $rcekD['drepp1'];}else{echo $rcek1['repp1'];}?><br><br>
            <?php if($rcek1['stat_wp1']=="RANDOM"){echo $rcekR['rrepp2'];}else if($rcek1['stat_wp1']=="DISPOSISI"){echo $rcekD['drepp2'];}else{echo $rcek1['repp2'];}?>
            </td>
            <td align="left" style="font-size: 8px;" >(rating) Before Wash</td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if(($rcek1['stat_wp']=="A" OR $rcek1['stat_wp']=="PASS" OR $rcek1['stat_wp']=="FAIL" OR $rcek1['stat_wp']=="RANDOM" OR $rcek1['stat_wp']=="DISPOSISI") AND ($rcek1['stat_wp1']=="A" OR $rcek1['stat_wp1']=="PASS" OR $rcek1['stat_wp1']=="FAIL" OR $rcek1['stat_wp1']=="RANDOM" OR $rcek1['stat_wp1']=="DISPOSISI")){echo "A";}?></td>
            <td align="center" rowspan="2" style="font-size: 8px;"><?php if($rcek1['stat_wp']=="R" OR $rcek1['stat_wp1']=="R"){echo "R";}?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 8px;" >&ge; 4</td>
            <td align="left" style="font-size: 8px;" >(rating) After 10 Wash</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 8px;" valign="top">Comments:</td>
            <td align="left" colspan="8" style="font-size: 8px;"></td>
        </tr>
        <table width="100%" border="0">
        <tr>
            <td align="left" style="font-size: 8px;" colspan="9">* All tests need to follow the adidas "Quality Assurance Test Matrix" according to lab test and most updated version</td>
        </tr>
        <tr>
            <td align="right" style="font-size: 8px;" colspan="9"><strong>Prepared and checked by: <?php echo $rcek1['approve'];?></strong></td>
        </tr>
        <tr>
            <td align="right" style="font-size: 8px;" colspan="9"><strong>Report issued date: <?php echo $now;?></strong></td>
        </tr>
        </table>
</table></td>
</table>
</body>
</html>