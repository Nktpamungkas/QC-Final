<?php
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";

?>
<?php
$Awal		= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir		= isset($_POST['akhir']) ? $_POST['akhir'] : '';
$TotalKirim		= isset($_POST['total']) ? $_POST['total'] : '';
$TotalLot		= isset($_POST['totallot']) ? $_POST['totallot'] : '';
$Langganan		= isset($_POST['langganan']) ? $_POST['langganan'] : '';

if($Awal!="" and $Akhir!=""){  
	$tglAw=date('d F Y', strtotime($Awal));
	$tglAk=date('d F Y', strtotime($Akhir));
	}else{
	$tglAw=" - ";
	$tglAk=" - ";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Grafik</title>
	<script src="plugins/highcharts/code/highcharts.js"></script>
    <script src="plugins/highcharts/code/highcharts-3d.js"></script>
	<script src="plugins/highcharts/code/modules/exporting.js"></script>
    <script src="plugins/highcharts/code/modules/export-data.js"></script>
	<style type="text/css">
#container {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container1 {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container2 {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container3 {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container4 {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container5 {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
	</style>
  </head>

  <body>

        <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Filter Grafik Per Periode</h3>
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
            <div class="box-body">
            <div class="form-group">
                <div class="col-sm-2">
                    <div class="input-group date">
                        <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                        <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group date">
                        <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                        <input name="akhir" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Akhir" value="<?php echo $Akhir; ?>" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group date">
                        <div class="input-group-addon"> Total Kirim</div>
                        <input name="total" type="text" class="form-control pull-right" placeholder="0" value="<?php echo $TotalKirim; ?>" />
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group date">
                        <div class="input-group-addon"> Total Lot Kirim</div>
                        <input name="totallot" type="text" class="form-control pull-right" placeholder="0" value="<?php echo $TotalLot; ?>" />
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group date">
                        <div class="input-group-addon"> Langganan</div>
                        <input name="langganan" type="text" class="form-control pull-right" placeholder="Langganan" value="<?php echo $Langganan; ?>" />
                    </div>
                </div>
                <button type="submit" class="btn btn-success " name="cari"><i class="fa fa-search"></i> Cari Data</button>
                <!-- /.input group -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer -->

            </div>
        </form>
        </div>
        <!--Section 2 -->
        <div class="row">
            <div class="col-xs-6">	
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 5 Langganan Terbesar KPE</h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                            <th width="5%"><div align="center">No</div></th>
                            <th width="25%"><div align="center">Langganan</div></th>
                            <th width="10%"><div align="center">Qty Keluhan (KG)</div></th>
                            <th width="15%"><div align="center">% Dibandingkan Total Kirim</div></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no1=1;
                        $total1=0;
                        $totaldll=0;
                        $qryAll=mysqli_query($con,"SELECT COUNT(*) AS jml_all, SUM(qty_claim) AS qty_claim_all FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'");
                        $rAll=mysqli_fetch_array($qryAll);
                        $qrylgn=mysqli_query($con,"SELECT SUM(qty_claim) AS qty_claim_lgn, ROUND(COUNT(langganan)/(SELECT COUNT(*) FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir')*100,1) AS persen,
                        langganan
                        FROM
                        `tbl_aftersales`
                        WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                        GROUP BY langganan
                        ORDER BY qty_claim_lgn DESC LIMIT 5");
                        while($r=mysqli_fetch_array($qrylgn)){
                        //$qrycase=mysqli_query("SELECT SUM(qty_claim) AS qty_claim_lgn FROM tbl_aftersales WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' AND 
                        //langganan='$r[langganan]'");
                        //$r1=mysqli_fetch_array($qrycase);
                        ?>
                        <tr valign="top">
                            <td align="center"><?php echo $no1; ?></td>
                            <td align="left"><?php echo $r['langganan'];?></td>
                            <td align="right"><?php echo $r['qty_claim_lgn'];?></td>
                            <td align="right"><?php if($TotalKirim!=""){echo number_format(($r['qty_claim_lgn']/(int)$TotalKirim)*100,2)." %";}else{echo "0 %";}?></td>
                        </tr>
                        <?php	$no1++;  
                        $total1=$total1+$r['qty_claim_lgn'];
                        }
                        $totaldll=$rAll['qty_claim_all']-$total1; ?>
                        </tbody>
                        <tfoot>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>DLL</strong></td>
                            <td align="right"><strong><?php echo number_format($totaldll,2); ?></strong></td>
                            <td align="right"><strong><?php if($TotalKirim!=""){echo number_format(($totaldll/(int)$TotalKirim)*100,2)." %";}else{echo "0 %";} ?></strong></td>
                            </tr>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>TOTAL KIRIM</td>
                            <td align="right"><strong><?php if($TotalKirim!=""){echo number_format($TotalKirim,2);}else{echo "0";} ?></strong></td>
                            <td align="right">&nbsp;</td>
                            </tr>
                        </tfoot>
                </table>
                <div class="box-footer">
                        <a href="pages/cetak/excel_5besar_langganan1.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&total=<?php echo $_POST['total']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xs-6">	
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 5 Masalah Terbesar KPE</h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                            <th width="5%"><div align="center">No</div></th>
                            <th width="25%"><div align="center">Defect</div></th>
                            <th width="14%"><div align="center">Qty Keluhan (KG)</div></th>
                            <th width="15%"><div align="center">% Dibandingkan Total Kirim</div></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no2=1;
                        $totald=0;
                        $totaldll2=0;
                        $qryAll2=mysqli_query($con,"SELECT COUNT(*) AS jml_all, SUM(qty_claim) AS qty_claim_all FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL)");
                        $rAll2=mysqli_fetch_array($qryAll2);
                        $qrydef=mysqli_query($con,"SELECT SUM(qty_claim) AS qty_claim_lgn, ROUND(COUNT(masalah_dominan)/(SELECT COUNT(*) FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
                        AND (masalah_dominan!='' OR masalah_dominan!=NULL))*100,1) AS persen,
                        masalah_dominan
                        FROM
                        `tbl_aftersales`
                        WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL)
                        GROUP BY masalah_dominan
                        ORDER BY qty_claim_lgn DESC LIMIT 5");
                        while($rd=mysqli_fetch_array($qrydef)){
                        //$qrycased=mysqli_query("SELECT SUM(qty_claim) AS qty_claim_lgn FROM tbl_aftersales WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' AND 
                        //masalah_dominan='$rd[masalah_dominan]'");
                        //$r2=mysqli_fetch_array($qrycased);
                        ?>
                        <tr valign="top">
                            <td align="center"><?php echo $no2; ?></td>
                            <td align="left"><?php echo $rd['masalah_dominan'];?></td>
                            <td align="right"><?php echo $rd['qty_claim_lgn'];?></td>
                            <td align="right"><?php echo number_format(($rd['qty_claim_lgn']/$TotalKirim)*100,2)." %";?></td>
                        </tr>
                        <?php	$no2++;  
                        $totald=$totald+$rd['qty_claim_lgn'];
                        } 
                        $totaldll2=$rAll2['qty_claim_all']-$totald; ?>
                        </tbody>
                        <tfoot>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>DLL</strong></td>
                            <td align="right"><strong><?php echo number_format($totaldll2,2); ?></strong></td>
                            <td align="right"><strong><?php if($TotalKirim!=""){echo number_format(($totaldll2/$TotalKirim)*100,2)." %";}else{echo "0 %";} ?></strong></td>
                            </tr>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>TOTAL KIRIM</strong></td>
                            <td align="right"><strong><?php if($TotalKirim!=""){echo number_format($TotalKirim,2);}else{echo "0";} ?></strong></td>
                            <td align="right">&nbsp;</td>
                            </tr>
                        </tfoot>
                </table>
                <div class="box-footer">
                        <a href="pages/cetak/excel_5besar_defect1.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&total=<?php echo $_POST['total']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
                </div>
            </div>
        </div>

    <!--Section 2 -->
    <div class="row">
        <div class="col-xs-6">	
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> 5 Langganan Terbesar KPE</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
            <table class="table table-bordered table-striped" style="width: 100%;">
                    <thead class="bg-blue">
                        <tr>
                        <th width="5%"><div align="center">No</div></th>
                        <th width="25%"><div align="center">Langganan</div></th>
                        <th width="10%"><div align="center">Jumlah Kasus</div></th>
                        <th width="15%"><div align="center">% Dibandingkan Total Kasus</div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no3=1;
                    $totalcase=0;
                    $totaldll3=0;
                    $qryAll=mysqli_query($con,"SELECT COUNT(*) AS jml_all, SUM(qty_claim) AS qty_claim_all FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'");
                    $rAll=mysqli_fetch_array($qryAll);
                    $qrylgn=mysqli_query($con,"SELECT COUNT(*) AS jml, ROUND(COUNT(langganan)/(SELECT COUNT(*) FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir')*100,1) AS persen,
                    langganan
                    FROM
                    `tbl_aftersales`
                    WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                    GROUP BY langganan
                    ORDER BY jml DESC LIMIT 5");
                    while($r=mysqli_fetch_array($qrylgn)){
                    //$qrycase=mysqli_query("SELECT SUM(qty_claim) AS qty_claim_lgn FROM tbl_aftersales WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' AND 
                    //langganan='$r[langganan]'");
                    //$r1=mysqli_fetch_array($qrycase);
                    ?>
                    <tr valign="top">
                        <td align="center"><?php echo $no3; ?></td>
                        <td align="left"><?php echo $r['langganan'];?></td>
                        <td align="right"><?php echo $r['jml']; ?></td>
                        <td align="right"><?php if($TotalLot!=""){echo number_format(($r['jml']/$TotalLot)*100,2)." %";}else{echo "0 %";}?></td>
                    </tr>
                    <?php	$no3++;  
                    $totalcase=$totalcase+$r['jml'];
                    } 
                    $totaldll3=$rAll['jml_all']-$totalcase;?>
                    </tbody>
                    <tfoot>
                        <tr valign="top">
                        <td align="center" colspan="2"><strong>DLL</strong></td>
                        <td align="right"><strong><?php echo $totaldll3; ?></strong></td>
                        <td align="right"><strong><?php if($TotalLot!=""){echo number_format(($totaldll3/$TotalLot)*100,2)." %";}else{echo "0 %";} ?></strong></td>
                        </tr>
                        <tr valign="top">
                        <td align="center" colspan="2"><strong>TOTAL LOT KIRIM</td>
                        <td align="right"><strong><?php if($TotalLot!=""){echo $TotalLot;}else{echo "0";} ?></strong></td>
                        <td align="right">&nbsp;</strong></td>
                        </tr>
                    </tfoot>
            </table>
            <div class="box-footer">
                    <a href="pages/cetak/excel_5besar_langganan.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&totallot=<?php echo $_POST['totallot']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xs-6">	
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> 5 Masalah Terbesar KPE</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
            <table class="table table-bordered table-striped" style="width: 100%;">
                    <thead class="bg-blue">
                        <tr>
                        <th width="5%"><div align="center">No</div></th>
                        <th width="25%"><div align="center">Defect</div></th>
                        <th width="10%"><div align="center">Jumlah Kasus</div></th>
                        <th width="15%"><div align="center">% Dibandingkan Total Kasus</div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no4=1;
                    $totalcased=0;
                    $totaldll4=0;
                    $qryAll1=mysqli_query($con,"SELECT COUNT(*) AS jml_all FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL)");
                    $rAll1=mysqli_fetch_array($qryAll1);
                    $qrydef=mysqli_query($con,"SELECT COUNT(*) AS jml, ROUND(COUNT(masalah_dominan)/(SELECT COUNT(*) FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
                    AND (masalah_dominan!='' OR masalah_dominan!=NULL))*100,1) AS persen,
                    masalah_dominan
                    FROM
                    `tbl_aftersales`
                    WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL)
                    GROUP BY masalah_dominan
                    ORDER BY jml DESC LIMIT 5");
                    while($rd=mysqli_fetch_array($qrydef)){
                    //$qrycased=mysqli_query("SELECT SUM(qty_claim) AS qty_claim_lgn FROM tbl_aftersales WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' AND 
                    //masalah_dominan='$rd[masalah_dominan]'");
                    //$r2=mysqli_fetch_array($qrycased);
                    ?>
                    <tr valign="top">
                        <td align="center"><?php echo $no4; ?></td>
                        <td align="left"><?php echo $rd['masalah_dominan'];?></td>
                        <td align="right"><?php echo $rd['jml']; ?></td>
                        <td align="right"><?php if($TotalLot!=""){echo number_format(($rd['jml']/$TotalLot)*100,2)." %";}else{echo "0 %";}?></td>
                    </tr>
                    <?php	$no4++;  
                    $totalcased=$totalcased+$rd['jml'];
                    } 
                    $totaldll4=$rAll1['jml_all']-$totalcased;?>
                    </tbody>
                    <tfoot>
                        <tr valign="top">
                        <td align="center" colspan="2"><strong>DLL</strong></td>
                        <td align="right"><strong><?php echo $totaldll4; ?></strong></td>
                        <td align="right"><strong><?php if($TotalLot!=""){echo number_format(($totaldll4/$TotalLot)*100,2)." %";}else{echo "0 %";} ?></strong></td>
                        </tr>
                        <tr valign="top">
                        <td align="center" colspan="2"><strong>TOTAL LOT KIRIM</td>
                        <td align="right"><strong><?php if($TotalLot!=""){echo $TotalLot;}else{echo "0";} ?></strong></td>
                        <td align="right">&nbsp;</strong></td>
                        </tr>
                    </tfoot>
            </table>
            <div class="box-footer">
                    <a href="pages/cetak/excel_5besar_defect.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&totallot=<?php echo $_POST['totallot']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- Section 3 -->
    <div class="row">
        <div class="col-xs-6">	
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 5 Masalah Terbesar Lululemon</h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                            <th width="5%"><div align="center">No</div></th>
                            <th width="25%"><div align="center">Defect</div></th>
                            <th width="14%"><div align="center">Qty Keluhan (KG)</div></th>
                            <th width="15%"><div align="center">% Dibandingkan Total Kirim</div></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no5=1;
                        $totald5=0;
                        $totaldll5=0;
                        $qryAll5=mysqli_query($con,"SELECT COUNT(*) AS jml_all, SUM(qty_claim) AS qty_claim_all FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL) AND langganan LIKE '%lululemon%'");
                        $rAll5=mysqli_fetch_array($qryAll5);
                        $qrydef5=mysqli_query($con,"SELECT SUM(qty_claim) AS qty_claim_lgn, ROUND(COUNT(masalah_dominan)/(SELECT COUNT(*) FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
                        AND (masalah_dominan!='' OR masalah_dominan!=NULL) AND langganan LIKE '%lululemon%')*100,1) AS persen,
                        masalah_dominan
                        FROM
                        `tbl_aftersales`
                        WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL) AND langganan LIKE '%lululemon%'
                        GROUP BY masalah_dominan
                        ORDER BY qty_claim_lgn DESC LIMIT 5");
                        while($rd5=mysqli_fetch_array($qrydef5)){
                        ?>
                        <tr valign="top">
                            <td align="center"><?php echo $no5; ?></td>
                            <td align="left"><?php echo $rd5['masalah_dominan'];?></td>
                            <td align="right"><?php echo $rd5['qty_claim_lgn'];?></td>
                            <td align="right"><?php if($TotalKirim!=""){echo number_format(($rd5['qty_claim_lgn']/$TotalKirim)*100,2)." %";}else{echo "0 %";}?></td>
                        </tr>
                        <?php	$no5++;  
                        $totald5=$totald5+$rd5['qty_claim_lgn'];
                        } 
                        $totaldll5=$rAll5['qty_claim_all']-$totald5; ?>
                        </tbody>
                        <tfoot>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>DLL</strong></td>
                            <td align="right"><strong><?php echo number_format($totaldll5,2); ?></strong></td>
                            <td align="right"><strong><?php if($TotalKirim!=""){echo number_format(($totaldll5/$TotalKirim)*100,2)." %";}else{echo "0 %";} ?></strong></td>
                            </tr>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>TOTAL KIRIM</strong></td>
                            <td align="right"><strong><?php if($TotalKirim!=""){echo number_format($TotalKirim,2);}else{echo "0";} ?></strong></td>
                            <td align="right">&nbsp;</td>
                            </tr>
                        </tfoot>
                </table>
                <div class="box-footer">
                        <a href="pages/cetak/excel_5besar_defectlululemon.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&total=<?php echo $_POST['total']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">	
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 5 Dept Terbesar KPE</h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                            <th width="5%"><div align="center">No</div></th>
                            <th width="25%"><div align="center">Dept</div></th>
                            <th width="14%"><div align="center">Qty Keluhan (KG)</div></th>
                            <th width="15%"><div align="center">% Dibandingkan Total Kirim</div></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no6=1;
                        $totald6=0;
                        $totaldll6=0;
                        $qryAll6=mysqli_query($con,"SELECT COUNT(*) AS jml_all, SUM(qty_claim) AS qty_claim_all FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (t_jawab!='' OR t_jawab!=NULL)");
                        $rAll6=mysqli_fetch_array($qryAll6);
                        $qrydef6=mysqli_query($con,"SELECT SUM(qty_claim) AS qty_claim_dept, ROUND(COUNT(t_jawab)/(SELECT COUNT(*) FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
                        AND (t_jawab!='' OR t_jawab!=NULL))*100,1) AS persen,
                        t_jawab
                        FROM
                        `tbl_aftersales`
                        WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (t_jawab!='' OR t_jawab!=NULL)
                        GROUP BY t_jawab
                        ORDER BY qty_claim_dept DESC LIMIT 5");
                        while($rd6=mysqli_fetch_array($qrydef6)){
                        ?>
                        <tr valign="top">
                            <td align="center"><?php echo $no6; ?></td>
                            <td align="left"><?php echo $rd6['t_jawab'];?></td>
                            <td align="right"><?php echo $rd6['qty_claim_dept'];?></td>
                            <td align="right"><?php if($TotalKirim!=""){echo number_format(($rd6['qty_claim_dept']/$TotalKirim)*100,2)." %";}else{echo "0 %";}?></td>
                        </tr>
                        <?php	$no6++;  
                        $totald6=$totald6+$rd6['qty_claim_dept'];
                        } 
                        $totaldll6=$rAll6['qty_claim_all']-$totald6; ?>
                        </tbody>
                        <tfoot>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>DLL</strong></td>
                            <td align="right"><strong><?php echo number_format($totaldll6,2); ?></strong></td>
                            <td align="right"><strong><?php if($TotalKirim!=""){echo number_format(($totaldll6/$TotalKirim)*100,2)." %";}else{echo "0 %";} ?></strong></td>
                            </tr>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>TOTAL KIRIM</strong></td>
                            <td align="right"><strong><?php if($TotalKirim!=""){echo number_format($TotalKirim,2);}else{echo "0";} ?></strong></td>
                            <td align="right">&nbsp;</td>
                            </tr>
                        </tfoot>
                </table>
                <div class="box-footer">
                        <a href="pages/cetak/excel_5besar_deptpenyebab.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&total=<?php echo $_POST['total']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">	
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 3 Terbesar Masalah Per Item : <?php echo $tglAw." s/d ".$tglAk;?></h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                            <th width="15%"><div align="center">Item/Hanger</div></th>
                            <th width="20%"><div align="center">Masalah</div></th>
                            <th width="14%"><div align="center">KG</div></th>
                            <th width="14%"><div align="center">Total Kirim Per Item</div></th>
                            <th width="15%"><div align="center">% Dibandingkan Total Kirim</div></th>
                            <th width="15%"><div align="center">% Masalah Per Item</div></th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                        <!-- <tfoot>
                            <tr valign="top">
                                <td align="center" colspan="2"><strong>TOTAL KIRIM</strong></td>
                                <td align="right" colspan="4"><strong><?php if($tkirim!=""){echo number_format($tkirim,2);}else{echo "0";} ?></strong></td>
                            </tr>
                        </tfoot> -->
                </table>
                <div class="box-footer">
                        <a href="pages/cetak/excel_3besar_masalah_item.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&langganan=<?php echo $_POST['langganan']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
