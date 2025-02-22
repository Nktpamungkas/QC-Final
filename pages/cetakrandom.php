<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Random</title>
<style type="text/css">
#container {
    height: 300px; 
    min-width: 310px; 
    max-width: 500px;
    margin: 0 auto;
}
	</style>
</head>
<body>
<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$Awal	= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	= isset($_POST['akhir']) ? $_POST['akhir'] : '';
?>
<div class="row">
<div class="col-md-12">
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"> Filter Cetak Random</h3>
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
        <div class="box-body">
        <div class="form-group">
            <div class="col-sm-3">
                <div class="input-group date">
                    <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                    <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off"/>
                </div>
            </div>
            <!-- /.input group -->
        </div>
        <div class="form-group">
            <div class="col-sm-3">
                <div class="input-group date">
                    <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                    <input name="akhir" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" autocomplete="off"/>
                </div>
            </div>
            <!-- /.input group -->
        </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="search" style="width: 60%">Search <i class="fa fa-search"></i></button>
            </div>
            <div class="col-sm-2">
                <div class="pull-left">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Random</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="pages/cetak/cetak_prt.php" target="_blank">P. Random Tumble</a></li>
                            <li><a href="pages/cetak/cetak_pb.php" target="_blank">P. Box</a></li>
                            <li><a href="pages/cetak/cetak_pm.php" target="_blank">P. Martindle</a></li>
                            <li><a href="pages/cetak/cetak_sp.php" target="_blank">Snag. Pod</a></li>
                            <li><a href="pages/cetak/cetak_dt.php" target="_blank">Drying Time AW</a></li>
                            <li><a href="pages/cetak/cetak_bs.php" target="_blank">Bursting Strength</a></li>
                            <li><a href="pages/cetak/cetak_sr.php" target="_blank">Stretch And Recovery</a></li>
                            <li><a href="pages/cetak/cetak_bas.php" target="_blank">Bow & Skew</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if($Awal!=""){?>
            <a href="pages/cetak/cetak_randomnew2.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" target="_blank" class="btn btn-danger pull-right">Cetak</a>
            <?php }?>
        </div>
    </form>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"> Data Random</h3>
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped nowrap" id="example3" style="width:100%">
            <thead class="bg-blue">
                <tr>
                    <th rowspan="4" align="center">AKSI</th>
                    <th rowspan="2" colspan="8" align="center">&nbsp;</th>
                    <th colspan="10" align="center">SNAG POD (FACE)</th>
                    <th colspan="2"align="center">SNAG POD (BACK)</th>
                    <th rowspan="4" align="center">SNAG MACE</th>
                    <th colspan="3" align="center">BS</th>
                    <th colspan="2" align="center">PILLING MARTINDALE</th>
                    <th colspan="2" align="center">ELONGATION</th>
                    <th colspan="2" align="center">RECOVERY</th>
                    <th rowspan="2" colspan="2" align="center">WICKING</th>
                    <th rowspan="2" align="center">ABSORBENCY</th>
                    <th rowspan="2" align="center">EVAPORATION RATE</th>
                    <th rowspan="3" colspan="2" align="center">BOW &amp; SKEW</th>
                </tr>
                <tr>
                    <th colspan="5" align="center">LENGTH</th>
                    <th colspan="5" align="center">WIDTH</th>
                    <th align="center">LENGTH</th>
                    <th align="center">WIDTH</th>
                    <th align="center">N</th>
                    <th align="center">KPA</th>
                    <th align="center">PSI</th>
                    <th align="center">500</th>
                    <th align="center">2000</th>
                    <th align="center">L</th>
                    <th align="center">W</th>
                    <th align="center">L</th>
                    <th align="center">W</th>
                </tr>
                <tr>
                    <th rowspan="2" align="center">ITEM</th>
                    <th rowspan="2" align="center">HANGER</th>
                    <th rowspan="2" align="center">DESCRIPTION</th>
                    <th rowspan="2" align="center">BUYER</th>
                    <th rowspan="2" align="center">WIDTH</th>
                    <th rowspan="2" align="center">GSM</th>
                    <th rowspan="2" align="center">PILL R. TUMBLER</th>
                    <th rowspan="2" align="center">PILL BOX</th>
                    <th colspan="12" align="center">SNAGPOD</th>
                    <th colspan="3" align="center">BS</th>
                    <th colspan="2" align="center">PILL MARTINDALE</th>
                    <th colspan="2" align="center">ELONGATION</th>
                    <th colspan="2" align="center">RECOVERY</th>
                    <th align="center">L</th>
                    <th align="center">W</th>
                    <th align="center">PHX-AP0604</th>
                    <th align="center">PHX-AP0607</th>
                </tr>
                <tr>
                    <th align="center">Grade</th>
                    <th align="center">Class</th>
                    <th align="center">Snag < 2mm</th>
                    <th align="center">Snag 2-5mm</th>
                    <th align="center">Snag > 5mm</th>
                    <th align="center">Grade</th>
                    <th align="center">Class</th>
                    <th align="center">Snag < 2mm</th>
                    <th align="center">Snag 2-5mm</th>
                    <th align="center">Snag > 5mm</th>
                    <th align="center">Grade</th>
                    <th align="center">Grade</th>
                    <th align="center">NEWTON</th>
                    <th align="center">KPA</th>
                    <th align="center">PSI</th>
                    <th align="center">500 REV</th>
                    <th align="center">2000 REV</th>
                    <th align="center">L</th>
                    <th align="center">W</th>
                    <th align="center">L</th>
                    <th align="center">W</th>
                    <th align="center" colspan="2">After 5 Wash</th>
                    <th align="center">After 5 Wash</th>
                    <th align="center">After 5 Wash</th>
                    <th align="center">Bow</th>
                    <th align="center">Skew</th>
                </tr>
            </thead>
            <tbody>
            <?php 
             $query=mysqli_query($con,"SELECT * FROM tbl_tq_randomtest WHERE YEAR(tgl_update) = YEAR(CURRENT_DATE)
             AND MONTH(tgl_update) = MONTH(CURRENT_DATE) GROUP BY no_item ");
             while($r=mysqli_fetch_array($query)){
                $q1=mysqli_query($con,"SELECT * FROM tbl_tq_nokk WHERE no_item='$r[no_item]' OR no_hanger='$r[no_hanger]'");
                $r1=mysqli_fetch_array($q1);
                $pos=strpos($r1['pelanggan'], "/");
	            $posbuyer=substr($r1['pelanggan'],$pos+1,50);
                $buyer=str_replace("'","''",$posbuyer);
            ?>
            <tr>
                <td align="center"><div class="btn-group">
                <a href="#" class="btn btn-danger btn-xs <?php if($_SESSION['akses']=='biasa'){ echo "disabled"; } ?>" onclick="confirm_delete('./HapusDataRandom-<?php echo $r['id'] ?>');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus"></i> </a>
                </div></td>
                <td align="left"><?php echo $r['no_item'];?></td>
                <td align="left"><?php echo $r['no_hanger'];?></td>
                <td align="left"><?php echo substr($r1['jenis_kain'],0,30);?></td>
                <td align="center"><?php echo $buyer;?></td>
                <td align="center"><?php echo $r1['lebar'];?></td>
                <td align="center"><?php echo $r1['gramasi'];?></td>
                <td align="center"><?php if($r['rprt_f1']!=""){echo "F: ".$r['rprt_f1'];}?> &nbsp; <?php if($r['rprt_b1']!=""){echo "B: ".$r['rprt_b1'];}?></td>
                <td align="center"><?php echo $r['rpb_f1'];?></td>
                <td align="center"><?php echo $r['rsp_grdl1'];?></td>
                <td align="center"><?php echo $r['rsp_clsl1'];?></td>
                <td align="center"><?php echo $r['rsp_shol1'];?></td>
                <td align="center"><?php echo $r['rsp_medl1'];?></td>
                <td align="center"><?php echo $r['rsp_lonl1'];?></td>
                <td align="center"><?php echo $r['rsp_grdw1'];?></td>
                <td align="center"><?php echo $r['rsp_clsw1'];?></td>
                <td align="center"><?php echo $r['rsp_show1'];?></td>
                <td align="center"><?php echo $r['rsp_medw1'];?></td>
                <td align="center"><?php echo $r['rsp_lonw1'];?></td>
                <td align="center"><?php echo $r['rsp_grdl2'];?></td>
                <td align="center"><?php echo $r['rsp_grdw2'];?></td>
                <td align="center"><?php if($r['rsm_l1']!=""){echo "L= ".$r['rsm_l1'];}?> &nbsp; <?php if($r['rsm_w1']!=""){echo "W= ".$r['rsm_w1'];}?></td>
                <td align="center"><?php echo $r['rbs_instron'];?></td>
                <td align="center"><?php echo $r['rbs_tru'];?></td>
                <td align="center"><?php echo $r['rbs_mullen'];?></td>
                <td align="center"><?php echo $r['rpm_f1'];?></td>
                <td align="center"><?php echo $r['rpm_f2'];?></td>
                <td align="center"><?php echo $r['rstretch_11'];?></td>
                <td align="center"><?php echo $r['rstretch_w1'];?></td>
                <td align="center"><?php echo $r['rrecover_11'];?></td>
                <td align="center"><?php echo $r['rrecover_w1'];?></td>
                <td align="center"><?php echo $r['rwick_l2'];?></td>
                <td align="center"><?php echo $r['rwick_w2'];?></td>
                <td align="center"><?php echo $r['rabsor_b1'];?></td>
                <td align="center"><?php echo $r['rdryaf1'];?></td>
                <td align="center"><?php echo $r['rbow'];?></td>
                <td align="center"><?php echo $r['rskew'];?></td>
            </tr>
            <?php } ?>
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
<script type="text/javascript">
    function confirm_delete(delete_url)
    {
      $('#modal_del').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>	
</body>
</html>