<?php
ini_set("error_reporting", 1);
include"koneksi.php";
$nokk=$_GET['nokk'];
$sql=sqlsrv_query($conn,"select top 1
			x.*,dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight, 
			pm.Weight as Gramasi,pm.CuttableWidth as Lebar, pm.Description as ProductDesc, pm.ColorNo, pm.Color,
      dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PODate,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo, jo.DocumentNo as NoOrder,soda.PONumber,
				pcb.ID as PCBID, pcb.Gross as Bruto,soda.HangerNo,pp.ProductCode,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID,sod.RequiredDate
				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProductPartner pp on pp.productid= sod.productid left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID left join
				ProcessControlBatchesLastPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
			where pcb.DocumentNo='$nokk' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,soda.HangerNo,pp.ProductCode,
					pcb.ID, pcb.DocumentNo, pcb.Gross,soda.PONumber,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID,sod.RequiredDate
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID");
		  $r=sqlsrv_fetch_array($sql);
$sql1=sqlsrv_query($conn,"select partnername from partners where id='$r[CustomerID]'");	
$r1=sqlsrv_fetch_array($sql1);
$sql2=sqlsrv_query($conn,"select partnername from partners where id='$r[BuyerID]'");	
$r2=sqlsrv_fetch_array($sql2);
$pelanggan=$r1['partnername']."/".$r2['partnername'];
$ko=sqlsrv_query($conn,"select  ko.KONo from
		ProcessControlJO pcjo inner join
		ProcessControl pc on pcjo.PCID = pc.ID left join
		KnittingOrders ko on pc.CID = ko.CID and pcjo.KONo = ko.KONo 
	where pcjo.PCID = '$r[PCID]'
group by ko.KONo");
					$rKO=sqlsrv_fetch_array($ko);
					
$child=$r['ChildLevel'];
	if($nokk!=""){	
		if($child > 0){
			$sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='$r[RootID]' and ChildLevel='0'");
			$rowgp=sqlsrv_fetch_array($sqlgetparent);
			
			//$nomLot=substr("$row2[LotNo]",0,1);
			$nomLot=$rowgp['LotNo'];
			$nomorLot="$nomLot/K$r[ChildLevel]";				
								
		}else{
			$nomorLot=$r['LotNo'];
				
		}

		$sqlLot1="Select count(*) as TotalLot From ProcessControlBatches where PCID='$r[PCID]' and RootID='0' and LotNo < '1000'";
		$qryLot1 = sqlsrv_query($conn,$sqlLot1) or die('A error occured : ');							
		$rowLot=sqlsrv_fetch_array($qryLot1);
		$lotno=$rowLot['TotalLot']."-".$nomorLot;
		if($r['Quantity']!=""){
		$x=((($r['Lebar']+2)*$r['Gramasi'])/43.06038193629178);
		$x1=(1000/$x);
		$yard=$x1*$r['Quantity']; 
	}

}
$sqlCek=mysqli_query($con,"SELECT * FROM tbl_qcf WHERE nokk='$nokk' ORDER BY id DESC LIMIT 1");
$cek=mysqli_num_rows($sqlCek);
$rcek=mysqli_fetch_array($sqlCek);

$sqlCek1=mysqli_query($con,"SELECT * FROM tbl_lbl_availability WHERE nokk='$nokk' ORDER BY id DESC LIMIT 1");
$cek1=mysqli_num_rows($sqlCek1);
$rcek1=mysqli_fetch_array($sqlCek1);

?>	
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1" id="form1" target="_blank">
 <div class="box box-info">
   <div class="box-header with-border">
    <h3 class="box-title">Input Data Kartu Kerja</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body"> 
	 <div class="col-md-6">		 
		<div class="form-group">
					  <label for="no_po" class="col-sm-3 control-label">No KK</label>
					  <div class="col-sm-4">
					  <input name="nokk" type="text" class="form-control" id="nokk" 
						 onchange="window.location='LabelQCF-'+this.value" value="<?php echo $_GET['nokk'];?>" placeholder="No KK" required >
			  </div>
					</div>
		<div class="form-group">
		  <label for="no_order" class="col-sm-3 control-label">No Order</label>
		  <div class="col-sm-4">
			<input name="no_order" type="text" class="form-control" id="no_order" 
			value="<?php if($cek1>0){echo $rcek1['no_order'];}else{echo $r['NoOrder'];} ?>" placeholder="No Order" required readonly>
		  </div>				   
		</div>
		<div class="form-group">
		  <label for="pelanggan" class="col-sm-3 control-label">Pelanggan</label>
		  <div class="col-sm-8">
			<input name="pelanggan" type="text" class="form-control" id="pelanggan" 
			value="<?php if($cek1>0){echo $rcek1['pelanggan'];}else if($r1['partnername']!=""){echo $pelanggan;}else{}?>" placeholder="Pelanggan" readonly>
		  </div>				   
		</div>
		<div class="form-group">
		  <label for="no_po" class="col-sm-3 control-label">PO</label>
		  <div class="col-sm-5">
			<input name="no_po" type="text" class="form-control" id="no_po" 
			value="<?php if($cek1>0){echo $rcek1['no_po'];}else{echo $r['PONumber'];} ?>" placeholder="PO" readonly>
		  </div>				   
		</div>
		<div class="form-group">
		  <label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
		  <div class="col-sm-3">
			<input name="no_hanger" type="text" class="form-control" id="no_hanger" 
			value="<?php if($cek1>0){echo $rcek1['no_hanger'];}else{echo $r['HangerNo'];}?>" placeholder="No Hanger" readonly>  
		  </div>
		  <div class="col-sm-3">
		  <input name="no_item" type="text" class="form-control" id="no_item" 
			value="<?php if($rcek1['no_item']!=""){echo $rcek1['no_item'];}else{echo $r['ProductCode'];}?>" placeholder="No Item" readonly>
		  </div>	
		</div>
		<div class="form-group">
		  <label for="jns_kain" class="col-sm-3 control-label">Jenis Kain</label>
		  <div class="col-sm-8">
			  <textarea name="jns_kain" class="form-control" id="jns_kain" placeholder="Jenis Kain" readonly><?php if($cek1>0){echo $rcek1['jenis_kain'];}else{echo $r['ProductDesc'];}?></textarea>
			  </div>
		  </div>	 		
		<div class="form-group">
		  <label for="l_g" class="col-sm-3 control-label">Lebar X Gramasi</label>
		  <div class="col-sm-2">
			<input name="lebar" type="text" class="form-control" id="lebar" 
			value="<?php if($cek1>0){echo $rcek1['lebar'];}else if($nokk!=""){echo round($r['Lebar']);}else{} ?>" placeholder="0" required readonly>
		  </div>
		  <div class="col-sm-2">
			<input name="grms" type="text" class="form-control" id="grms" 
			value="<?php if($cek1>0){echo $rcek1['gramasi'];}else if($nokk!=""){echo round($r['Gramasi']);}else{} ?>" placeholder="0" required readonly>
		  </div>		
		</div>
	  </div>
	  		<!-- col --> 
	  <div class="col-md-6">		  
		<div class="form-group">
		  <label for="warna" class="col-sm-3 control-label">Warna</label>
		  <div class="col-sm-8">
			<textarea name="warna" class="form-control" id="warna" placeholder="Warna" readonly><?php if($cek1>0){echo $rcek1['warna'];}else{echo $r['Color'];}?></textarea>
		  </div>				   
		</div>
		<div class="form-group">
		  <label for="no_warna" class="col-sm-3 control-label">No Warna</label>
		  <div class="col-sm-8">
			<textarea name="no_warna" class="form-control" id="no_warna" placeholder="No Warna" readonly><?php if($cek1>0){echo $rcek1['no_warna'];}else{echo $r['ColorNo'];}?></textarea>
		  </div>				   
		</div>
		<div class="form-group">
		  <label for="lot" class="col-sm-3 control-label">Lot</label>
		  <div class="col-sm-2">
			<input name="lot" type="text" class="form-control" id="lot" 
			value="<?php if($cek1>0){echo $rcek1['lot'];}else{echo $lotno;} ?>" placeholder="Lot" readonly>
		  </div>
		  <div class="col-sm-2">
			<input name="lot_erp" type="text" class="form-control" id="lot_erp" 
			value="<?php if($cek1>0){echo $rcek1['lot_erp'];} ?>" placeholder="Lot ERP">
		  </div>				   
		</div>
		<div class="form-group">
            <label for="availability" class="col-sm-3 control-label">Availability</label>
			<div class="col-sm-8">
                <select class="form-control select2" multiple="multiple" data-placeholder="Availability" name="availability[]" id="availability" required>
					<?php
					$dtArr=$rcek['availability'];	
					$data = explode(",",$dtArr);
					$dtArr1=$rcek1['availability'];	
					$data1 = explode(",",$dtArr1);
					?>
					<option value="DL" <?php if($data[0]=="DL" OR $data[1]=="DL" OR $data[2]=="DL" OR $data1[0]=="DL" OR $data1[1]=="DL" OR $data1[2]=="DL"){echo "SELECTED";} ?>>DL</option>
					<option value="SP" <?php if($data[0]=="SP" OR $data[1]=="SP" OR $data[2]=="SP" OR $data1[0]=="SP" OR $data1[1]=="SP" OR $data1[2]=="SP"){echo "SELECTED";} ?>>SP</option>
					<option value="PL" <?php if($data[0]=="PL" OR $data[1]=="PL" OR $data[2]=="PL" OR $data1[0]=="PL" OR $data1[1]=="PL" OR $data1[2]=="PL"){echo "SELECTED";} ?>>PL</option>
                </select>
			</div>
        </div> 	
	 </div>
	
</div>	 
   <div class="box-footer">
   <!-- <?php if($_GET['nokk']!=""){ ?>
	<button type="submit" class="btn btn-primary pull-left" name="save" value="save" <?php if(($cek>0 AND $rcek['availability']!=NULL) OR $cek1>0){echo "disabled";}?>><i class="fa fa-save"></i> Simpan</button> 
	<a href="pages/cetak/cetak_label_qcf.php?idkk=<?php echo $_GET['nokk']; ?>" target="_blank" class="btn btn-danger pull-right">Cetak</a> 
   <?php } ?>	 -->
   <?php if($cek1>0 OR $cek>0){ ?> 	
            <button type="submit" class="btn btn-primary pull-left" name="ubah" value="ubah"><i class="fa fa-edit"></i> Ubah</button> 
            <?php }else if($_GET['nokk']!="" and $cek1==0){?>
            <button type="submit" class="btn btn-primary pull-left" name="save" value="save"><i class="fa fa-save"></i> Simpan</button> 
            <?php } ?>
		<a href="pages/cetak/cetak_label_qcf.php?idkk=<?php echo $_GET['nokk']; ?>" target="_blank" class="btn btn-danger pull-right">Cetak</a>   
   </div>
    <!-- /.box-footer -->
</div>
</form>
    
						
                    </div>
                </div>
            </div>
        </div>
<?php
if($_POST['save']=="save" AND $cek>0){	
	//   $con=mysqli_connect("10.0.0.10","dit","4dm1n");
    //   $db=mysqli_select_db("db_qc",$con)or die("Gagal Koneksi");		
	  if(isset($_POST['availability']))  
        { 
            // Retrieving each selected option 
            foreach ($_POST['availability'] as $index => $subject1){
				   if($index>0){
					  $av1=$av1.",".$subject1; 
				   }else{
					   $av1=$subject1;
				   }	
				    
			}
        }
  	  $sqlData=mysqli_query($con,"UPDATE tbl_qcf SET 
		  `availability`='$av1',
		  `tgl_update`=now()
		  WHERE nokk='$_POST[nokk]'");	 	  
	  
		if($sqlData){
			
			echo "<script>swal({
  title: 'Data Terupdate',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
     window.open('pages/cetak/cetak_label_qcf.php?idkk=$_GET[nokk]','_blank');	
	 
	 
  }
});</script>";
		}
				
	}else if($_POST['save']=="save" AND $cek1==0){
		// $con=mysqli_connect("10.0.0.10","dit","4dm1n");
		// $db=mysqli_select_db("db_qc",$con)or die("Gagal Koneksi");
		if(isset($_POST['availability']))  
        { 
            // Retrieving each selected option 
            foreach ($_POST['availability'] as $index => $subject2){
				   if($index>0){
					  $av2=$av2.",".$subject2; 
				   }else{
					   $av2=$subject2;
				   }	
				    
			}
		}
		$no_order = mysqli_real_escape_string($con,$_POST['no_order']);
		$no_po = mysqli_real_escape_string($con,$_POST['no_po']);
		$no_hanger = mysqli_real_escape_string($con,$_POST['no_hanger']);
		$no_item = mysqli_real_escape_string($con,$_POST['no_item']);
		$pelanggan = mysqli_real_escape_string($con,$_POST['pelanggan']);
		$jenis_kain = mysqli_real_escape_string($con,$_POST['jns_kain']);
		$warna = mysqli_real_escape_string($con,$_POST['warna']);
		$no_warna = mysqli_real_escape_string($con,$_POST['no_warna']);
		$lot = mysqli_real_escape_string($con,$_POST['lot']);
		$lot_erp = mysqli_real_escape_string($con,$_POST['lot_erp']);
		$ip= $_SERVER['REMOTE_ADDR'];
  	  $sqlData1=mysqli_query($con,"INSERT INTO tbl_lbl_availability SET 
			`nokk`='$_POST[nokk]',
			`no_order`='$no_order',
			`pelanggan`='$pelanggan',
			`no_po`='$no_po',
			`no_hanger`='$no_hanger',
			`no_item`='$no_item',
			`jenis_kain`='$jenis_kain',
			`lebar`='$_POST[lebar]',
			`gramasi`='$_POST[grms]',
			`warna`='$warna',
			`no_warna`='$no_warna',
			`lot`='$lot',
			`lot_erp`='$lot_erp',
		  	`availability`='$av2',
			`ip`= '$ip',
		  	`tgl_update`=now()");	 	  
	  
		if($sqlData1){
			
			echo "<script>swal({
  title: 'Data Tersimpan',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
     window.open('pages/cetak/cetak_label_qcf.php?idkk=$_GET[nokk]','_blank');	
	 
  }
});</script>";
		}
	}else if($_POST['ubah']=="ubah" AND $cek>0 AND $cek1>0){
		if(isset($_POST['availability']))  
        { 
            // Retrieving each selected option 
            foreach ($_POST['availability'] as $index => $subject2){
				   if($index>0){
					  $av2=$av2.",".$subject2; 
				   }else{
					   $av2=$subject2;
				   }	
				    
			}
		}
		$ip= $_SERVER['REMOTE_ADDR'];
		$sqlUpdate=mysqli_query($con,"UPDATE tbl_qcf SET 
		  	`availability`='$av2',
			`lot_erp`='$_POST[lot_erp]',
			`tgl_update`=now()
			WHERE `nokk`='$_POST[nokk]'");
		$sqlUpdate1=mysqli_query($con,"UPDATE tbl_lbl_availability SET 
			`availability`='$av2',
			`lot_erp`='$_POST[lot_erp]',
			`ip`= '$ip',
			`tgl_update`=now()
			WHERE `nokk`='$_POST[nokk]'");	 	  
	  
		if($sqlUpdate){
			
			echo "<script>swal({
  title: 'Data Berhasil Diubah',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
     window.open('pages/cetak/cetak_label_qcf.php?idkk=$_GET[nokk]','_blank');	
	 
  }
});</script>";
		}
	}else if($_POST['ubah']=="ubah" AND $cek>0){
		if(isset($_POST['availability']))  
        { 
            // Retrieving each selected option 
            foreach ($_POST['availability'] as $index => $subject2){
				   if($index>0){
					  $av2=$av2.",".$subject2; 
				   }else{
					   $av2=$subject2;
				   }	
				    
			}
		}
		$ip= $_SERVER['REMOTE_ADDR'];
		$sqlUpdate=mysqli_query($con,"UPDATE tbl_qcf SET 
		  	`availability`='$av2',
			`lot_erp`='$_POST[lot_erp]',
			`tgl_update`=now()
			WHERE `nokk`='$_POST[nokk]'");	 	  
	  
		if($sqlUpdate){
			
			echo "<script>swal({
  title: 'Data Berhasil Diubah',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
     window.open('pages/cetak/cetak_label_qcf.php?idkk=$_GET[nokk]','_blank');	
	 
  }
});</script>";
		}
	}else if($_POST['ubah']=="ubah" AND $cek1>0){
		if(isset($_POST['availability']))  
        { 
            // Retrieving each selected option 
            foreach ($_POST['availability'] as $index => $subject2){
				   if($index>0){
					  $av2=$av2.",".$subject2; 
				   }else{
					   $av2=$subject2;
				   }	
				    
			}
		}
		$ip= $_SERVER['REMOTE_ADDR'];
		$sqlUpdate=mysqli_query($con,"UPDATE tbl_lbl_availability SET 
		  	`availability`='$av2',
			`lot_erp`='$_POST[lot_erp]',
			`ip`= '$ip',
			`tgl_update`=now()
			WHERE `nokk`='$_POST[nokk]'");	 	  
	  
		if($sqlUpdate){
			
			echo "<script>swal({
  title: 'Data Berhasil Diubah',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
     window.open('pages/cetak/cetak_label_qcf.php?idkk=$_GET[nokk]','_blank');	
	 
  }
});</script>";
		}
	}

?>
