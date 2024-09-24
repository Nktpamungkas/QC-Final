<?php
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";

?>
<?php
$Awal		= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir		= isset($_POST['akhir']) ? $_POST['akhir'] : '';
//$TotalKirim		= isset($_POST['total']) ? $_POST['total'] : '';
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
                    <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" />
                </div>
                </div>
                <div class="col-sm-2">
                <div class="input-group date">
                    <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                    <input name="akhir" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Akhir" value="<?php echo $Akhir; ?>" />
                </div>
                </div>
                <!--<div class="col-sm-2">
                <div class="input-group date">
                    <div class="input-group-addon"> Total Kirim</div>
                    <input name="total" type="text" class="form-control pull-right" placeholder="0" value="<?php echo $TotalKirim; ?>" />
                </div>
                </div>-->
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
                    <h3 class="box-title"> TOTAL KPE PERIODE : <?php if($Awal!=""){ echo date("F", strtotime($Awal));}?> - <?php if($Akhir!=""){ echo date("F Y", strtotime($Akhir));}?></h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                            <th width="5%"><div align="center">No</div></th>
                            <th width="25%"><div align="center">Masalah</div></th>
                            <th width="10%"><div align="center">Qty </div></th>
                            <th width="15%"><div align="center">%</div></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no1=1;
                        $total=0;
                        $totaldll=0;
                        $qryAll=mysqli_query($con,"SELECT SUM(qty) AS qty_all FROM tbl_tpukpe WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL)");
                        $rAll=mysqli_fetch_array($qryAll);
                        $qrydef=mysqli_query($con,"SELECT SUM(qty) AS qty_lgn, ROUND(COUNT(masalah_dominan)/(SELECT COUNT(*) FROM tbl_tpukpe WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' 
                        AND (masalah_dominan!='' OR masalah_dominan!=NULL))*100,1) AS persen,
                        masalah_dominan
                        FROM
                        `tbl_tpukpe`
                        WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL)
                        GROUP BY masalah_dominan
                        ORDER BY qty_lgn DESC LIMIT 5");
                        while($r=mysqli_fetch_array($qrydef)){
                        ?>
                        <tr valign="top">
                            <td align="center"><?php echo $no1; ?></td>
                            <td align="left"><?php echo $r['masalah_dominan'];?></td>
                            <td align="right"><?php echo $r['qty_lgn'];?></td>
                            <td align="right"><?php echo number_format(($r['qty_lgn']/$rAll['qty_all'])*100,2)." %";?></td>
                        </tr>
                        <?php	$no1++;
                        $total=$total+$r['qty_lgn'];  
                        }
                        $totaldll=$rAll['qty_all']-$total; ?>
                        </tbody>
                        <tfoot>
                            <tr valign="top">
                            <td align="center" colspan="2">LAIN LAIN</td>
                            <td align="right"><?php echo number_format($totaldll,2); ?></td>
                            <td align="right"><?php if($rAll['qty_all']!=""){echo number_format(($totaldll/$rAll['qty_all'])*100,2)." %";}else{echo "0.00 %";} ?></td>
                            </tr>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>TOTAL</td>
                            <td align="right"><strong><?php echo number_format($rAll['qty_all'],2); ?></strong></td>
                            <td align="right"><?php if($rAll['qty_all']!=""){echo number_format(($rAll['qty_all']/$rAll['qty_all'])*100,2)." %";}else{echo "0.00 %";}?></td>
                            </tr>
                        </tfoot>
                </table>
                    <div class="box-footer">
                        <a href="pages/cetak/excel_5besar_def_tpukpe.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xs-6">	
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> TOTAL KPE PERIODE : <?php if($Awal!=""){ echo date("F", strtotime($Awal));}?> - <?php if($Akhir!=""){ echo date("F Y", strtotime($Akhir));}?></h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                            <th width="5%"><div align="center">No</div></th>
                            <th width="25%"><div align="center">Masalah</div></th>
                            <th width="14%"><div align="center">Total Kasus</div></th>
                            <th width="15%"><div align="center">% Kasus</div></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no2=1;
                        $total1=0;
                        $totaldll1=0;
                        $qryAll2=mysqli_query($con,"SELECT COUNT(*) AS jml_all FROM tbl_tpukpe WHERE DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL)");
                        $rAll2=mysqli_fetch_array($qryAll2);
                        $qrydef1=mysqli_query($con,"SELECT COUNT(*) AS jml, ROUND(COUNT(masalah_dominan)/(SELECT COUNT(*) FROM tbl_tpukpe WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' 
                        AND (masalah_dominan!='' OR masalah_dominan!=NULL))*100,1) AS persen,
                        masalah_dominan
                        FROM
                        `tbl_tpukpe`
                        WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL)
                        GROUP BY masalah_dominan
                        ORDER BY jml DESC, masalah_dominan ASC LIMIT 5");
                        while($rd=mysqli_fetch_array($qrydef1)){
                        ?>
                        <tr valign="top">
                            <td align="center"><?php echo $no2; ?></td>
                            <td align="left"><?php echo $rd['masalah_dominan'];?></td>
                            <td align="right"><?php echo $rd['jml'];?></td>
                            <td align="right"><?php echo number_format(($rd['jml']/$rAll2['jml_all'])*100,2)." %";?></td>
                        </tr>
                        <?php	$no2++;  
                        $total1=$total1+$rd['jml'];  
                        }
                        $totaldll1=$rAll2['jml_all']-$total1; ?>
                        </tbody>
                        <tfoot>
                            <tr valign="top">
                            <td align="center" colspan="2">LAIN LAIN</td>
                            <td align="right"><?php echo $totaldll1; ?></td>
                            <td align="right"><?php if($rAll2['jml_all']!=0){echo number_format(($totaldll1/$rAll2['jml_all'])*100,2)." %";}else{echo "0.00 %";} ?></td>
                            </tr>
                            <tr valign="top">
                            <td align="center" colspan="2"><strong>TOTAL</strong></td>
                            <td align="right"><strong><?php echo $rAll2['jml_all']; ?></strong></td>
                            <td align="right"><?php if($rAll2['jml_all']!=0){echo number_format(($rAll2['jml_all']/$rAll2['jml_all'])*100,2)." %";}else{echo "0.00 %";}?></td>
                            </tr>
                        </tfoot>
                </table>
                <div class="box-footer">
                        <a href="pages/cetak/excel_5besar_def_tpukpe1.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
                </div>
            </div>
        </div>

