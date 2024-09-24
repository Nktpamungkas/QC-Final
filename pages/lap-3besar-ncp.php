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
            <h3 class="box-title">Filter Data</h3>
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
                <!-- <div class="col-sm-2">
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
                </div> -->
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
    <!-- Section 3 -->
    <div class="row">
        <div class="col-xs-6">	
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 3 Terbesar Masalah Per Item NCP : <?php echo $tglAw." s/d ".$tglAk;?></h3>
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
                                <th width="20%"><div align="center">Buyer</div></th>
                                <th width="14%"><div align="center">KG</div></th>
                                <th width="14%"><div align="center">Total Produksi Dyeing Per Item</div></th>
                                <th width="15%"><div align="center">% Dibandingkan Total Produksi Dyeing Per Item</div></th>
                                <th width="15%"><div align="center">% Masalah Per Item</div></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $tpro=0;
                        $qry7=mysqli_query($con,"SELECT no_item, no_hanger, buyer, SUM(berat) AS qty_kg FROM tbl_ncp_qcf WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                        GROUP BY no_item
                        ORDER BY qty_kg DESC
                        LIMIT 3");
                        while($ri7=mysqli_fetch_array($qry7)){
                            $qryd7=mysqli_query($con,"SELECT masalah_dominan, SUM(berat) AS qty_kg FROM tbl_ncp_qcf WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
                            AND no_item='$ri7[no_item]' 
                            GROUP BY masalah_dominan
                            ORDER BY qty_kg DESC
                            LIMIT 3");
                            $qrypro=mysqli_query($condye,"SELECT SUM(a.bruto) AS qty_produksi FROM tbl_montemp a LEFT JOIN tbl_schedule b ON a.id_schedule = b.id
                            WHERE DATE_FORMAT(a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND b.no_item='$ri7[no_item]' AND b.status='selesai'");
                            $rpro=mysqli_fetch_array($qrypro);
                            $qrytitem=mysqli_query($con,"SELECT SUM(a.qty_kg) AS total_kg FROM
                            (SELECT SUM(berat) AS qty_kg FROM tbl_ncp_qcf WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                            AND no_item='$ri7[no_item]' 
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
                        $tpro=$tpro+$rpro['qty_produksi'];}
                        } 
                        ?>
                        </tbody>
                        <!-- <tfoot>
                            <tr valign="top">
                                <td align="center" colspan="2"><strong>TOTAL PRODUKSI DYEING</strong></td>
                                <td align="right" colspan="4"><strong><?php if($tpro!=""){echo number_format($tpro,2);}else{echo "0";} ?></strong></td>
                            </tr>
                        </tfoot> -->
                </table>
                <div class="box-footer">
                        <a href="pages/cetak/excel_3besar_masalah_ncp_item.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">	
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 3 Terbesar Item NCP : <?php echo $tglAw." s/d ".$tglAk;?></h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                                <th width="15%"><div align="center">Item/Hanger</div></th>
                                <th width="14%"><div align="center">Buyer</div></th>
                                <th width="14%"><div align="center">KG</div></th>
                                <th width="15%"><div align="center">% Dibandingkan Total Produksi Dyeing</div></th>
                                <th width="15%"><div align="center">% Dibandingkan Total NCP</div></th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                        <tfoot>
                            <tr valign="top">
                                <td align="center" ><strong>TOTAL PRODUKSI DYEING</strong></td>
                                <td align="right" colspan="4"><strong><?php if($rpro1['qty_produksi']!=""){echo number_format($rpro1['qty_produksi'],2);}else{echo "0";} ?></strong></td>
                            </tr>
                            <tr valign="top">
                                <td align="center"><strong>TOTAL NCP</strong></td>
                                <td align="right" colspan="4"><strong><?php if($rtall['qty_kg_all']!=""){echo number_format($rtall['qty_kg_all'],2);}else{echo "0";} ?></strong></td>
                            </tr>
                        </tfoot>
                </table>
                <div class="box-footer">
                        <a href="pages/cetak/excel_3besar_ncp_item.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
  </body>

</html>