<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
$idkk=$_GET['idkk'];
$noitem=$_GET['noitem'];
$nohanger=$_GET['nohanger'];
$now=date("Y-m-d");
$data=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',fc_note,ph_note, abr_note, bas_note, fla_note, fwe_note, fwi_note, burs_note,repp_note,apper_note,fiber_note,pillb_note,pillm_note,pillr_note,thick_note,growth_note,recover_note,stretch_note,sns_note,snab_note,snam_note,snap_note,wash_note,water_note,acid_note,alkaline_note,crock_note,phenolic_note,cm_printing_note,cm_dye_note,light_note,light_pers_note,saliva_note,h_shrinkage_note,fibre_note,pilll_note,soil_note,apperss_note,bleeding_note,chlorin_note,dye_tf_note) AS note_g FROM tbl_tq_test WHERE id_nokk='$idkk' ORDER BY id DESC LIMIT 1");
$rcek1=mysqli_fetch_array($data);
$databs=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',bas_note) AS note_bs FROM tbl_tq_test WHERE id_nokk='$idkk' ORDER BY id DESC LIMIT 1");
$rcekbs=mysqli_fetch_array($databs);
$sqlCekR=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',rfc_note,rph_note, rabr_note, rbas_note, rfla_note, rfwe_note, rfwi_note, rburs_note,rrepp_note,rapper_note,rfiber_note,rpillb_note,rpillm_note,rpillr_note,rthick_note,rgrowth_note,rrecover_note,rstretch_note,rsns_note,rsnab_note,rsnam_note,rsnap_note,rwash_note,rwater_note,racid_note,ralkaline_note,rcrock_note,rphenolic_note,rcm_printing_note,rcm_dye_note,rlight_note,rlight_pers_note,rsaliva_note,rh_shrinkage_note,rfibre_note,rpilll_note,rsoil_note,rapperss_note,rbleeding_note,rchlorin_note,rdye_tf_note) AS rnote_g FROM tbl_tq_randomtest WHERE no_item='$noitem' OR no_hanger='$nohanger'");
$rcekR=mysqli_fetch_array($sqlCekR);
$sqlCekD=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',dfc_note,dph_note, dabr_note, dbas_note, dfla_note, dfwe_note, dfwi_note, dburs_note,drepp_note,dapper_note,dfiber_note,dpillb_note,dpillm_note,dpillr_note,dthick_note,dgrowth_note,drecover_note,dstretch_note,dsns_note,dsnab_note,dsnam_note,dsnap_note,dwash_note,dwater_note,dacid_note,dalkaline_note,dcrock_note,dphenolic_note,dcm_printing_note,dcm_dye_note,dlight_note,dlight_pers_note,dsaliva_note,dh_shrinkage_note,dfibre_note,dpilll_note,dsoil_note,dapperss_note,dbleeding_note,dchlorin_note,ddye_tf_note) AS dnote_g FROM tbl_tq_disptest WHERE id_nokk='$idkk' ORDER BY id DESC LIMIT 1");
$rcekD=mysqli_fetch_array($sqlCekD);
$sqlCekM=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',mfc_note,mph_note, mabr_note, mbas_note, mdry_note, mfla_note, mfwe_note, mfwi_note, mburs_note,mrepp_note,mwick_note,mabsor_note,mapper_note,mfiber_note,mpillb_note,mpillm_note,mpillr_note,mthick_note,mgrowth_note,mrecover_note,mstretch_note,msns_note,msnab_note,msnam_note,msnap_note,mwash_note,mwater_note,macid_note,malkaline_note,mcrock_note,mphenolic_note,mcm_printing_note,mcm_dye_note,mlight_note,mlight_pers_note,msaliva_note,mh_shrinkage_note,mfibre_note,mpilll_note,msoil_note,mapperss_note,mbleeding_note,mchlorin_note,mdye_tf_note,mhumidity_note,modour_note) AS mnote_g FROM tbl_tq_marginal WHERE id_nokk='$idkk' ORDER BY id DESC LIMIT 1");
$rcekM=mysqli_fetch_array($sqlCekM);
$data1=mysqli_query($con,"SELECT nokk FROM tbl_tq_nokk WHERE id='$idkk'");
$rd=mysqli_fetch_array($data1);
$data2=mysqli_query($con,"SELECT * FROM tbl_tq_nokk WHERE id='$idkk'");
$rd2=mysqli_fetch_array($data2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Print Report Vision Brand</title>
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
   body {
        -webkit-print-color-adjust: exact !important; /* Chrome, Safari */
        color-adjust: exact !important; /*Firefox*/
        }
}