if($TotalLot!=""){ 
    //Grafik Langganan Dibandingkan Total Kasus
    $qry3=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.nama,'''') buyer, GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_langganan_aftersales a
INNER JOIN(SELECT ROUND((COUNT(langganan)/$TotalLot)*100,2) AS jml, langganan 
FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' GROUP BY langganan ORDER BY jml DESC LIMIT 5) b ON a.nama=b.langganan");
    $r3=mysqli_fetch_array($qry3);
    //Grafik Defect Dibandingkan Total Kasus 
    $qry1=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.masalah,'''') defect ,GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_masalah_aftersales a
INNER JOIN(SELECT ROUND((COUNT(masalah_dominan)/$TotalLot)*100,2) AS jml,masalah_dominan FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
AND (masalah_dominan!='' OR masalah_dominan!=NULL) GROUP BY masalah_dominan ORDER BY jml DESC LIMIT 5) b ON a.masalah=b.masalah_dominan");
    $r1=mysqli_fetch_array($qry1);
}
if($TotalKirim!=""){
    //Grafik Langganan Dibandingkan Total Kirim 
    $qry4=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.nama,'''') buyer, GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_langganan_aftersales a
INNER JOIN(SELECT ROUND((SUM(qty_claim)/$TotalKirim)*100,2) AS jml, langganan 
FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' GROUP BY langganan ORDER BY jml DESC LIMIT 5) b ON a.nama=b.langganan");
    $r4=mysqli_fetch_array($qry4);
    //Grafik Defect Dibandingkan Total Kirim  
    $qry5=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.masalah,'''') defect ,GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_masalah_aftersales a
INNER JOIN(SELECT ROUND((SUM(qty_claim)/$TotalKirim)*100,2) AS jml,masalah_dominan FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
AND (masalah_dominan!='' OR masalah_dominan!=NULL) GROUP BY masalah_dominan ORDER BY jml DESC LIMIT 5) b ON a.masalah=b.masalah_dominan");
    $r5=mysqli_fetch_array($qry5);
    //Grafik Defect Lululemon Dibandingkan Total Kirim  
    $qry6=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.masalah,'''') defect ,GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_masalah_aftersales a
INNER JOIN(SELECT ROUND((SUM(qty_claim)/$TotalKirim)*100,2) AS jml,masalah_dominan FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
AND (masalah_dominan!='' OR masalah_dominan!=NULL) AND langganan LIKE '%lululemon%' GROUP BY masalah_dominan ORDER BY jml DESC LIMIT 5) b ON a.masalah=b.masalah_dominan");
    $r6=mysqli_fetch_array($qry6);
    //Grafik Dept Dibandingkan Total Kirim  
    $qry7=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.nama,'''') dept ,GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_dept a
INNER JOIN(SELECT ROUND((SUM(qty_claim)/$TotalKirim)*100,2) AS jml,t_jawab FROM tbl_aftersales WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
AND (t_jawab!='' OR t_jawab!=NULL) GROUP BY t_jawab ORDER BY jml DESC LIMIT 5) b ON a.nama=b.t_jawab");
    $r7=mysqli_fetch_array($qry7);
}

	if($Awal!="" and $Akhir!=""){  
	$tglAwal=date('d F Y', strtotime($Awal));
	$tglAkhir=date('d F Y', strtotime($Akhir));
	}else{
	$tglAwal=" - ";
	$tglAkhir=" - ";	
	}
	?>	   
            <!-- BAR CHART -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Langganan Dibandingkan Total Kirim</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- /.box-body -->
            </div>
          <!-- BAR CHART -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Masalah Dominan Dibandingkan Total Kirim</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- /.box-body -->
            </div> 
    	  <!-- BAR CHART -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Langganan Dibandingkan Total Kasus</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- /.box-body -->
            </div>
          <!-- BAR CHART -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Masalah Dominan Dibandingkan Total Kasus</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- BAR CHART -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Masalah Lululemon Dibandingkan Total Kirim</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div id="container4" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- BAR CHART -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Dept Penyebab Dibandingkan Total Kirim</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div id="container5" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- /.box-body -->
            </div>

    </div>
    </div>
  </body>

