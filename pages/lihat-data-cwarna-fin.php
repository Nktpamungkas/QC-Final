<?PHP
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Harian QCF</title>
</head>
<body>
<?php
$Awal	= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	= isset($_POST['akhir']) ? $_POST['akhir'] : '';
$GShift	= isset($_POST['gshift']) ? $_POST['gshift'] : '';
$Awal1	= isset($_GET['awal']) ? $_GET['awal'] : '';
$Akhir1	= isset($_GET['akhir']) ? $_GET['akhir'] : '';
$GShift1	= isset($_GET['shift']) ? $_GET['shift'] : '';
$Order	= isset($_POST['no_order']) ? $_POST['no_order'] : '';
$PO	= isset($_POST['po']) ? $_POST['po'] : '';		
?>
<div class="row">
  <div class="col-xs-2">	
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"> Filter Laporan Cocok Warna Finishing</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
        <div class="box-body">
          <div class="form-group">
            <div class="col-sm-10">
              <div class="input-group date">
                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                  <input name="awal" type="date" class="form-control pull-right" placeholder="Tanggal Awal" value="<?php if($Awal1!=""){echo $Awal1;}else{echo $Awal;} ?>" autocomplete="off"/>
              </div>
            </div>
              <!-- /.input group -->
          </div>
          <div class="form-group">
            <div class="col-sm-10">
              <div class="input-group date">
                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                <input name="akhir" type="date" class="form-control pull-right" placeholder="Tanggal Akhir" value="<?php if($Akhir1!=""){echo $Akhir1;}else{echo $Akhir;}  ?>" autocomplete="off"/>
              </div>
            </div>
            <!-- /.input group -->
          </div>
          <div class="form-group">
            <div class="col-sm-10">
              <input name="no_order" type="text" class="form-control pull-right" id="no_order" placeholder="No Order" value="<?php echo $Order;  ?>" autocomplete="off"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10">
              <input name="po" type="text" class="form-control pull-right" id="po" placeholder="No PO" value="<?php echo $PO;  ?>" autocomplete="off"/>
            </div>
          </div>
          <div class="form-group">
              <div class="col-sm-10">
                  <select name="gshift" class="form-control select2"> 
                    <option value="ALL" <?php if($GShift=="ALL" OR $GShift1=="ALL"){ echo "SELECTED";}?>>ALL</option>
                    <option value="A" <?php if($GShift=="A" OR $GShift1=="A"){ echo "SELECTED";}?>>A</option>
                    <option value="B" <?php if($GShift=="B" OR $GShift1=="B"){ echo "SELECTED";}?>>B</option>
                    <option value="C" <?php if($GShift=="C" OR $GShift1=="C"){ echo "SELECTED";}?>>C</option>
                  </select>
              </div>			 
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="col-sm-4">
            <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="save" >Search <i class="fa fa-search"></i></button>
          </div>
          <div class="pull-right">
            <input type="button" class="btn btn-block btn-social btn-linkedin btn-sm" <?php if($_SESSION['lvl_id']=="AFTERSALES"){echo "disabled";}?> name="lihat" value="Kembali" onClick="window.location.href='CWarnaFin'">	   
          </div>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </div>
  <div class="col-xs-5">	
      <?php 
      $sqlball=mysqli_query($con,"SELECT
      count(a.nokk) as jml_kk_all 
      from 
      db_qc.tbl_lap_inspeksi a
      where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
      AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'");
      $rball=mysqli_fetch_array($sqlball);
      ?>
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"> TOP 5 Berdasarkan Buyer</h3>
        <?php if($Awal!="") { ?><br><b>Periode: <?php echo tanggal_indo($Awal)." - ".tanggal_indo($Akhir); }?> </b>
        <?php if($rball['jml_kk_all']!="") { ?><br><b>Jumlah KK: <?php echo $rball['jml_kk_all']; }?> </b>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-striped" style="width: 100%;">
          <thead class="bg-blue">
            <tr>
              <th width="5%"><div align="center">No</div></th>
              <th width="15%"><div align="center">Buyer</div></th>
              <th width="5%"><div align="center">A</div></th>
              <th width="5%"><div align="center">B</div></th>
              <th width="5%"><div align="center">C</div></th>
              <th width="5%"><div align="center">D</div></th>
              <th width="5%"><div align="center">NULL</div></th>
              <th width="10%"><div align="center">%</div></th>
            </tr>
          </thead>
          <tbody>
          <?php 
          $no=1;
          $sqlby=mysqli_query($con,"SELECT 
          SUBSTRING_INDEX(a.pelanggan,'/',-1) as buyer,
          count(a.nokk) as jml_kk
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          group by 
          substring_index(a.pelanggan,'/',-1)
          order by jml_kk desc limit 5");
          while($rby=mysqli_fetch_array($sqlby)){
          //GROUP A
          $sqlga=mysqli_query($con,"SELECT
          a.`grouping`,
          count(a.nokk) as jml_kk_a
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and a.`grouping` = 'A' and SUBSTRING_INDEX(a.pelanggan,'/',-1) ='$rby[buyer]'");
          $rga=mysqli_fetch_array($sqlga);
          //GROUP B
          $sqlgb=mysqli_query($con,"SELECT
          a.`grouping`,
          count(a.nokk) as jml_kk_b
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and a.`grouping` = 'B' and SUBSTRING_INDEX(a.pelanggan,'/',-1) ='$rby[buyer]'");
          $rgb=mysqli_fetch_array($sqlgb);
          //GROUP C
          $sqlgc=mysqli_query($con,"SELECT
          a.`grouping`,
          count(a.nokk) as jml_kk_c
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and a.`grouping` = 'C' and SUBSTRING_INDEX(a.pelanggan,'/',-1) ='$rby[buyer]'");
          $rgc=mysqli_fetch_array($sqlgc);
          //GROUP D
          $sqlgd=mysqli_query($con,"SELECT
          a.`grouping`,
          count(a.nokk) as jml_kk_d
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and a.`grouping` = 'D' and SUBSTRING_INDEX(a.pelanggan,'/',-1) ='$rby[buyer]'");
          $rgd=mysqli_fetch_array($sqlgd);
          //NULL
          $sqlgn=mysqli_query($con,"SELECT
          a.`grouping`,
          count(a.nokk) as jml_kk_null
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and (a.`grouping` = '' or a.`grouping` is null ) and SUBSTRING_INDEX(a.pelanggan,'/',-1) ='$rby[buyer]'");
          $rgn=mysqli_fetch_array($sqlgn);
          ?>
          <tr valign="top">
            <td align="center"><?php echo $no;?></td>
            <td align="center"><?php echo $rby['buyer'];?></td>
            <td align="center"><?php echo $rga['jml_kk_a'];?></td>
            <td align="center"><?php echo $rgb['jml_kk_b'];?></td>
            <td align="center"><?php echo $rgc['jml_kk_c'];?></td>
            <td align="center"><?php echo $rgd['jml_kk_d'];?></td>
            <td align="center"><?php echo $rgn['jml_kk_null'];?></td>
            <td align="center"><?php echo number_format(($rby['jml_kk']/$rball['jml_kk_all'])*100,2)." %";?></td>
          </tr>
          <?php 
          $no++;}
          ?>
          </tbody>
        </table>
      </div>
      <div class="box-footer">
        <a href="pages/cetak/excel_top5_buyer_lapfin.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
      </div>
    </div>
  </div>
  <div class="col-xs-5">	
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"> TOP 5 Berdasarkan No Warna</h3>
        <?php if($Awal!="") { ?><br><b>Periode: <?php echo tanggal_indo($Awal)." - ".tanggal_indo($Akhir); }?> </b>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-striped" style="width: 100%;">
          <thead class="bg-blue">
            <tr>
              <th width="5%"><div align="center">No</div></th>
              <th width="10%"><div align="center">No Warna</div></th>
              <th width="10%"><div align="center">Warna</div></th>
              <th width="5%"><div align="center">A</div></th>
              <th width="5%"><div align="center">B</div></th>
              <th width="5%"><div align="center">C</div></th>
              <th width="5%"><div align="center">D</div></th>
              <th width="5%"><div align="center">NULL</div></th>
              <th width="5%"><div align="center">%</div></th>
            </tr>
          </thead>
          <tbody>
          <?php 
          $no=1;
          $sqlw=mysqli_query($con,"SELECT 
          no_warna,
          warna,
          count(a.nokk) as jml_kk
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          group by 
          no_warna,
          warna
          order by jml_kk desc limit 5");
          while($rw=mysqli_fetch_array($sqlw)){
          //GROUP A
          $sqlwa=mysqli_query($con,"SELECT
          no_warna,
          warna,
          count(a.nokk) as jml_kk_a
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and a.`grouping` = 'A' and a.no_warna ='$rw[no_warna]' and a.warna ='$rw[warna]'");
          $rwa=mysqli_fetch_array($sqlwa);
          //GROUP B
          $sqlwb=mysqli_query($con,"SELECT
          no_warna,
          warna,
          count(a.nokk) as jml_kk_b
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and a.`grouping` = 'B' and a.no_warna ='$rw[no_warna]' and a.warna ='$rw[warna]'");
          $rwb=mysqli_fetch_array($sqlwb);
          //GROUP C
          $sqlwc=mysqli_query($con,"SELECT
          no_warna,
          warna,
          count(a.nokk) as jml_kk_c
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and a.`grouping` = 'C' and a.no_warna ='$rw[no_warna]' and a.warna ='$rw[warna]'");
          $rwc=mysqli_fetch_array($sqlwc);
          //GROUP D
          $sqlwd=mysqli_query($con,"SELECT
          no_warna,
          warna,
          count(a.nokk) as jml_kk_d
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and a.`grouping` = 'D' and a.no_warna ='$rw[no_warna]' and a.warna ='$rw[warna]'");
          $rwd=mysqli_fetch_array($sqlwd);
          //NULL
          $sqlwn=mysqli_query($con,"SELECT
          no_warna,
          warna,
          count(a.nokk) as jml_kk_null
          from 
          db_qc.tbl_lap_inspeksi a
          where (a.proses !='Oven' or a.proses !='Fin 1X') and a.dept ='QCF'
          AND DATE_FORMAT( a.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' 
          and (a.`grouping` = '' or a.`grouping` is null ) and a.no_warna ='$rw[no_warna]' and a.warna ='$rw[warna]'");
          $rwn=mysqli_fetch_array($sqlwn);
          ?>
          <tr valign="top">
            <td align="center"><?php echo $no;?></td>
            <td align="center"><?php echo $rw['no_warna'];?></td>
            <td align="center"><?php echo $rw['warna'];?></td>
            <td align="center"><?php echo $rwa['jml_kk_a'];?></td>
            <td align="center"><?php echo $rwb['jml_kk_b'];?></td>
            <td align="center"><?php echo $rwc['jml_kk_c'];?></td>
            <td align="center"><?php echo $rwd['jml_kk_d'];?></td>
            <td align="center"><?php echo $rwn['jml_kk_null'];?></td>
            <td align="center"><?php echo number_format(($rw['jml_kk']/$rball['jml_kk_all'])*100,2)." %";?></td>
          </tr>
          <?php 
          $no++;}
          ?>
          </tbody>
        </table>
      </div>
      <div class="box-footer">
        <a href="pages/cetak/excel_top5_nowarna_lapfin.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
            <h3 class="box-title">Data Cocok Warna Finishing</h3><br>
            <?php if($_GET['awal']!="") { ?><b>Periode: <?php echo $_GET['awal']." to ".$_GET['akhir']; ?></b>
            <?php }else if($_POST['awal']!="") { ?><b>Periode: <?php echo $_POST['awal']." to ".$_POST['akhir']; ?></b>
            <?php } ?><br>
            <?php if($_GET['shift']!="") { ?><b>Shift: <?php echo $_GET['shift']; ?></b>
            <?php }else if($_POST['gshift']!="") { ?><b>Shift: <?php echo $_POST['gshift']; ?></b>
            <?php } ?>
            <div class="pull-right">
                <a href="pages/cetak/cetak-reports-cocok-warna.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shift=<?php echo $_POST['gshift']; ?>" class="btn btn-primary <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak</a> 
                <a href="pages/cetak/lap-cocok-warna-excel.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shift=<?php echo $_POST['gshift']; ?>" class="btn btn-primary <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Excel</a> 
            </div>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover table-striped nowrap" id="example1" style="width:100%">
          <thead class="bg-blue">
            <tr>
              <th><div align="center">No</div></th>
              <th><div align="center">Shift</div></th>
              <th><div align="center">Aksi</div></th>
              <th><div align="center">Tgl Fin</div></th>
              <th><div align="center">No Barcode</div></th>
              <th><div align="center">Pelanggan</div></th>
              <th><div align="center">Buyer</div></th>
              <th><div align="center">PO</div></th>
              <th><div align="center">Order</div></th>
              <th><div align="center">Item</div></th>
              <th><div align="center">Jenis Kain</div></th>
              <th><div align="center">Warna</div></th>
              <th><div align="center">No Warna</div></th>
              <th><div align="center">Lot</div></th>
              <th><div align="center">Roll</div></th>
              <th><div align="center">Bruto</div></th>
              <th><div align="center">Status Warna</div></th>
              <th><div align="center">Grouping</div></th>
              <th><div align="center">Hue</div></th>
              <th><div align="center">Disposisi</div></th>
              <th><div align="center">Colorist Qcf</div></th>
              <th><div align="center">Code Proses</div></th>
              <th><div align="center">Tgl Celup</div></th>
              <th><div align="center">Review</div></th>
              <th><div align="center">Remark</div></th>
              <th><div align="center">Demand ERP</div></th>
              <th><div align="center">Prod. Order ERP</div></th>
              <th><div align="center">Keterangan</div></th>
            </tr>
          </thead>
          <tbody>
          <?php
            $no=1;
            if($GShift!="ALL"){ $shft=" AND `shift`='$GShift' ";}else{$shft=" ";}
            if($Awal!=""){ $Where =" AND DATE_FORMAT( tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; }
            if($Awal!="" or $Akhir!="" or $Order or $PO){
              $qry1=mysqli_query($con,"SELECT * FROM tbl_lap_inspeksi WHERE `dept`='QCF' AND no_order LIKE '%$Order%' AND no_po LIKE '%$PO%' $shft $Where ORDER BY tgl_update ASC");
            }else{
              $qry1=mysqli_query($con,"SELECT * FROM tbl_lap_inspeksi WHERE `dept`='QCF' AND no_order LIKE '$Order' AND no_po LIKE '$PO' $shft $Where ORDER BY tgl_update ASC");
            }
                while($row1=mysqli_fetch_array($qry1)){
					$pos=strpos($row1['pelanggan'],"/");
					if($pos>0) {
					$lgg1=substr($row1['pelanggan'],0,$pos);
					$byr1=substr($row1['pelanggan'],$pos+1,100);	
					}else{
						$lgg1=$row1['pelanggan'];
						$byr1=substr($row1['pelanggan'],$pos,100);
					}
              ?>
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo $no; ?></td>
            <td align="center"><?php echo $row1['shift'];?></td>
            <td align="center"><div class="btn-group">
            <!--<a href="#" class="btn btn-info btn-xs cwarnafin_edit <?php if($_SESSION['akses']=='biasa' AND ($_SESSION['lvl_id']!='PACKING' OR $_SESSION['lvl_id']!='NCP')){ echo "disabled"; } ?>" id="<?php echo $row1['id']; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i> </a>-->
            <!--<a href="#" class="btn btn-danger btn-xs <?php if($_SESSION['akses']=='biasa' AND ($_SESSION['lvl_id']!='PACKING' OR $_SESSION['lvl_id']!='NCP')){ echo "disabled"; } ?>" onclick="confirm_delete('./HapusDataCWarnaFin-<?php echo $row1['id'] ?>');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus"></i> </a>-->
            <button id="<?php echo $row1['id']; ?>" class="btn btn-danger btn-xs delcwarnafin" <?php if($_SESSION['akses']=='biasa' AND ($_SESSION['lvl_id']!='PACKING' OR $_SESSION['lvl_id']!='NCP')){ echo "disabled"; } ?>><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus"></i></button>
            </div></td>
            <td align="center"><?php echo $row1['tgl_update'];?></td>
            <td align="center"><?php echo $row1['nokk'];?></td>
            <td><?php echo $lgg1;?></td>
            <td align="center"><?php echo $byr1;?></td>
            <td align="center"><?php echo $row1['no_po'];?></td>
            <td align="center"><?php echo $row1['no_order'];?></td>
            <td align="center"><?php echo $row1['no_item'];?></td>
            <td><?php echo substr($row1['jenis_kain'],0,15)."...";?></td>
            <td align="left"><?php echo substr($row1['warna'],0,10)."...";?></td>
            <td align="left"><?php echo $row1['no_warna'];?></td>
            <td align="center"><?php echo $row1['lot'];?></td>
            <td align="center"><?php echo $row1['jml_roll'];?></td>
            <td align="center"><?php echo $row1['bruto'];?></td>
            <td><a data-pk="<?php echo $row1['id'] ?>" data-value="<?php echo $row1['status'] ?>" class="sts_fin" href="javascipt:void(0)"><?php echo $row1['status'] ?></a>
            </td>
            <td><a data-pk="<?php echo $row1['id'] ?>" data-value="<?php echo $row1['grouping'] ?>" class="grouping_fin" href="javascipt:void(0)"><?php echo $row1['grouping'] ?></a></td>
            <td><a data-pk="<?php echo $row1['id'] ?>" data-value="<?php echo $row1['hue'] ?>" class="hue_fin" href="javascipt:void(0)"><?php echo $row1['hue'] ?></a></td>
            <td align="center"><a data-pk="<?php echo $row1['id'] ?>" data-value="<?php echo $row1['disposisi'] ?>" class="disposisi_fin" href="javascipt:void(0)"><?php echo $row1['disposisi'] ?></a></td>
            <td align="center"><a data-pk="<?php echo $row1['id'] ?>" data-value="<?php echo $row1['colorist_qcf'] ?>" class="colorist_qcf_fin" href="javascipt:void(0)"><?php echo $row1['colorist_qcf'] ?></a></td>
            <td align="center"><a data-pk="<?php echo $row1['id'] ?>" data-value="<?php echo $row1['proses'] ?>" class="code_proses" href="javascipt:void(0)"><?php echo $row1['proses'] ?></a></td>
            <td align="center"><?php echo $row1['tgl_pengiriman'];?></td>
            <td align="center"><a data-pk="<?php echo $row1['id'] ?>" data-value="<?php echo $row1['review_qcf'] ?>" class="review_qcf" href="javascipt:void(0)"><?php echo $row1['review_qcf'] ?></a></td>
            <td align="center"><a data-pk="<?php echo $row1['id'] ?>" data-value="<?php echo $row1['remark_qcf'] ?>" class="remark_qcf" href="javascipt:void(0)"><?php echo $row1['remark_qcf'] ?></a></td>
            <td align="center"><?php echo $row1['demand_erp'];?></td>
            <td align="center"><?php echo $row1['noprodorder'];?></td>
            <td align="center"><a data-pk="<?php echo $row1['id'] ?>" data-value="<?php echo $row1['catatan'] ?>" class="ket_fin" href="javascipt:void(0)"><?php echo $row1['catatan'] ?></a></td>
            </tr>
          <?php	$no++;  } ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_del" tabindex="-1" >
  <div class="modal-dialog modal-sm" >
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Are you sure to delete all data ?</h4>
      </div>

      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div id="CWarnaFinEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	
<script type="text/javascript">
    function confirm_delete(delete_url)
    {
      $('#modal_del').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>	
<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

	</script>
</body>
</html>
