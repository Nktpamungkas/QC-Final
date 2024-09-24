<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
// if (mysqli_connect_errno()) {
// printf("Connect failed: %s\n", mysqli_connect_error());
//    header("Refresh:3");
// exit();
// ?>
<?php
//set base constant 
if( !isset($_SESSION['usrid']) || !isset($_SESSION['pasid']) ) {
 ?>
 <script>setTimeout("location.href='login.php'",500);</script> 
 <?php
 die( 'Illegal Acces' ); 
}

//request page
$page	= isset($_GET['p'])?$_GET['p']:'';
$act	= isset($_GET['act'])?$_GET['act']:'';
$id		= isset($_GET['id'])?$_GET['id']:'';
$page	= strtolower($page);
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head>
    <meta charset="utf-8">
	<meta http-equiv="refresh" content="180">
    <title>Home</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
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
    max-width: 1200px;
    margin: 0 auto;
}
		</style>
	</head>
<body>
      <div class="callout callout-info">
        <h4>Welcome <?php echo strtoupper($_SESSION['usrid']);?> at Indo Taichen Textile Industry</h4>
        This is a web-based Indo Taichen system
      </div>
	<!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
		<a href="RekapData">	
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-pencil-square-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rekap Data</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
			</a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php if($_SESSION['lvl_id']!="DMF" AND $_SESSION['lvl_id']!="TQ"){?>
        <div class="col-md-3 col-sm-6 col-xs-12">
		<a href="SummaryOrder">	
          <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="fa fa-check"></i></span>
            <?php
            include('koneksi.php');
            //TIM A
            $sqldt=mysqli_query($con,"SELECT COUNT(*) AS jml_a FROM tbl_qcf WHERE sts_pbon='1' AND sts_aksi IS NULL AND 
            (sales='Darien' OR sales='Gilang Kurnia' OR sales='Vany Leany' OR sales='Thania' OR sales='Viviani' OR sales='Heri' OR sales='Bunbun' OR sales='Frans' OR sales='Fransiska') AND 
            DATE_FORMAT( tgl_masuk, '%Y-%m-%d' ) BETWEEN '2021-01-01' AND NOW()
            ");
            $row = mysqli_fetch_array($sqldt);
            //TIM B
            $sqldt1=mysqli_query($con,"SELECT COUNT(*) AS jml_b FROM tbl_qcf WHERE sts_pbon='1' AND sts_aksi IS NULL AND 
            (sales='Roni' OR sales='Deden' OR sales='Rangga Aditya' OR sales='Nia') AND 
            DATE_FORMAT( tgl_masuk, '%Y-%m-%d' ) BETWEEN '2021-01-01' AND NOW()
            ");
            $row1 = mysqli_fetch_array($sqldt1);
            //TIM C
            $sqldt2=mysqli_query($con,"SELECT COUNT(*) AS jml_c FROM tbl_qcf WHERE sts_pbon='1' AND sts_aksi IS NULL AND 
            (sales='Ridwan' OR sales='Ikhsan Ikhwana' OR sales='Bambang' OR sales='Budiman' OR sales='Dennis' OR sales='Levia Zhuang' OR sales=' Kevin Noventin' OR sales='Fahrurrozi' OR sales='Richard' OR sales='Yohanes') AND 
            DATE_FORMAT( tgl_masuk, '%Y-%m-%d' ) BETWEEN '2021-01-01' AND NOW()
            ");
            $row2 = mysqli_fetch_array($sqldt2);
          ?>
            <div class="info-box-content">
              <span class="info-box-text">Bon Penghubung</span>
              <span class="label bg-red blink_me">Team A = <?php echo $row['jml_a'];?></span><br>
              <span class="label bg-red blink_me">Team B = <?php echo $row1['jml_b'];?></span><br>
              <span class="label bg-red blink_me">Team C = <?php echo $row2['jml_c'];?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
			</a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php } ?>
        <?php if($_SESSION['lvl_id']=="PACKING" OR $_SESSION['lvl_id']=="AFTERSALES" OR $_SESSION['lvl_id']=="LEADERTQ" OR $_SESSION['lvl_id']=="NCP" OR $_SESSION['lvl_id']=="INSPEKSI" OR $_SESSION['lvl_id']=="TQ"){?>
        <div class="col-md-3 col-sm-6 col-xs-12">
		      <a href="Schedule">	
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Schedule Inspeksi</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
			    </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php } ?>
      <?php if($_SESSION['lvl_id']=="PACKING" OR $_SESSION['lvl_id']=="AFTERSALES" OR $_SESSION['lvl_id']=="LEADERTQ" OR $_SESSION['lvl_id']=="NCP" OR $_SESSION['lvl_id']=="INSPEKSI"){?>
        <div class="col-md-3 col-sm-6 col-xs-12"><a href="FinalStatusTQNew">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-file-text"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Final Test Quality</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
		</a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
		    <a href="LapNCP">	
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-bar-chart-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Laporan NCP</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
			  </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
		<a href="LapDisposisi">	
          <div class="info-box">
            <span class="info-box-icon bg-maroon"><i class="fa fa-cube"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Laporan KPE Disposisi QC</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
			</a>
          <!-- /.info-box -->
        </div>
        <!-- /.col --> 
        <div class="col-md-3 col-sm-6 col-xs-12">
		<a href="LapKPE">	
          <div class="info-box">
            <span class="info-box-icon bg-lime"><i class="fa fa-gear"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Laporan KPE</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
			</a>
          <!-- /.info-box -->
        </div>
        <!-- /.col --> 
    
        <div class="col-md-3 col-sm-6 col-xs-12">
		<a href="LapQCF">	
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-credit-card"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Laporan Harian QCF</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
			</a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php } ?>
        <?php if($_SESSION['lvl_id']=="DMF"){?>
          <div class="col-md-3 col-sm-6 col-xs-12"><a href="FinalStatusTQNew">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-file-text"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Final Test Quality</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
		</a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

          <div class="col-md-3 col-sm-6 col-xs-12">
		<a href="LapDisposisi">	
          <div class="info-box">
            <span class="info-box-icon bg-maroon"><i class="fa fa-cube"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Laporan KPE Disposisi QC</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
			</a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
		    <a href="LapNCP">	
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-bar-chart-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Laporan NCP</span>
              <span class="info-box-number">&nbsp;</span>
            </div>
            <!-- /.info-box-content -->
          </div>
			  </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php } ?>
    <div class="col-md-3 col-sm-6 col-xs-12">
    <?php if($_SESSION['lvl_id']=="LEADERTQ" OR $_SESSION['lvl_id']=="DMF"){?>
		<a href="StatusTQNew">	
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-check-square-o"></i></span>
            <?php
            include('koneksi.php');
            $delay = date('Y-m-d');
            $sqldt=mysqli_query($con,"SELECT COUNT(*) as cnt FROM tbl_tq_nokk a
            LEFT JOIN tbl_tq_test b ON a.id=b.id_nokk
            WHERE (`status`='' or `status` IS NULL) AND DATE_FORMAT( tgl_masuk, '%Y-%m-%d' ) BETWEEN DATE_SUB(NOW(),INTERVAL 30 DAY) AND NOW() AND tgl_target < '$delay'
            ");
            $row = mysqli_fetch_array($sqldt);
          ?>
            <div class="info-box-content">
              <span class="info-box-text">Status Test Quality</span>
              <span class="label bg-red blink_me">Delay Test Quality = <?php echo $row['cnt'];?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
			  </a>
      <?php } ?>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->      
      
    </section>
    <!-- /.content -->
       
</body>
</html>	
<?php mysqli_close($con);?>
	