</html>
<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column',        
    },
    title: {
        text: 'Langganan'
    },
    subtitle: {
        text: '<?php echo $tglAwal." s/d ".$tglAkhir;?>'
    },
    plotOptions: {
        column: {
            depth: 25,
			color: 'brown',
        }
    },
    xAxis: {
		categories: [<?php echo $r3['buyer'];?>],
        labels: {
            skew3d: true,
            style: {
                fontSize: '10px',
            }
        }
    },
    yAxis: {
        title: {
            text: 'Persentase'
        }
    },
    series: [{
        name: 'Langganan',
        data: [<?php echo $r3['jml']; ?>],
		dataLabels: {
                enabled: true,
                format: '{point.y:.2f}%',
				style: {
                fontSize: '10px',
                fontFamily: 'Arial, sans-serif'
            }
            }
    }]
});

Highcharts.chart('container1', {
    chart: {
        type: 'column',        
    },
    title: {
        text: 'Masalah Dominan'
    },
    subtitle: {
        text: '<?php echo $tglAwal." s/d ".$tglAkhir;?>'
    },
    plotOptions: {
        column: {
            depth: 25,
			color: 'green',
        }
    },
    xAxis: {
		categories: [<?php echo $r1['defect'];?>],
        labels: {
            skew3d: true,
            style: {
                fontSize: '10px',
            }
        }
    },
    yAxis: {
        title: {
            text: 'Persentase'
        }
    },
    series: [{
        name: 'Masalah Dominan',
        data: [<?php echo $r1['jml']; ?>],
		dataLabels: {
                enabled: true,
                format: '{point.y:.2f}%',
				style: {
                fontSize: '10px',
                fontFamily: 'Arial, sans-serif'
            }
            }
    }]
});

