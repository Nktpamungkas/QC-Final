<?PHP
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="180" />
<title>Status Test Quality</title>
</head>
<body>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
<div class="box-header">
  <!--<a href="FormKK" class="btn btn-success <?php if($_SESSION['levelPpc']=="biasa"){ echo "disabled";} ?>"><i class="fa fa-plus-circle"></i> Tambah</a>-->
  <?php 
        $delay = date('Y-m-d');
        $sqldt=mysqli_query($con,"SELECT COUNT(*) as cnt FROM tbl_tq_nokk a
        LEFT JOIN tbl_tq_test b ON a.id=b.id_nokk
        WHERE (`status`='' or `status` IS NULL) AND DATE_FORMAT( tgl_masuk, '%Y-%m-%d' ) BETWEEN DATE_SUB(NOW(),INTERVAL 30 DAY) AND NOW() AND tgl_target < '$delay'");
        $row = mysqli_fetch_array($sqldt);
      ?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-info"></i> Informasi</h4>

        <p>Terdapat <?php echo $row['cnt'];?> test Delay.</p>
      </div>
      <div class="box-body">
      <div class="pull-right">
        <a href="pages/cetak/excel_delay_tq.php" class="btn btn-success" target="_blank">Excel Delay</a> 
      </div>
      <table id="example1" class="table table-bordered table-hover table-striped" width="100%"> 
          <thead class="bg-blue">
            <tr>
              <th width="24"><div align="center">#</div></th>
              <th width="24"><div align="center">No. Test</div></th>
              <th width="90"><div align="center">No. KK</div></th>
              <th width="50"><div align="center">Tgl Masuk</div></th>
              <th width="50"><div align="center">Tgl Target</div></th>
			        <th width="130"><div align="center">Pelanggan</div></th>
              <th width="50"><div align="center">No. PO</div></th>
              <th width="100"><div align="center">No. Order</div></th>
              <th width="100"><div align="center">No. Item</div></th>
              <th width="100"><div align="center">Jenis Kain</div></th>
              <th width="50"><div align="center">Lot</div></th>
              <th width="100"><div align="center">Warna</div></th>
            </tr>
          </thead>
          <tbody>
            <?php
	    include('koneksi.php');
      $sqldt=mysqli_query($con,"SELECT a.*, a.id AS idkk, b.* FROM tbl_tq_nokk a
      LEFT JOIN tbl_tq_test b ON a.id=b.id_nokk
      WHERE (`status`='' or `status` IS NULL) and DATE_FORMAT( tgl_masuk, '%Y-%m-%d' ) between date_sub(now(),INTERVAL 30 DAY) and now()
      ORDER BY tgl_target ASC");
      $no="1";
      while($rowd=mysqli_fetch_array($sqldt)){
      $tgltarget = new DateTime($rowd['tgl_target']);
      $now=new DateTime();
      $target = $now->diff($tgltarget);
      $delay = $tgltarget->diff($now);
      //$nokk = $rowd['nokk'];
		 ?>
         <tr>
                  <td align="center" ><?php echo $no;?></td>
                  <td align="center" >
                  <a href="SummaryTQNew-<?php echo $rowd['no_test'];?>"><?php echo $rowd['no_test'];?></a>
                  </td>
                  <td align="center" ><a href="#" class="posisi_kktq" id="<?php echo $rowd['nokk']; ?>"><?php echo $rowd['nokk']; ?></a></td>
                  <td align="center" ><?php echo $rowd['tgl_masuk'];?></td>
                  <td align="center" ><?php echo $rowd['tgl_target'];?><br>
                  <?php if($tgltarget>$now){ ?>
                  <span class='badge bg-blue'><?php echo $target->d+1; echo " Hari lagi";?></span>
                  <?php }elseif($delay->d>0){ ?>
                  <span class='badge bg-red blink_me'><?php echo "Delay "; echo $delay->d; echo " Hari";?></span> 
                  <?php }elseif($delay->d==0){?>
                  <span class='badge bg-yellow blink_me'><?php echo "Hari ini Terakhir";?></span>
                  <?php } ?>
                  </td>
                  <td align="left" ><font size="-1"><?php echo $rowd['pelanggan'];?></font></td>
                  <td align="center" ><?php echo $rowd['no_po'];?></td>
                  <td align="center" ><?php echo $rowd['no_order'];?></td>
                  <td align="center" ><?php echo $rowd['no_item'];?></td>
                  <td align="center" >
                  <a href="#" id='<?php echo $rowd['idkk']; ?>' class="update_jeniskain"><?php echo $rowd['jenis_kain'];?></a>
                  </td>
                  <td align="center" ><?php echo $rowd['lot'];?></td>
                  <td align="center" ><?php echo $rowd['warna'];?></td>
                </tr>
                <?php $no++;
  } ?>
              </tbody>
            </table>
            </div>
	  </div>
	</div>
</div>
	</div>
<div id="UpdateJenisKain" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div id="PosisiKKTQ" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
</body>
</html>