textarea { 
    border-style: none; 
    border-color: Transparent; 
    overflow: auto;        
  }
</style>
</head>
<body>
    <table width="100%" border="0">
        <!-- Page 1 Begin -->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid;"><img src="ITTI_Logo.png" width="100" height="100" alt=""/></td>
                    <td width="90%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b>PT. INDO TAICHEN TEXTILE INDUSTRY<br>Jl. Gatot Subroto KM. 3 Kel. Uwung Jaya, Cibodas, Tangerang, <br> Banten, 15138, P.O BOX 487. Phone : (021) 5520920 (Hunting), <br> FAX : (021) 5523763, 55790329, 5520035. E-mail : qcf.labtest@indotaichen.com</b></td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 18px;"><b>TEST REPORT</b></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">NO. ITTI<?php echo $rd2['no_test'];?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;"><?php echo date("M j, Y", strtotime($now));?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">Page 1 of 6</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b>VISION BRANDS GROUP</b></td>
                </tr>
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b>LEVEL 3, 33-41 BALMAIN STREET</b></td>
                </tr>
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b>CREMORNE VICTORIA 3121 AUSTRALIA</b></td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td align="left" style="font-size: 12px;">The following sample was (were) submitted and identified by the client as:</td> 
        </tr>
        <tr>
            <td><table width="100%" border="" class="table-list1"> 
                <tr>
                    <td width="20%" align="left" 
                    style="font-size: 12px;"><b>Sample No.</b></td>
                    <td width="80%" align="left" 
                    style="font-size: 12px;"><b>Sample Description</b></td>
                </tr>
                <tr>
                    <td width="20%" align="left" 
                    style="font-size: 12px;"><?php echo $rd2['no_item'];?></td>
                    <td width="80%" align="left" 
                    style="font-size: 12px;"><?php echo $rd2['jenis_kain'];?> WITH FABRIC WEIGHT <?php echo $rd2['gramasi'];?> GSM</td>
                </tr>
            </table></td> 
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Client's reference No.</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['no_test'];?></td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Buyer</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Vision Brands Group</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Brand</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">/</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">PO Number</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['no_po'];?></td>
                </tr>
                <!-- <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Order Number</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['no_order'];?></td>
                </tr> -->
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Style Number</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['style'];?></td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Keycode</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">/</td>
                </tr>
                <!-- <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Fabric Width</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['lebar'];?> inch</td>
                </tr> -->
                <!-- <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Fabric Weight</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['gramasi'];?> g/m<sup>2</sup></td>
                </tr> -->
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Season</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['season'];?></td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Category</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">/</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Lot</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['lot'];?></td>
                </tr>
                <!-- <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Color</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['warna'];?></td>
                </tr> -->
                <!-- <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Color No.</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['no_warna'];?></td>
                </tr> -->
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">End use</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">ACTIVE WEAR</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Manufacturer</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">/</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Supplier</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">/</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Garment Fit</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">LOOSE</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Country of Origin</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">INDONESIA</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Country of Destination</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">AUSTRALIA</td>
                </tr>
                <tr>
                    <td width="35%" align="left" valign="top"
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Applicant's proposed care instructions</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">CDMW9(WASH BEFORE WEAR, TURN INSIDE OUT, COLD DELICATE MACHINE WASH SEPARATELY, DO NOT BLEACH, SOAK OR RUB, DO NOT TUMBLE DRY, WARM IRON (DO NOT IRON PRINTS OR EMBELLISHMENTS), DO NOT DRY CLEAN)</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Sample Receiving Date</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo date("M j, Y", strtotime($rd2['tgl_masuk']));?></td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Test Performing Period</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">3-4 workdays</td>
                </tr>
                <tr>
                    <td width="35%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Test Results</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="60%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Please refer to the next page(s).</td>
                </tr>
            </table></td> 
        </tr>
    </table>
    <div class="pagebreak"></div>
        <!-- Page 1 End -->
        <!-- Page 2 Begin -->        
    <table width="100%">
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid;"><img src="ITTI_Logo.png" width="100" height="100" alt=""/></td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 18px;"><b>TEST REPORT</b></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">NO. ITTI<?php echo $rd2['no_test'];?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;"><?php echo date("M j, Y", strtotime($now));?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">Page 2 of 6</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b>Preformed Test Summary: </b></td>
                    <td width="70%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Selected test(s) as requested by client against Client's performance standard.</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td><table width="60%" border="1" class="table-list1"> 
                <tr>
                    <td width="40%" align="center" 
                    style="font-size: 12px;" rowspan="2"><b>Test Parameters </b></td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><b>Result </b></td>
                </tr>
                <tr>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><b><?php echo $rd2['no_item']."-".$rd2['warna'];?></b></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Dimensional Stability to Washing</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_fwss']=='PASS'){echo "M";}else if($rcek1['stat_fwss']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Skewness</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_fwss']=='PASS'){echo "M";}else if($rcek1['stat_fwss']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Colour Fastness To Washing</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_wf']=='PASS'){echo "M";}else if($rcek1['stat_wf']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Colour Fastness To Water</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_wtr']=='PASS'){echo "M";}else if($rcek1['stat_wtr']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Colour Fastness To Perspiration</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_pal']=='PASS' AND $rcek1['stat_pac']=='PASS'){echo "M";}else if($rcek1['stat_pal']=='FAIL' OR $rcek1['stat_pac']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Colour Fastness To Rubbing</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_cr']=='PASS'){echo "M";}else if($rcek1['stat_cr']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Colour Fastness To Light</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_lg']=='PASS'){echo "M";}else if($rcek1['stat_lg']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Fabric Weight</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_fwss2']=='PASS'){echo "M";}else if($rcek1['stat_fwss2']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Fiber Content</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_fib']=='PASS'){echo "M";}else if($rcek1['stat_fib']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <!-- <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Appearance After Wash</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_ap']=='PASS'){echo "M";}else if($rcek1['stat_ap']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr> -->
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">Pilling Resistance</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_pb']=='PASS'){echo "M";}else if($rcek1['stat_pb']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="40%" align="left" 
                    style="font-size: 12px;">pH Value</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;"><?php if($rcek1['stat_ph']=='PASS'){echo "M";}else if($rcek1['stat_ph']=='FAIL'){echo "F";}else{echo "N/A";}?></td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td><table width="70%" border="0" class="table-list1"> 
                <tr>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Remarks</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">:</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">M = Pass</td>
                </tr>
                <tr>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">F = Fail</td>
                </tr>
                <tr>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">* = No specified requirement</td>
                </tr>
                <tr>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="3%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">N/A = Not Applicable</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <tr>
            <td><table width="30%" border="0" class="table-list1"> 
                <tr>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Signed for and on behalf of</td>
                </tr>
                <tr>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">PT. Indo Taichen Textile Industry</td>
                </tr>
                <tr>
                    <td align="center" width="20%" style="border-top:0px #000000 solid; 
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><img src="../../dist/img/Ferry Wibowo.png" height="70" alt=""/></td>
                </tr>
                <tr>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Ferry Wibowo</td>
                </tr>
                <tr>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Asst. Manager QCF</td>
                </tr>
            </table></td>
        </tr>
    </table>
    <div class="pagebreak"></div>
    <!-- Page 2 End -->
    <!-- Page 3 Begin -->        
    <table width="100%">
    <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid;"><img src="ITTI_Logo.png" width="100" height="100" alt=""/></td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 18px;"><b>TEST REPORT</b></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">NO. ITTI<?php echo $rd2['no_test'];?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;"><?php echo date("M j, Y", strtotime($now));?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">Page 3 of 6</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b>Test Results: </b></td>
                </tr>
            </table></td>
        </tr>
        <!-- Dimensional Stability Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Dimensional Stability to Washing</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 6300-2012; Wash Program No. 4N Using front load, horizontal drum type machine, Machine Wash at 40 degree C, normal cycle, line dry)</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u>Sample <?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="13%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">After 1 wash Shrinkage (%)</td>
                    <td width="15%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><b><u>Requirement</u> </b></td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="13%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">----------------------</td>
                    <td width="15%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Length</td>
                    <td width="13%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['shrinkage_l1']!=''){echo $rcek1['shrinkage_l1'];}else{echo "N/A";}?></td>
                    <td width="15%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Length : &#177;5%</td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Width</td>
                    <td width="13%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['shrinkage_w1']!=''){echo $rcek1['shrinkage_w1'];}else{echo "N/A";}?></td>
                    <td width="15%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Width : -5%/+2%</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <tr>
            <td><table width="50%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Note:</td>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(+) Means Extension</td>
                    <td width="20%"align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(-) Means Shrinkage</td>
                </tr>
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Neg = Negligible</td>
                    <td width="20%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
            </table></td>
        </tr>
        <!-- Dimensional Stability End-->
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- Spirality Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Spirality/Twisting</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 16322-2; Wash Program No. 4N Using front load, horizontal drum type machine, Machine Wash at 40 degree C, normal cycle, line dry)</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u>After Washing</u></td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u><?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Twisting (cm)</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['spirality1']!=''){echo $rcek1['spirality1'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Max 5%</td>
                </tr>
            </table></td>
        </tr> 
        <!-- Spirality End-->
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- Color Fastness To Washing Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Colour Fastness To Washing</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 105-C06; Procedure B1M, 50 degree, 45 min)</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u><?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Change in shade</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['wash_colorchange']!=''){echo $rcek1['wash_colorchange'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Staining of multifibre stripe</td>
                    <td width="40%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="33%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Acetate</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['wash_acetate']!=''){echo $rcek1['wash_acetate'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Cotton</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['wash_cotton']!=''){echo $rcek1['wash_cotton'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Nylon</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['wash_nylon']!=''){echo $rcek1['wash_nylon'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">3</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Polyester</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['wash_poly']!=''){echo $rcek1['wash_poly'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Acrylic</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['wash_acrylic']!=''){echo $rcek1['wash_acrylic'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Wool</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['wash_wool']!=''){echo $rcek1['wash_wool'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Note: Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is bad 5 is good.</td>
                   
                </tr>
            </table></td>
        </tr>
        <!-- Color Fastness To Washing End-->
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- Color Fastness To Perspiration Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Colour Fastness To Perspiration</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 105-E04)</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u>Acid</u></td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u><?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Change in shade</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['acid_colorchange']!=''){echo $rcek1['acid_colorchange'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Staining of multifibre stripe</td>
                    <td width="40%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="33%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Acetate</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['acid_acetate']!=''){echo $rcek1['acid_acetate'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Cotton</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['acid_cotton']!=''){echo $rcek1['acid_cotton'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Nylon</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['acid_nylon']!=''){echo $rcek1['acid_nylon'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">3</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Polyester</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['acid_poly']!=''){echo $rcek1['acid_poly'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Acrylic</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['acid_acrylic']!=''){echo $rcek1['acid_acrylic'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Wool</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['acid_wool']!=''){echo $rcek1['acid_wool'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
            </table></td>
        </tr> 
    </table>
    <div class="pagebreak"></div>
    <!-- Page 3 End -->
    <!-- Page 4 Begin -->
    <table width="100%">
    <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid;"><img src="ITTI_Logo.png" width="100" height="100" alt=""/></td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 18px;"><b>TEST REPORT</b></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">NO. ITTI<?php echo $rd2['no_test'];?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;"><?php echo date("M j, Y", strtotime($now));?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">Page 4 of 6</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b>Test Results: </b></td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="13%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="23%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><b><u>Requirement</u> </b></td>
                </tr>
            </table></td>
        </tr>     
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>    
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u>Alkaline</u></td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u><?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Change in shade</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['alkaline_colorchange']!=''){echo $rcek1['alkaline_colorchange'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Staining of multifibre stripe</td>
                    <td width="40%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="33%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Acetate</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['alkaline_acetate']!=''){echo $rcek1['alkaline_acetate'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Cotton</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['alkaline_cotton']!=''){echo $rcek1['alkaline_cotton'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Nylon</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['alkaline_nylon']!=''){echo $rcek1['alkaline_nylon'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">3</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Polyester</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['alkaline_poly']!=''){echo $rcek1['alkaline_poly'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Acrylic</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['alkaline_acrylic']!=''){echo $rcek1['alkaline_acrylic'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Wool</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['alkaline_wool']!=''){echo $rcek1['alkaline_wool'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Note: Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is bad 5 is good.</td>
                   
                </tr>
            </table></td>
        </tr>
        <!-- Color Fastness To Perspiration End-->
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- Color Fastness To Water Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Colour Fastness To Water</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 105-E01)</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u><?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Change in shade</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['water_colorchange']!=''){echo $rcek1['water_colorchange'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Staining of multifibre stripe</td>
                    <td width="40%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="33%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Acetate</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['water_acetate']!=''){echo $rcek1['water_acetate'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Cotton</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['water_cotton']!=''){echo $rcek1['water_cotton'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Nylon</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['water_nylon']!=''){echo $rcek1['water_nylon'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">3</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Polyester</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['water_poly']!=''){echo $rcek1['water_poly'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Acrylic</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['water_acrylic']!=''){echo $rcek1['water_acrylic'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Wool</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['water_wool']!=''){echo $rcek1['water_wool'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
            </table></td>
        </tr>
        <!-- Color Fastness To Water End-->
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- Color Fastness To Rubbing Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Colour Fastness To Rubbing</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 105 X 12)</td>
                </tr>
            </table></td>
        </tr>  
        <tr>
            <td><table width="100%" border="0" class="table-list1">
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u><?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Dry Staining</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['crock_len1']!=''){echo $rcek1['crock_len1'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Wet Staining</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['crock_len2']!=''){echo $rcek1['crock_len2'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">3</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Note: Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is bad 5 is good.</td>
                </tr>
            </table></td>
        </tr> 
        <!-- Color Fastness To Rubbing End-->
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <!-- Color Fastness To Light Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Colour Fastness To Light</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 105 B03; Xenon-Arc Lamp)</td>
                </tr>
            </table></td>
        </tr>  
        <tr>
            <td><table width="100%" border="0" class="table-list1">
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u><?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Change in Shade</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['light_rating1']!=''){echo $rcek1['light_rating1'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;" > 
                        <select name="std" style="border:none;font-size: 12px;-webkit-appearance: none;">
                            <option value="4">4</option>
                            <option value="3-4">3-4</option>
                            <option value="3">3</option>
                            <option value="2-3">2-3</option>
                            <option value=""></option>
                        </select>
                    </td>
                    <!-- <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td> -->
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Note: Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is worst 5 is best.</td>
                </tr>
            </table></td>
        </tr> 
        <!-- Color Fastness To Light End-->
        <tr>
        </table>
    <div class="pagebreak"></div>
    <!-- Page 4 End -->
    <!-- Page 5 Begin -->
    <table width="100%">
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid;"><img src="ITTI_Logo.png" width="100" height="100" alt=""/></td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 18px;"><b>TEST REPORT</b></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">NO. ITTI<?php echo $rd2['no_test'];?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;"><?php echo date("M j, Y", strtotime($now));?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">Page 5 of 6</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b>Test Results: </b></td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="13%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="23%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><b><u>Requirement</u> </b></td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- Fabric Weight Per Unit Area Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Fabric Weight Per Unit Area</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ASTM D3776/D3776M-2009a; Option C)</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1">
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u><?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(g/m<sup>2</sup>)</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['f_weight']!=''){echo $rcek1['f_weight'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rd2['gramasi'];?> g/m<sup>2</sup> &#177;5%</td>
                </tr>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(oz/yd<sup>2</sup>)</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['f_weight']!=''){echo number_format($rcek1['f_weight']/33.906,2);}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
            </table></td>
        </tr>
        <!-- Fabric Weight Per Unit Area End-->     
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- Fibre Content Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Fibre Content</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 1833, Part 11) Based on moisture regain weight</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1">
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <?php if($rcek1['stat_fib']==''){?>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">N/A</td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr> 
                <?php } ?>
                <?php if($rcek1['fc_cott1']!=''){?>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rcek1['fc_cott1'];?> (%)</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['fc_cott']!=''){echo $rcek1['fc_cott'];}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['std_fc_cott1']!=''){echo $rcek1['std_fc_cott1']." ".$rcek1['fc_cott1']." &#177;5%";}?></td>
                </tr>
                <?php } 
                if($rcek1['fc_poly1']!=''){?>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rcek1['fc_poly1'];?> (%)</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['fc_poly']!=''){echo $rcek1['fc_poly'];}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['std_fc_poly1']!=''){echo $rcek1['std_fc_poly1']." ".$rcek1['fc_poly1']." &#177;5%";}?></td>
                </tr>
                <?php } 
                if($rcek1['fc_elastane1']!=''){?>
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php echo $rcek1['fc_elastane1'];?> (%)</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['fc_elastane']!=''){echo $rcek1['fc_elastane'];}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['std_fc_elastane1']!=''){echo $rcek1['std_fc_elastane1']." ".$rcek1['fc_elastane1']." &#177;5%";}?></td>
                </tr>
                <?php }?>
            </table></td>
        </tr>
        <!-- Fibre Content End--> 
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- Appearance After Wash Begin-->
        <!-- <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Appearance After Wash</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 6330, Wash Program No. 4N Using front load, horizontal drum type machine, Machine Wash at 40 degree C, normal cycle, line dry)</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1">
                <tr>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u>A</u></td>
                </tr> 
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u>After 1 wash :</u></td>
                </tr>
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">- Color change = <?php echo $rcek1['apper_cc1'];?></td>
                </tr>
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">- Pilling on faceside grade <?php echo $rcek1['apper_pf1'];?> and backside grade <?php echo $rcek1['apper_pb1'];?></td>
                </tr>
                <tr>
                    <td width="100%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">The overall appearance of the sample was found <?php echo $rcek1['apperss_ch1'];?>.</td>
                </tr>
            </table></td>
        </tr> -->
        <!-- Appearance After Wash End-->  
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- Pilling Resistance Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>Pilling Resistance</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">(ISO 12945-1-2001; 14400 rev. in ICI pilling tester for 4 hours.)</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1">
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u>As received / </u></td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><u><?php echo $rd2['no_item']."-".$rd2['warna'];?></u></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>  
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Rating</td>
                    <td width="40%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><?php if($rcek1['pb_f1']!=''){echo $rcek1['pb_f1'];}else{echo "N/A";}?></td>
                    <td width="33%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Min. 3-4</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="40%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Remarks: Pilling Rating:</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">5</td>
                    <td width="90%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">No pilling</td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">4</td>
                    <td width="90%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Slight surface fuzzing and/or partially formed pills.</td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">3</td>
                    <td width="90%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Moderate surface fuzzing and/or moderate pilling. Pills of varying size and density partially covering the specimen.</td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">2</td>
                    <td width="90%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Distinct fuzzing and/or distinct pilling. Pills of varying size and density covering a large proportion of the specimen surface.</td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">1</td>
                    <td width="90%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Dense surface and/or severe pilling. Pills of varying size and density covering the whole of the specimen surface.</td>
                </tr>
            </table></td>
        </tr>
        <!-- Pilling Resistance End--> 
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <!-- PH Begin-->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><u>pH Value</u> </b></td>
                </tr>
                <tr>
                    <td align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Test Method : According to EN ISO 3071:2020.</td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td><table width="50%" border="1" class="table-list1"> 
                <tr>
                    <td width="20%" align="left" 
                    style="font-size: 12px;" rowspan="2">&nbsp;</td>
                    <td width="10%" align="left" 
                    style="font-size: 12px;" >&nbsp;</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;" ><b><u>Result</u> </b></td>
                </tr>
                <tr>
                    <td width="10%" align="center" 
                    style="font-size: 12px;" ><b><u>CAS-No.</u> </b></td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;" ><b><u>1</u> </b></td>
                </tr>
                <tr>
                    <td width="10%" align="left" 
                    style="font-size: 12px;" >pH value</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;" >--</td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;" ><?php if($rcek1['ph']!=''){echo $rcek1['ph'];}else{echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="10%" align="left" 
                    style="font-size: 12px;" ><b>Conclusion</b></td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;" ><b>--</b></td>
                    <td width="20%" align="center" 
                    style="font-size: 12px;" ><b><?php if($rcek1['stat_ph']!=''){echo $rcek1['stat_ph'];}else{echo "N/A";}?></b></td>
                </tr>
            </table></td>
        </tr> 
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr> 
        <tr>
            <td><table width="70%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Note:</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Extraction medium</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">KCl solution</td>
                </tr>
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">pH value of extraction medium</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">5.0 - 7.5</td>
                </tr>
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">Temperature of the extraction solution</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">22 &#177; 2 &#8451;</td>
                </tr>
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><b>Requirement:</b></td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><b>White/pastel color: 4.5 - 6.0</b></td>
                </tr>
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><b>All denim = 4.5 - 6.0</b></td>
                </tr>
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;">&nbsp;</td>
                    <td width="30%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><b>Other color = 4.5 - 7.5</b></td>
                </tr>
            </table></td>
        </tr> 
        <!-- PH End-->
    </table>
    <div class="pagebreak"></div>
    <!-- Page 5 End -->
    <!-- Page 6 Begin -->
    <table width="100%">
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid;"><img src="ITTI_Logo.png" width="100" height="100" alt=""/></td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 18px;"><b>TEST REPORT</b></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">NO. ITTI<?php echo $rd2['no_test'];?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;"><?php echo date("M j, Y", strtotime($now));?></td>
                    <td width="25%" align="left" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 16px;">Page 6 of 6</td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="100%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b>Sample Picture</b></td>
                </tr>
                <tr>
                    <td width="100%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="100%" align="center" 
                    style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 14px;"><b><?php echo $rd2['no_item']."-".$rd2['warna'];?></b></td>
                </tr>
                <tr>
                    <td align="center" style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid;
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-size: 12px;"><img src="../../dist/img-visualbrand/<?php echo $rd2['pic_vbg'];?>" height="400" alt=""/></td> 
                </tr>
            </table></td>
        </tr>    
    </table>
</body>
</html>