Highcharts.chart('container2', {
    chart: {
        type: 'column',        
    },
    title: {
        text: 'Langganan'
    },
    subtitle: {
        text: '<?php echo $tglAwal." s/d ".$tglAkhir;?>'
    },
    plotOptions: {
        column: {
            depth: 25,
			color: 'brown',
        }
    },
    xAxis: {
		categories: [<?php echo $r4['buyer'];?>],
        labels: {
            skew3d: true,
            style: {
                fontSize: '10px',
            }
        }
    },
    yAxis: {
        title: {
            text: 'Persentase'
        }
    },
    series: [{
        name: 'Langganan',
        data: [<?php echo $r4['jml']; ?>],
		dataLabels: {
                enabled: true,
                format: '{point.y:.2f}%',
				style: {
                fontSize: '10px',
                fontFamily: 'Arial, sans-serif'
            }
            }
    }]
});

Highcharts.chart('container3', {
    chart: {
        type: 'column',        
    },
    title: {
        text: 'Masalah Dominan'
    },
    subtitle: {
        text: '<?php echo $tglAwal." s/d ".$tglAkhir;?>'
    },
    plotOptions: {
        column: {
            depth: 25,
			color: 'green',
        }
    },
    xAxis: {
		categories: [<?php echo $r5['defect'];?>],
        labels: {
            skew3d: true,
            style: {
                fontSize: '10px',
            }
        }
    },
    yAxis: {
        title: {
            text: 'Persentase'
        }
    },
    series: [{
        name: 'Masalah Dominan',
        data: [<?php echo $r5['jml']; ?>],
		dataLabels: {
                enabled: true,
                format: '{point.y:.2f}%',
				style: {
                fontSize: '10px',
                fontFamily: 'Arial, sans-serif'
            }
            }
    }]
});