<?php 
    //Grafik Defect Dibandingkan Total Qty
    $qry3=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.masalah,'''') defect, GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_masalah_aftersales a
INNER JOIN(SELECT ROUND(SUM(qty)/(SELECT SUM(qty) FROM tbl_tpukpe WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL))*100,2) AS jml, masalah_dominan 
FROM tbl_tpukpe WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL) GROUP BY masalah_dominan ORDER BY jml DESC LIMIT 5) b ON a.masalah=b.masalah_dominan");
    $r3=mysqli_fetch_array($qry3);
    $qry2=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.masalah,'''') defect, GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_masalah_aftersales a
INNER JOIN(SELECT ROUND(SUM(qty),2) AS jml, masalah_dominan 
FROM tbl_tpukpe WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' AND (masalah_dominan!='' OR masalah_dominan!=NULL) GROUP BY masalah_dominan ORDER BY jml DESC LIMIT 5) b ON a.masalah=b.masalah_dominan");
    $r2=mysqli_fetch_array($qry2);
    //Grafik Defect Dibandingkan Total Kasus 
    $qry1=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.masalah,'''') defect ,GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_masalah_aftersales a
INNER JOIN(SELECT ROUND(COUNT(masalah_dominan)/(SELECT COUNT(*) FROM tbl_tpukpe WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' 
AND (masalah_dominan!='' OR masalah_dominan!=NULL))*100,2) AS jml,masalah_dominan FROM tbl_tpukpe WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' 
AND (masalah_dominan!='' OR masalah_dominan!=NULL) GROUP BY masalah_dominan ORDER BY jml DESC, masalah_dominan ASC LIMIT 5) b ON a.masalah=b.masalah_dominan");
    $r1=mysqli_fetch_array($qry1);
    $qry4=mysqli_query($con,"SELECT GROUP_CONCAT('''',a.masalah,'''') defect ,GROUP_CONCAT(IFNULL(b.jml,0)) as jml FROM tbl_masalah_aftersales a
INNER JOIN(SELECT ROUND(COUNT(masalah_dominan),2) AS jml,masalah_dominan FROM tbl_tpukpe WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir' 
AND (masalah_dominan!='' OR masalah_dominan!=NULL) GROUP BY masalah_dominan ORDER BY jml DESC, masalah_dominan ASC LIMIT 5) b ON a.masalah=b.masalah_dominan");
    $r4=mysqli_fetch_array($qry4);

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
                    <h3 class="box-title">Diagram KPE (Keluhan Pelanggan Eksternal) Periode : <?php if($Awal!=""){ echo date("F", strtotime($Awal));}?> - <?php if($Akhir!=""){ echo date("F Y", strtotime($Akhir));}?></h3>

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
                    <h3 class="box-title">Diagram KPE (Keluhan Pelanggan Eksternal) Periode : <?php if($Awal!=""){ echo date("F", strtotime($Awal));}?> - <?php if($Akhir!=""){ echo date("F Y", strtotime($Akhir));}?></h3>

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
        text: 'Jenis Masalah'
    },
    subtitle: {
        text: '<?php echo $tglAwal." s/d ".$tglAkhir;?>'
    },
    plotOptions: {
        column: {
            depth: 25,
			color: 'orange',
        }
    },
    xAxis: {
		categories: [<?php echo $r2['defect'];?>],
        labels: {
            skew3d: true,
            style: {
                fontSize: '10px',
            }
        }
    },
    yAxis: {
        title: {
            text: 'Quantity'
        }
    },
    series: [{
        name: 'Jenis Masalah',
        data: [<?php echo $r2['jml']; ?>],
		dataLabels: {
                enabled: true,
                format: '{point.y:.2f}',
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
        text: 'Jenis Masalah'
    },
    subtitle: {
        text: '<?php echo $tglAwal." s/d ".$tglAkhir;?>'
    },
    plotOptions: {
        column: {
            depth: 25,
			color: 'navy',
        }
    },
    xAxis: {
		categories: [<?php echo $r4['defect'];?>],
        labels: {
            skew3d: true,
            style: {
                fontSize: '10px',
            }
        }
    },
    yAxis: {
        title: {
            text: 'Total Kasus'
        }
    },
    series: [{
        name: 'Jenis Masalah',
        data: [<?php echo $r4['jml']; ?>],
		dataLabels: {
                enabled: true,
                format: '{point.y:1f}',
				style: {
                fontSize: '10px',
                fontFamily: 'Arial, sans-serif'
            }
            }
    }]
});
</script>