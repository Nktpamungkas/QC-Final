<?PHP
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register NCP</title>

</head>
<body>
<?php
$Awal	= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	= isset($_POST['akhir']) ? $_POST['akhir'] : '';
$Dept	= isset($_POST['dept']) ? $_POST['dept'] : '';	
	
if($_POST['gshift']=="ALL"){$shft=" ";}else{$shft=" AND b.g_shift = '$GShift' ";}	
?>
	
<div class="box box-primary collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title"> Filter Tanggal Kembali Ke QC</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
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
            <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" />
          </div>
        </div>
        <!-- /.input group -->
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="akhir" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" />
          </div>
        </div>
        <!-- /.input group -->
      </div>
      <div class="form-group">
                	<div class="col-sm-3">
		  <select class="form-control select2" name="dept" id="dept" required>
				<option value="">Pilih</option>
			    <option value="ALL" <?php if($Dept=="ALL"){echo "SELECTED";}?>>ALL</option>
				<option value="MKT" <?php if($Dept=="MKT"){echo "SELECTED";}?>>MKT</option>
				<option value="FIN" <?php if($Dept=="FIN"){echo "SELECTED";}?>>FIN</option>
				<option value="DYE" <?php if($Dept=="DYE"){echo "SELECTED";}?>>DYE</option>
				<option value="KNT" <?php if($Dept=="KNT"){echo "SELECTED";}?>>KNT</option>
				<option value="LAB" <?php if($Dept=="LAB"){echo "SELECTED";}?>>LAB</option>
				<option value="PPC" <?php if($Dept=="PPC"){echo "SELECTED";}?>>PPC</option>
				<option value="QCF" <?php if($Dept=="QCF"){echo "SELECTED";}?>>QCF</option>
				<option value="RMP" <?php if($Dept=="RMP"){echo "SELECTED";}?>>RMP</option>
				<option value="KNK" <?php if($Dept=="KNK"){echo "SELECTED";}?>>KNK</option>
				<option value="GKG" <?php if($Dept=="GKG"){echo "SELECTED";}?>>GKG</option>
				<option value="GKJ" <?php if($Dept=="GKJ"){echo "SELECTED";}?>>GKJ</option>
        <option value="GAS" <?php if($Dept=="GAS"){echo "SELECTED";}?>>GAS</option>
				<option value="BRS" <?php if($Dept=="BRS"){echo "SELECTED";}?>>BRS</option>
				<option value="PRT" <?php if($Dept=="PRT"){echo "SELECTED";}?>>PRT</option>
			    <option value="YND" <?php if($Dept=="YND"){echo "SELECTED";}?>>YND</option>
				<option value="PRO" <?php if($Dept=="PRO"){echo "SELECTED";}?>>PRO</option>
			    <option value="TAS" <?php if($Dept=="TAS"){echo "SELECTED";}?>>TAS</option>
			</select>
		  			</div>
				 <!-- /.input group -->
              </div> 
               
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-2">
        <button type="submit" class="btn btn-social btn-linkedin btn-sm" name="save">Search <i class="fa fa-search"></i></button>
      </div>
    </div>
    <!-- /.box-footer -->
  </form>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data Register NCP</h3><br><?php if($_POST['awal']!="") { ?><b>Periode: <?php echo $_POST['awal']." to ".$_POST['akhir']; ?></b>
		<?php } ?>
        <?php if($_POST['awal']!="") { ?> 
		<div class="pull-right">
		  <a href="pages/cetak/cetak_registerncp.php?&awal=<?php echo $Awal; ?>&akhir=<?php echo $Akhir; ?>&dept=<?php echo $Dept; ?>" class="btn btn-danger " target="_blank" data-toggle="tooltip" data-html="true" title="Register NCP"><i class="fa fa-print"></i> Cetak</a>			
		</div>  
		<?php } ?>
	  </div>
      <div class="box-body">
      <table class="table table-bordered table-hover table-striped nowrap" id="example3" style="width:100%">
        <thead class="bg-blue">
          <tr>
            <th><div align="center">No</div></th>
            <th><div align="center">Tgl Masuk</div></th>
            <th><div align="center">No NCP</div></th>
			<th><div align="center">PO Rajut</div></th>  
            <th><div align="center">Jenis NCP</div></th>
            <th><div align="center">Peninjau</div></th>
            <th><div align="center">Tindakan Perbaikan</div></th>
            <th><div align="center">Tgl Rencana</div></th>
            <th><div align="center">Tgl Aktual</div></th>
            <th><div align="center">Penanggung Jawab</div></th>
            </tr>
        </thead>
        <tbody>
          <?php
	$no=1;		
	if($Dept=="ALL"){		
	$Wdept=" ";	
	}else{	
	$Wdept=" dept='$Dept' AND ";	
	}		
	$qry1=mysqli_query($con,"SELECT * FROM tbl_ncp_qcf WHERE $Wdept DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' ORDER BY id ASC");
			while($row1=mysqli_fetch_array($qry1)){
		 ?>
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo substr($row1['no_ncp'],10,3); ?></td>
            <td align="center"><?php echo date("d/m/y", strtotime($row1['tgl_buat']));?></td>
            <td><?php echo $row1['no_ncp'];?></td>
			<td><?php echo $row1['po_rajut'];?></td>  
            <td align="center"><?php echo $row1['masalah'];?></td>
            <td align="center"><?php echo $row1['peninjau_awal'];?></td>
            <td align="center"><?php if($row1['catat_verify']==""){echo $row1['penyelesaian'];}else{echo $row1['catat_verify'];}?></td>
            <td align="center"><?php if($row1['tgl_rencana']!=""){echo date("d/m/y", strtotime($row1['tgl_rencana']));}?></td>
            <td align="center"><?php if($row1['tgl_selesai']!=""){echo date("d/m/y", strtotime($row1['tgl_selesai']));}?></td>
            <td align="center"><?php echo $row1['penyebab'];?></td>
            </tr>
          <?php	$no++;  } ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div id="StsEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	
<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

	</script>
</body>
</html>