Highcharts.chart('container4', {
    chart: {
        type: 'column',        
    },
    title: {
        text: 'Masalah Dominan'
    },
    subtitle: {
        text: '<?php echo $tglAwal." s/d ".$tglAkhir;?>'
    },
    plotOptions: {
        column: {
            depth: 25,
			color: 'blue',
        }
    },
    xAxis: {
		categories: [<?php echo $r6['defect'];?>],
        labels: {
            skew3d: true,
            style: {
                fontSize: '10px',
            }
        }
    },
    yAxis: {
        title: {
            text: 'Persentase'
        }
    },
    series: [{
        name: 'Masalah Dominan',
        data: [<?php echo $r6['jml']; ?>],
		dataLabels: {
                enabled: true,
                format: '{point.y:.2f}%',
				style: {
                fontSize: '10px',
                fontFamily: 'Arial, sans-serif'
            }
            }
    }]
});
Highcharts.chart('container5', {
    chart: {
        type: 'column',        
    },
    title: {
        text: 'Dept'
    },
    subtitle: {
        text: '<?php echo $tglAwal." s/d ".$tglAkhir;?>'
    },
    plotOptions: {
        column: {
            depth: 25,
			color: 'blue',
        }
    },
    xAxis: {
		categories: [<?php echo $r7['dept'];?>],
        labels: {
            skew3d: true,
            style: {
                fontSize: '10px',
            }
        }
    },
    yAxis: {
        title: {
            text: 'Persentase'
        }
    },
    series: [{
        name: 'Dept',
        data: [<?php echo $r7['jml']; ?>],
		dataLabels: {
                enabled: true,
                format: '{point.y:.2f}%',
				style: {
                fontSize: '10px',
                fontFamily: 'Arial, sans-serif'
            }
            }
    }]
});
		</script>