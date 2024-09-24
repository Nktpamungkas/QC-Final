<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'PHPMailer/vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

ini_set("error_reporting", 1);
session_start();
include"koneksi.php";
$nokk=$_GET['nokk'];
$sql=sqlsrv_query($conn,"select top 1
			x.*,dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight, 
			pm.Weight as Gramasi,pm.CuttableWidth as Lebar, pm.Description as ProductDesc, pm.ColorNo, pm.Color,
      dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PODate, so.SalesPersonName,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,jo.DocumentNo as NoOrder,soda.PONumber,
				pcb.ID as PCBID, pcb.Gross as Bruto,soda.HangerNo,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID,convert(char(20),sod.RequiredDate,120) as RequiredDate
				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID left join
				ProcessControlBatchesLastPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
			where pcb.DocumentNo='$nokk' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,so.SalesPersonName,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,soda.HangerNo,
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
	where
		pcjo.PCID = '$r[PCID]'
group by ko.KONo");
					$rKO=sqlsrv_fetch_array($ko);
					
$child=$r['ChildLevel'];
	if($nokk!=""){	
		if($child > 0){
			$sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='$r[RootID]' and ChildLevel='0'");
			$rowgp=sqlsrv_fetch_array($sqlgetparent);
			
			//$nomLot=substr("$row2[LotNo]",0,1);
			$nomLot=$rowgp['LotNo'];
			$nomorLot="$nomLot/K$r[ChildLevel]&nbsp;";				
								
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
$sqlpack=mysqli_query($con,"SELECT
	tgl_mulai,jml_netto,netto,panjang,satuan
FROM
	`tbl_lap_inspeksi`
WHERE
	`nokk` = '$nokk'
AND `dept` = 'PACKING'
ORDER BY id DESC LIMIT 1");
			$sPack=mysqli_fetch_array($sqlpack);
		$sqlinsp=mysqli_query($con,"SELECT
	tgl_update,jml_netto,netto,panjang
FROM
	`tbl_lap_inspeksi`
WHERE
	`nokk` = '$nokk'
AND `dept` = 'INSPEK MEJA'
ORDER BY id ASC LIMIT 1");
			$sInsp=mysqli_fetch_array($sqlinsp);
$sqlwarna=mysqli_query($con,"SELECT
	tgl_update,`status`
FROM
	`tbl_lap_inspeksi`
WHERE
	`nokk` = '$nokk'
AND `dept` = 'QCF'
ORDER BY id DESC LIMIT 1");
			$sWarna=mysqli_fetch_array($sqlwarna);
}
$sqlCek=mysqli_query($con,"SELECT * FROM tbl_qcf WHERE nokk='$nokk' LIMIT 1");
$cek=mysqli_num_rows($sqlCek);
$rcek=mysqli_fetch_array($sqlCek);
$sqlManual=mysqli_query($con,"SELECT * FROM tbl_lap_inspeksi WHERE nokk='$nokk' LIMIT 1");
$cekM=mysqli_fetch_array($sqlManual);
$sqlD=mysqli_query($con,"SELECT GROUP_CONCAT(CONCAT(persen, '%') SEPARATOR '; ') as persen, GROUP_CONCAT(dept SEPARATOR '; ') as dept FROM tbl_qcf_detail WHERE id_qcf='$rcek[id]'");
$rcekd=mysqli_fetch_array($sqlD);
?>	
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1">
 <div class="box box-info">
   <div class="box-header with-border">
    <h3 class="box-title">Input Data Kartu Kerja Ambil Kain Jadi</h3>
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
                     onchange="window.location='InputDataKJ-'+this.value" value="<?php echo $_GET['nokk'];?>" placeholder="No KK" required >
		  </div>
                </div>
	           <div class="form-group">
                  <label for="no_order" class="col-sm-3 control-label">No Order</label>
                  <div class="col-sm-4">
                    <input name="no_order" type="text" class="form-control" id="no_order" 
                    value="<?php if($cek>0){echo $rcek['no_order'];}else{if($r['NoOrder']!=""){echo $r['NoOrder'];}else if($nokk!=""){echo $cekM['no_order'];}} ?>" placeholder="No Order" required>
                  </div>				   
                </div>
	           <div class="form-group">
                  <label for="no_po" class="col-sm-3 control-label">PO</label>
                  <div class="col-sm-5">
                    <input name="no_po" type="text" class="form-control" id="no_po" 
                    value="<?php if($cek>0){echo $rcek['no_po'];}else{if($r['PONumber']!=""){echo $r['PONumber'];}else if($nokk!=""){echo $cekM['no_po'];}} ?>" placeholder="PO" >
                  </div>				   
                </div>
		 		<div class="form-group">
                  <label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
                  <div class="col-sm-3">
                    <input name="no_hanger" type="text" class="form-control" id="no_hanger" 
                    value="<?php if($cek>0){echo $rcek['no_hanger'];}else{if($r['HangerNo']){echo $r['HangerNo'];}else if($nokk!=""){echo $cekM['no_item'];}}?>" placeholder="No Hanger">  
                  </div>
				  <div class="col-sm-3">
				  <input name="no_item" type="text" class="form-control" id="no_item" 
                    value="<?php if($rcek['no_item']!=""){echo $rcek['no_item'];}else if($r['ProductCode']!=""){echo $r['ProductCode'];}else{if($r['HangerNo']){echo $r['HangerNo'];}else if($nokk!=""){echo $cekM['no_item'];}}?>" placeholder="No Item">
				  </div>	
                </div>
	            <div class="form-group">
                  <label for="jns_kain" class="col-sm-3 control-label">Jenis Kain</label>
                  <div class="col-sm-8">
					  <textarea name="jns_kain" class="form-control" id="jns_kain" placeholder="Jenis Kain"><?php if($cek>0){echo $rcek['jenis_kain'];}else{if($r['ProductDesc']!=""){echo $r['ProductDesc'];}else if($nokk!=""){ echo $cekM['jenis_kain']; } }?></textarea>
					  </div>
                  </div>
		        <div class="form-group">
                  <label for="styl" class="col-sm-3 control-label">Style</label>
                  <div class="col-sm-8">
                    <input name="styl" type="text" class="form-control" id="styl" 
                    value="<?php if($cek>0){echo $rcek['styl'];} ?>" placeholder="Style">
                  </div>				   
                </div>
		    <div class="form-group">
                  <label for="qty_order" class="col-sm-3 control-label">Qty Order</label>
                  <div class="col-sm-3">
					<div class="input-group">  
                    <input name="qty1" type="text" class="form-control" id="qty1" 
                    value="<?php if($cek>0){echo $rcek['berat_order'];}else{echo round($r['BatchQuantity'],2);} ?>" placeholder="0.00" required>
					  <span class="input-group-addon">KGs</span></div>  
                  </div>
				  <div class="col-sm-4">
					<div class="input-group">  
                    <input name="qty2" type="text" class="form-control" id="qty2" 
                    value="<?php if($cek>0){echo $rcek['panjang_order'];}else{echo round($r['Quantity'],2);} ?>" placeholder="0.00" style="text-align: right;" required>
                    <span class="input-group-addon">
							  <select name="satuan1" style="font-size: 12px;">
								  <option value="Yard" <?php if($r['UnitID']=="21"){ echo "SELECTED"; }?>>Yard</option>
								  <option value="Meter" <?php if($r['UnitID']=="10"){ echo "SELECTED"; }?>>Meter</option>
								  <option value="PCS" <?php if($r['UnitID']=="1"){ echo "SELECTED"; }?>>PCS</option>
							  </select>
					    </span>
					</div>	
                  </div>		
                </div>
		 		<div class="form-group">
                  <label for="jml_bruto" class="col-sm-3 control-label">Jml Bruto</label>
                  <div class="col-sm-2">
                    <input name="qty3" type="text" class="form-control" id="qty3" 
                    value="<?php if($cek>0){echo $rcek['rol_bruto'];}else{if($r['RollCount']!=""){echo round($r['RollCount']);}else if($nokk!=""){echo $cekM['jml_roll'];}} ?>" placeholder="0.00" required>
                  </div>
				  <div class="col-sm-3">
					<div class="input-group">  
                    <input name="qty4" type="text" class="form-control" id="qty4" 
                    value="<?php if($cek>0){echo $rcek['berat_bruto'];}else{if($r['Weight']!=""){echo round($r['Weight'],2);}else if($nokk!=""){echo $cekM['bruto'];}} ?>" placeholder="0.00" style="text-align: right;" required>
                    <span class="input-group-addon">KGs</span>
					</div>	
                  </div>		
                </div>
		 		<div class="form-group">
                  <label for="l_g" class="col-sm-3 control-label">Lebar X Gramasi</label>
                  <div class="col-sm-2">
                    <input name="lebar" type="text" class="form-control" id="lebar" 
                    value="<?php if($cek>0){echo $rcek['lebar'];}else{echo round($r['Lebar']);} ?>" placeholder="0" required>
                  </div>
				  <div class="col-sm-2">
                    <input name="grms" type="text" class="form-control" id="grms" 
                    value="<?php if($cek>0){echo $rcek['gramasi'];}else{echo round($r['Gramasi']);} ?>" placeholder="0" required>
                  </div>		
                </div>
		 		<div class="form-group">
                  <label for="warna" class="col-sm-3 control-label">Warna</label>
                  <div class="col-sm-8">
                    <textarea name="warna" class="form-control" id="warna" placeholder="Warna"><?php if($cek>0){echo $rcek['warna'];}else{if($r['Color']!=""){echo $r['Color'];}else if($nokk!=""){ echo $cekM['warna'];} }?></textarea>
                  </div>				   
                </div>
		 		<div class="form-group">
                  <label for="no_warna" class="col-sm-3 control-label">No Warna</label>
                  <div class="col-sm-8">
                    <textarea name="no_warna" class="form-control" id="no_warna" placeholder="No Warna"><?php if($cek>0){echo $rcek['no_warna'];}else{if($r['ColorNo']!=""){echo $r['ColorNo'];}else if($nokk!=""){echo $cekM['no_warna'];}}?></textarea>
                  </div>				   
                </div>
				<div class="form-group">
                  <label for="sales" class="col-sm-3 control-label">Sales Person</label>
                  <div class="col-sm-8">
                    <input name="sales" type="text" class="form-control" id="sales" 
                    value="<?php if($cek>0 AND $rcek['sales']!=NULL){echo $rcek['sales'];}else if($r['SalesPersonName']!=""){echo $r['SalesPersonName'];} ?>" placeholder="Sales" readonly>
                  </div>				   
                </div>
		 		
	  </div>
	  		<!-- col --> 
	  <div class="col-md-6">
	 <div class="form-group">
                  <label for="lot" class="col-sm-3 control-label">Lot</label>
                  <div class="col-sm-2">
                    <input name="lot" type="text" class="form-control" id="lot" 
                    value="<?php if($cek>0){echo $rcek['lot'];}else{if($nomorLot!=""){echo $lotno;}else if($nokk!=""){echo $cekM['lot'];} } ?>" placeholder="Lot" >
                  </div>				   
                </div>
		 		<div class="form-group">
                  <label for="rol" class="col-sm-3 control-label">Rol</label>
                  <div class="col-sm-2">
                    <input name="rol" type="text" class="form-control" id="rol" 
                    value="<?php if($cek>0){echo $rcek['rol'];}else{if($sPack['jml_netto']!="" or $sInsp['jml_netto']!=""){echo $sPack['jml_netto']+$sInsp['jml_netto'];}else if($nokk!=""){echo $cekM['jml_netto'];}}?>" placeholder="0" >
                  </div>			   
                </div>
		 		<div class="form-group">
                  <label for="netto" class="col-sm-3 control-label">Netto</label>
                  <div class="col-sm-3">
					<div class="input-group">  
                    <input name="netto" type="text" class="form-control" id="netto" 
                    value="<?php if($cek>0){echo $rcek['netto'];}else{if($sPack['netto']!="" or $sInsp['netto']!=""){echo $sPack['netto']+$sInsp['netto'];}else if($nokk!=""){echo $cekM['netto'];}}?>" placeholder="0.00" style="text-align: right;" >
					<span class="input-group-addon">KG</span>
					</div>		
                  </div>				   
                </div>
		 		<div class="form-group">
                  <label for="panjang" class="col-sm-3 control-label">Panjang</label>
                  <div class="col-sm-4">
					  <div class="input-group">
                    <input name="panjang" type="text" class="form-control" id="panjang" 
                    value="<?php if($cek>0){echo $rcek['panjang'];}else{echo $sPack['panjang'];}?>" placeholder="0.00" style="text-align: right;" required>
						  <span class="input-group-addon">
							  <select name="satuan2" style="font-size: 12px;">
								  <option value="Yard" <?php if($sPack['satuan']=="Yard"){ echo "SELECTED"; }?>>Yard</option>
								  <option value="Meter" <?php if($sPack['satuan']=="Meter"){ echo "SELECTED"; }?>>Meter</option>
								  <option value="PCS" <?php if($sPack['satuan']=="PCS"){ echo "SELECTED"; }?>>PCS</option>
							  </select>
					    </span></div>
					  </div>
                  </div>	  
	  <div class="form-group">
                  <label for="sisa" class="col-sm-3 control-label">Sisa</label>
                  <div class="col-sm-3">
					<div class="input-group">  
                    <input name="sisa" type="text" class="form-control" id="sisa" 
                    value="<?php if($cek>0){echo $rcek['sisa'];}?>" placeholder="0.00" style="text-align: right;" >
					<span class="input-group-addon">KG</span>
					</div>		
                  </div>				   
      </div>
	  
	  <div class="form-group">
        <label for="tglmsk" class="col-sm-3 control-label">Tgl Masuk</label>
        <div class="col-sm-4">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="tglmsk" type="text" class="form-control pull-right" id="datepicker3" placeholder="0000-00-00" value="<?php if($cek>0){echo $rcek['tgl_masuk'];}?>" required/>
          </div>
        </div>
	  </div>
	        <div class="form-group">
                  <label for="cekwarna" class="col-sm-3 control-label">Cek Warna</label>
                  <div class="col-sm-8">
                    <textarea name="cekwarna" class="form-control" id="cekwarna" placeholder="Cek Warna"><?php if($cek>0){echo $rcek['cek_warna'];}else{echo $sWarna['status']." ".$sWarna['tgl_update'];} ?></textarea>  
                  </div>				   
                </div>
		    <div class="form-group">
                  <label for="extra" class="col-sm-3 control-label">Extra</label>
                  <div class="col-sm-3">
					<div class="input-group">  
                    <input name="extra" type="text" class="form-control" id="extra" 
                    value="<?php if($cek>0){echo $rcek['berat_extra'];}?>" placeholder="0.00" style="text-align: right;" >
					<span class="input-group-addon">KG</span>
					</div>		
                  </div>	
				<div class="col-sm-4">
					  <div class="input-group">
                    <input name="extra_p" type="text" class="form-control" id="extra_p" 
                    value="<?php if($cek>0){echo $rcek['panjang_extra'];}?>" placeholder="0.00" style="text-align: right;" required>
						  <span class="input-group-addon">
							  <select name="satuan1" style="font-size: 12px;">
								  <option value="Yard" <?php if($sPack['satuan']=="Yard"){ echo "SELECTED"; }?>>Yard</option>
								  <option value="Meter" <?php if($sPack['satuan']=="Meter"){ echo "SELECTED"; }?>>Meter</option>
								  <option value="PCS" <?php if($sPack['satuan']=="PCS"){ echo "SELECTED"; }?>>PCS</option>
							  </select>
					    </span></div>
					  </div>
                </div>
		  <div class="form-group">
                  <label for="estimasi" class="col-sm-3 control-label">Estimasi</label>
                  <div class="col-sm-3">
					<div class="input-group">  
                    <input name="estimasi" type="text" class="form-control" id="estimasi" 
                    value="<?php if($cek>0){echo $rcek['estimasi'];}?>" placeholder="0.00" style="text-align: right;" >
					<span class="input-group-addon">KG</span>
					</div>		
                  </div>
			      <div class="col-sm-4">
					  <div class="input-group">
                    <input name="estimasi_p" type="text" class="form-control" id="estimasi_p" 
                    value="<?php if($cek>0){echo $rcek['panjang_estimasi'];}?>" placeholder="0.00" style="text-align: right;" required>
						  <span class="input-group-addon">
							  <select name="satuan_est" style="font-size: 12px;">
								  <option value="Yard" <?php if($sPack['satuan_est']=="Yard"){ echo "SELECTED"; }?>>Yard</option>
								  <option value="Meter" <?php if($sPack['satuan_est']=="Meter"){ echo "SELECTED"; }?>>Meter</option>
								  <option value="PCS" <?php if($sPack['satuan_est']=="PCS"){ echo "SELECTED"; }?>>PCS</option>
							  </select>
					    </span></div>
					  </div>
					  <?php if($cek>0){ ?><a href="DetailDataKJ-<?php echo $rcek['id'];?>"><i class="btn btn-success">Detail</i> </a> <?php } ?>
                </div>
			<div class="form-group">
					<label for="t_jawab" class="col-sm-3 control-label">Dept. Tanggung Jawab</label>
					<div class="col-sm-8">
					<select class="form-control select2" multiple="multiple" data-placeholder="Dept. Tanggung Jawab" name="t_jawab[]" id="t_jawab">
						<?php
						$dtArr=$rcek['t_jawab'];	
						$data = explode(",",$dtArr);
						$qCek1=mysqli_query($con,"SELECT nama FROM tbl_dept ORDER BY nama ASC");
						$i=0;	
						while($dCek1=mysqli_fetch_array($qCek1)){ ?>
						<option value="<?php echo $dCek1['nama'];?>" <?php if($dCek1['nama']==$data[0] or $dCek1['nama']==$data[1] or $dCek1['nama']==$data[2] or $dCek1['nama']==$data[3] or $dCek1['nama']==$data[4] or $dCek1['nama']==$data[5]){echo "SELECTED";} ?>><?php echo $dCek1['nama'];?></option>
						<?php $i++;} ?>              
					</select>
					</div>
				</div>
				<div class="form-group">
                  <label for="persen" class="col-sm-3 control-label">% Dept. Tanggung Jawab</label>
                  <div class="col-sm-8">
                    <input name="persen" type="text" class="form-control" id="persen" 
                    value="<?php if($cek>0){echo $rcek['persen'];} ?>" placeholder="Contoh: 50,30,20,...(Pemisah Koma dan Tanpa %)">
                  </div>				   
                </div>
				<div class="form-group">
					<label for="sts_pbon" class="col-sm-3 control-label"></label>		  
					<div class="col-sm-4">
						<input type="checkbox" name="sts_pbon" id="sts_pbon" value="1" <?php  if($rcek['sts_pbon']=="1"){ echo "checked";} ?>>  
						<label> Bon Penghubung</label>
					</div>
				</div>
				<div class="form-group">
					<label for="sts_nodelay" class="col-sm-3 control-label"></label>		  
						<div class="col-sm-4">
						<input type="checkbox" name="sts_nodelay" id="sts_nodelay" value="1" <?php  if($rcek['sts_nodelay']=="1"){ echo "checked";} ?>>  
							<label> Tidak Delay</label>
						</div>
        		</div>
				<div class="form-group">
					<label for="sts_tembakdok" class="col-sm-3 control-label"></label>		  
						<div class="col-sm-4">
						<input type="checkbox" name="sts_tembakdok" id="sts_tembakdok" value="1" <?php  if($rcek['sts_tembakdok']=="1"){ echo "checked";} ?>>  
							<label> Tembak Dokumen</label>
						</div>
        		</div>		
		  <div class="form-group">
                  <label for="ket" class="col-sm-3 control-label">Ket</label>
                  <div class="col-sm-8">
                    <textarea name="ket" class="form-control" id="ket" placeholder="Keterangan"><?php if($cek>0){ echo $rcek['ket'];}?></textarea>  
                  </div>				   
          </div>
		  <div class="form-group">
                  <label for="masalah" class="col-sm-3 control-label">Masalah</label>
                  <div class="col-sm-7">
				  <textarea name="masalah" class="form-control" id="masalah" placeholder="Masalah"><?php if($cek>0){ echo $rcek['masalah'];}?></textarea>  
                  </div><?php if($cek>0){ ?>	   
   <a href="#" data-toggle="modal" data-target="#myModal"><i class="btn btn-info pull-right">Send to Email</i> </a></button>
   <?php } ?>				   
          </div>
		  <input type="hidden" value="<?php if($cek>0){echo $rcek['pelanggan'];}else{echo $pelanggan;}?>" name="pelanggan">
		  <input type="hidden" value="<?php if($cek>0){echo $rcek['no_ko'];}else{echo $rKO['KONo'];}?>" name="no_ko">
		  <input type="hidden" value="<?php if($cek>0){echo $rcek['tgl_delivery'];}else{echo date('Y-m-d', strtotime($r['RequiredDate']));}?>" name="tgl_delivery">
	<div class="form-group">
	 	<label for="lot_erp_qcf" class="col-sm-3 control-label">Lot ERP</label>
			<div class="col-sm-2">
                <input name="lot_erp_qcf" type="text" class="form-control" id="lot_erp_qcf" 
                value="<?php if($cek>0){echo $rcek['lot_erp_qcf'];} ?>" placeholder="Lot ERP" >
                </div>	
	 </div>
	 <div class="form-group">
        <label for="demand" class="col-sm-3 control-label">Demand ERP</label>
			<div class="col-sm-2">
            	<input name="demand" type="text" class="form-control" id="demand" 
                value="<?php if($cek>0){echo $rcek['demand'];} ?>" placeholder="Demand ERP" >
            </div>				   
    </div>
	 </div>
	 
	
</div>	 
   <div class="box-footer">
   <?php if($cek>0){ ?>
   <button type="submit" class="btn btn-primary pull-right" name="update" value="update">Ubah <i class="fa fa-edit"></i></button>
   <?php }else{ ?>	   
   <button type="submit" class="btn btn-primary pull-right" name="save" value="save">Simpan <i class="fa fa-save"></i></button> 
   <?php } ?>
   
   </div>
    <!-- /.box-footer -->
  




</div>
</form>
<div class="modal fade modal-3d-slit" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%;">
				<form action="" method="post" enctype="multipart/form-data" name="form2">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Email</h4>
						
                    </div>
                    <div class="modal-body">
						
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject:" name="subjek" required>
			</div>
			<div class="form-group">
                <input type="text" class="form-control" placeholder="Subject:" name="subjek" required>
			</div>
			<div class="form-group">				
                <input type="email"  class="form-control" name="untuk" placeholder="Email:">
			</div>
			<div class="form-group">
                <input type="email"  class="form-control" name="untuk1" placeholder="Email:">
			</div>
			<div class="form-group">
                <input type="email"  class="form-control" name="untuk2" placeholder="Email:">
			</div>				
			<div class="form-group">			
				<div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" name="ckqc" checked required> Dept QC
                      </label>&nbsp;&nbsp;&nbsp;
            	      <label>
                        <input type="checkbox" value="1" name="ckfin"> Dept Fin
                      </label>&nbsp;&nbsp;&nbsp;
					  <label>
                      <input type="checkbox" value="1" name="ckbrs"> Dept Brs
                      </label>&nbsp;&nbsp;&nbsp;					  
					  <label>
                        <input type="checkbox" value="1" name="ckdye"> Dept Dye
                      </label>&nbsp;&nbsp;&nbsp;
					  <label>
                      <input type="checkbox" value="1" name="ckprt"> Dept Prt
                      </label>&nbsp;&nbsp;&nbsp;
					  <label>
                        <input type="checkbox" value="1" name="ckknt"> Dept Knt
                      </label>&nbsp;&nbsp;&nbsp;
					  <label>
                        <input type="checkbox" value="1" name="ckrmp"> Dept Rmp
                      </label>&nbsp;&nbsp;&nbsp;
					  <label>
                        <input type="checkbox" value="1" name="ckbun"> Bun Bun Team
                      </label>&nbsp;&nbsp;&nbsp;
					  <label>
                        <input type="checkbox" value="1" name="ckheri"> Heri Team
                      </label>&nbsp;&nbsp;&nbsp;
					  <!--<label>
                        <input type="checkbox" value="1" name="ckpolo"> Polo Team
                      </label>&nbsp;&nbsp;&nbsp;-->
					  <label>
                        <input type="checkbox" value="1" name="ckleading"> Nia Team
                      </label>&nbsp;&nbsp;&nbsp;
					  <label>
                        <input type="checkbox" value="1" name="cklulu"> Frans Team
                      </label>&nbsp;&nbsp;&nbsp;
					  <label>
                        <input type="checkbox" value="1" name="ckadidas1"> 
                        Adidas Team
                      </label>&nbsp;&nbsp;&nbsp;
					  <label>
                        <input name="ckadidas2" type="checkbox" value="1"> Adidas (Sample) Team
                      </label>&nbsp;&nbsp;&nbsp;
					  <!--<label>
                        <input name="ckadidas3" type="checkbox" disabled="disabled" value="1"> Adidas3 Team
                      </label>-->
					  	
            	</div>
			</div>			
              <div class="form-group">
                    <textarea id="editor1" name="editor1" rows="10" cols="80" class="form-control"><p>Dear mkt team,</p>
<p>Mohon di tindak lanjuti untuk  cek stock ataupun ganti kain dengan departement terkait </p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Ditunggu feedbacknya segera </p>
<p>&nbsp;</p>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="723" nowrap colspan="4" valign="bottom"><p align="center"><u>BON PENGHUBUNG LANGGANAN PT. INDO    TAICHEN</u></p></td>
  </tr>
  <tr>
    <td width="723" nowrap valign="bottom"><p>NO. BPP</p></td>
    <td width="723" nowrap valign="bottom"><p align="right"><?php echo $rcek['bpp'];?></p></td>
    <td width="723" nowrap valign="bottom"><p>LOT </p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['lot'];?></p></td>
  </tr>
  <tr>
    <td width="723" nowrap valign="bottom"><p>CUSTOMER</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['pelanggan'];?></p></td>
    <td width="723" nowrap valign="bottom"><p>UKURAN </p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['lebar']."X".$rcek['gramasi'];?></p></td>
  </tr>
  <tr>
    <td width="723" nowrap valign="bottom"><p>PO</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['no_po'];?></p></td>
    <td width="723" nowrap valign="bottom"><p>ROLL</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['rol_mslh'];?></p></td>
  </tr>
  <tr>
    <td width="723" nowrap valign="bottom"><p>ORDER</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['no_order'];?></p></td>
    <td width="723" nowrap valign="bottom"><p>QTY</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['qty_mslh'];?></p></td>
  </tr>
  <tr>
    <td width="723" valign="top" nowrap><p>JENIS KAIN</p></td>
    <td width="723" valign="top" nowrap><p><?php echo $rcek['jenis_kain'];?></p></td>
    <td width="723" nowrap valign="bottom"><p>PABRIK RAJUT</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['no_ko'];?></p></td>
  </tr>
  <tr>
    <td width="723" valign="top" nowrap>ITEM</td>
    <td width="723" valign="top" nowrap><?php echo $rcek['no_item'];?></td>
    <td width="723" nowrap valign="bottom"><p>DELIVERY KAIN    JADI</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['tgl_delivery'];?></p></td>
  </tr>
  <tr>
    <td width="723" nowrap valign="bottom"><p>WARNA</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['warna'];?></p></td>
    <td width="723" nowrap valign="bottom"><p>DEPT PENANGGUNG JWB</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcekd['dept'];?></p></td>
  </tr>
  <tr>
    <td width="723" nowrap valign="bottom"><p>NO WARNA</p></td>
    <td width="723" nowrap valign="bottom"><p><?php echo $rcek['no_warna'];?></p></td>
    <td nowrap valign="bottom">PERSENTASE</td>
    <td nowrap valign="bottom"><?php echo $rcekd['persen'];?></td>
  </tr>
  <tr>
    <td width="723" valign="top" nowrap><p>MASALAH KAIN</p>      <p>&nbsp;</p>      <p>&nbsp;</p>      <p>&nbsp;</p>      <p>&nbsp;</p>      <p align="center">&nbsp;</p>      <p align="center">&nbsp;</p></td>
    <td width="723" colspan="2" valign="top"><p align="center"><?php echo $rcek['masalah'];?></p></td>
    <td width="723" valign="top"><p align="center">&nbsp;</p>      <p align="center">&nbsp;</p>      <p align="center">&nbsp;</p>      <p>&nbsp;</p>      <p>&nbsp;</p>      <p align="center">&nbsp;</p>      <p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td nowrap colspan="4"><p>&nbsp;</p>      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td nowrap valign="bottom">FOC</td>
    <td colspan="3" valign="bottom" nowrap><?php if($rcek['berat_extra']!="0.00"){echo $rcek['berat_extra']." KG ";} if($rcek['panjang_extra']!="0.00"){echo $rcek['panjang_extra']." ".$rcek['satuan'];;} ?></td>
  </tr>
  <tr>
    <td nowrap valign="bottom">Estimasi</td>
    <td colspan="3" valign="bottom" nowrap><?php if($rcek['estimasi']!="0.00"){echo $rcek['estimasi']." KG ";}
	if($rcek['panjang_estimasi']!="0.00"){echo $rcek['panjang_estimasi']." ".$rcek['satuan'];} ?></td>
  </tr>
  <tr>
    <td nowrap colspan="4" valign="bottom"><p><strong>&nbsp;</strong></p>      <p>&nbsp;</p></td>
  </tr>
 
</table>
<p>&nbsp;</p>
<p><strong>Thanks &amp; b&rsquo;regards</strong><br>
  <strong>Tenny/aisyah</strong></p></textarea>
              </div>
						
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                 <button type="submit" class="btn btn-success pull-right" name="send" value="send">Send <i class="fa fa-envelope-o"></i></button>
              </div>
             </div>
            <!-- /.box-footer -->
          </div>
					</form>
          <!-- /. box -->
	</div>	
        </div>    
						
                    </div>
                </div>
            </div>
        </div> 

<?php 
if($_POST['send']=="send"){
$ket=str_replace("'","''",$_POST['ket']);
//require 'PHPMailer/PHPMailerAutoload.php';
//$mail = new PHPMailer;
// Konfigurasi SMTP
$mail->isSMTP();
	$mail->Host 		= 'mail.indotaichen.com'; //mail.usmanas.web.id / mail.indotaichen.com
	$mail->SMTPAuth 	= true;
	$mail->Username 	= 'qcf.adm@indotaichen.com'; //usman@usmanas.web.id / dept.it@indotaichen.com
	$mail->Password 	= 'Final.1234567'; //fariz001 / D1t2017
	$mail->SMTPSecure 	= PHPMailer::ENCRYPTION_SMTPS;
	$mail->Port 		= 465;

$mail->setFrom('qcf.adm@indotaichen.com', 'adm qcf');
$mail->addReplyTo('qcf.adm@indotaichen.com', 'adm qcf');

// Menambahkan penerima
//$mail->addAddress($_POST['untuk']);

// Menambahkan beberapa penerima
//$mail->addAddress('penerima2@contoh.com');
//$mail->addAddress('penerima3@contoh.com');
// Menambahkan cc atau bcc 
//$cc=str_replace("'","''",$_POST[cc]);		

if($_POST['ckqc']=="1"){
	$mail->addAddress('qcf.adm@indotaichen.com');
	$mail->addCC('qcf.aftersale@indotaichen.com');
	$mail->addCC('qcf.clerk.aftersales@indotaichen.com');
	$mail->addCC('agung.cahyono@indotaichen.com');
	$mail->addCC('arif.efendi@indotaichen.com');
	$mail->addCC('ayen.qcf@indotaichen.com');
	$mail->addCC('yohana.hantari@indotaichen.com');
	$mail->addCC('putri.damayanti@indotaichen.com');
	$qc="[Team QC]";
}else{$qc="";}
if($_POST['ckfin']=="1"){
	$mail->addCC('yayan.tri.budi@indotaichen.com');
	$mail->addCC('indra.cahya@indotaichen.com');
	$fin="[Team FIN]";
}else{$fin="";}	
if($_POST['ckdye']=="1"){
	$mail->addCC('nyoman.parta@indotaichen.com');
	$mail->addCC('gusti.ketut@indotaichen.com');
	$mail->addCC('mucharom.mustofa@indotaichen.com');
	$dye="[Team DYE]";
}else{$dye="";}
if($_POST['ckprt']=="1"){
	$mail->addCC('produksi.printing@indotaichen.com');
	$mail->addCC('staff.printing@indotaichen.com');
	$mail->addCC('rujito.printing@indotaichen.com');
	$prt="[Team PRT]";
}else{$prt="";}
if($_POST['ckrmp']=="1"){
	$mail->addCC('angela@indotaichen.com');
	$mail->addCC('ikhsan.hidayat@indotaichen.com');
	$rmp="[Team RMP]";
}else{$rmp="";}
if($_POST['ckknt']=="1"){
	$mail->addCC('lucia.chen@indotaichen.com');
	$mail->addCC('prambudi.knt@indotaichen.com');
	$knt="[Team KNT]";
}else{$knt="";}
if($_POST['ckbrs']=="1"){
	$mail->addCC('brs.admin@indotaichen.com');
	$mail->addCC('edih.maulana@indotaichen.com');
	$mail->addCC('brs.staff@indotaichen.com');
	$mail->addCC('indra.brs@indotaichen.com');
	$brs="[Team Brushing]";
}else{$brs="";}	
//mkt	
/*if($_POST['ckbun']=="1"){
	$mail->addCC('bunbun.kui@indotaichen.com');
	$mail->addCC('septian.saputra@indotaichen.com');
	$mail->addCC('ronny.masroni@indotaichen.com');
	$bun="[Team Bun Bun]";
}else{$bun="";}	*/
if($_POST['ckheri']=="1"){
	$mail->addCC('heri.bahtiar@indotaichen.com');
	$mail->addCC('citrasari.andadari@indotaichen.com');
	$mail->addCC('septian.saputra@indotaichen.com');
	$heri="[Team Heri]";
}else{$heri="";}
if($_POST['ckpolo']=="1"){
	$mail->addCC('ronny.masroni@indotaichen.com');
	$mail->addCC('nia.wuri@indotaichen.com');
	$polo="[Team Polo]";
}else{$polo="";}
if($_POST['cklulu']=="1"){
	$mail->addCC('gilang.kurnia@indotaichen.com');
	$mail->addCC('frans.subrata@indotaichen.com');
	$mail->addCC('septian.saputra@indotaichen.com');
	$mail->addCC('darien.limarga@indotaichen.com');
	$mail->addCC('fransiska.amelia@indotaichen.com');
	$mail->addCC('bunbun.kui@indotaichen.com');
	$lulu="[Team Frans]";
}else{$lulu="";}
if($_POST['ckleading']=="1"){
	$mail->addCC('deden.wijaya@indotaichen.com');
	$mail->addCC('nia.wuri@indotaichen.com');
	$mail->addCC('aditya.rangga@indotaichen.com');
	/*$mail->addCC('didik.hermanto@indotaichen.com');*/
	$mail->addCC('septian.saputra@indotaichen.com');
	$mail->addCC('ronny.masroni@indotaichen.com');
	$leading="[Team Nia]";
}else{$leading="";}
if($_POST['ckadidas1']=="1"){
	$mail->addCC('yohanes.pribadi@indotaichen.com');
	$mail->addCC('ahmad.fahrurrozi@indotaichen.com');
	$mail->addCC('ridwan.setiawan@indotaichen.com');
	$mail->addCC('budiman.mkt@indotaichen.com');
	$mail->addCC('richard.asi@indotaichen.com');
	$mail->addCC('didik.hermanto@indotaichen.com');
	$mail->addCC('suci.kurniawati@indotaichen.com');
	$mail->addCC('bambang.susiyanto@indotaichen.com');
	$mail->addCC('dennis.septian@indotaichen.com');
	$mail->addCC('levia.zhuang@indotaichen.com');
	$mail->addCC('kevin.noventin@indotaichen.com');
	$add1="[Team Addidas]";
}else{$add1="";}
if($_POST['ckadidas2']=="1"){
	$mail->addCC('yohanes.pribadi@indotaichen.com');
	$mail->addCC('richard.asi@indotaichen.com');
	$mail->addCC('didik.hermanto@indotaichen.com');	
	$mail->addCC('ridwan.setiawan@indotaichen.com');
	$mail->addCC('ikhsan.ikhwana@indotaichen.com');	
	$mail->addCC('levia.zhuang@indotaichen.com');
	$add2="[Team Addidas(Sample)]";
}else{$add2="";}
if($_POST['ckadidas3']=="1"){
	//$mail->addCC('suci.kurniawati@indotaichen.com');
	//$mail->addCC('yohanes.pribadi@indotaichen.com');
	//$mail->addCC('richard.asi@indotaichen.com');
$add3="[Team Addidas3]";
}else{$add3="";}	
$mail->addCC($_POST['untuk']);
$mail->addCC($_POST['untuk1']);
$mail->addCC($_POST['untuk2']);	
//$mail->addBCC('usmanas.as@gmail.com');

// Subjek email
$mail->Subject = ''.$_POST['subjek'].'';

// Mengatur format email ke HTML
$mail->isHTML(true);

// Konten/isi email
$mailContent =''.$_POST['editor1'].'';
$mail->Body = $mailContent;

// Menambahakn lampiran
//$mail->addAttachment('lmp/file1.pdf');
//$mail->addAttachment('lmp/file2.png', 'nama-baru-file2.png'); //atur nama baru

// Kirim email
if(!$mail->send()){
    echo 'Pesan tidak dapat dikirim.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	
}else{
    // echo 'Pesan telah terkirim';
	$isi=str_replace("'","''",$_POST['editor1']);
	$kirim=$qc.$rmp.$knt.$prt.$brs.$rmp.$dye.$fin.$bun.$heri.$polo.$leading.$lulu.$add1.$add2.$add3." ".$_POST['untuk']." ".$_POST['untuk1']." ".$_POST['untuk2'];
	$sqlmail=mysqli_query($con,"INSERT INTO tbl_email_bon SET
	no_bon='$rcek[bpp]',
	isi='$isi',
	kirim_ke='$kirim',
	tgl_kirim=now(),
	jam_kirim=now()");
}
	}
function nobon(){
		include"koneksi.php";
		date_default_timezone_set("Asia/Jakarta");
		$format = date("y");
		$sql=mysqli_query($con,"SELECT bpp FROM tbl_qcf WHERE DATE_FORMAT(tgl_masuk,'%Y')=DATE_FORMAT(now(),'%Y')
		ORDER BY bpp DESC LIMIT 1") or die (mysqli_error());
		$d=mysqli_num_rows($sql);
		if($d>0){
			$r=mysqli_fetch_array($sql);
			$d=$r['bpp'];
			$str=substr($d,2,5);
			$Urut = (int)$str;
		}else{
			$Urut = 0;
		}
		$Urut = $Urut + 1;
		$Nol="";
		$nilai=5-strlen($Urut);
		for ($i=1;$i<=$nilai;$i++){
			$Nol= $Nol."0";
		}
		$nipbr =$format.$Nol.$Urut;
		return $nipbr;
}
$nou=nobon();
	if($_POST['save']=="save"){
	  $warna=str_replace("'","''",$_POST['warna']);
	  $nowarna=str_replace("'","''",$_POST['no_warna']);	
	  $jns=str_replace("'","''",$_POST['jns_kain']);
	  $styl=str_replace("'","''",$_POST['styl']);
	  $sales=str_replace("'","''",$_POST['sales']);	
	  $po=str_replace("'","''",$_POST['no_po']);
	  $masalah=str_replace("'","''",$_POST['masalah']);
	  $cekwarna=str_replace("'","''",$_POST['cekwarna']);
	  $ket1=str_replace("'","''",$_POST['ket']);
	  $lot=trim($_POST['lot']);
	  $t_jawab=$_POST['t_jawab'];
	  $multijawab="";
	  $persen=$_POST['persen'];
	  foreach($t_jawab as $t_jawab1)  
   		{  
      		$multijawab .= $t_jawab1.",";  
		}
		if($_POST['sts_pbon']=="1"){$sts_pbon="1";
		//email

	//require 'PHPMailer/PHPMailerAutoload.php';
	//$mail = new PHPMailer;
	// Konfigurasi SMTP
	$mail->isSMTP();
	$mail->Host 		= 'mail.indotaichen.com'; //mail.usmanas.web.id / mail.indotaichen.com
	$mail->SMTPAuth 	= true;
	$mail->Username 	= 'qcf.adm@indotaichen.com'; //usman@usmanas.web.id / dept.it@indotaichen.com
	$mail->Password 	= 'Final.1234567'; //fariz001 / D1t2017
	$mail->SMTPSecure 	= PHPMailer::ENCRYPTION_SMTPS;
	$mail->Port 		= 465;
	
	$mail->setFrom('qcf.adm@indotaichen.com', 'adm qcf');
	$mail->addReplyTo('qcf.adm@indotaichen.com', 'adm qcf');

	//$mail->addAddress('yohana.hantari@indotaichen.com');
	//$mail->addAddress('putri.damayanti@indotaichen.com');
// Menambahkan penerima
if($_POST['sales']=="Rangga Aditya"){
	$mail->addAddress('aditya.rangga@indotaichen.com');
}else if($_POST['sales']=="Budiman"){
	$mail->addAddress('budiman.mkt@indotaichen.com');
}else if($_POST['sales']=="Nia"){
	$mail->addAddress('nia.wuri@indotaichen.com');
}else if($_POST['sales']=="Bunbun"){
	$mail->addAddress('bunbun.kui@indotaichen.com');
}else if($_POST['sales']=="Heri"){
	$mail->addAddress('heri.bahtiar@indotaichen.com');
	$mail->addAddress('vany.leany@indotaichen.com');
}else if($_POST['sales']=="Vany Leany"){
	$mail->addAddress('vany.leany@indotaichen.com');
	$mail->addAddress('heri.bahtiar@indotaichen.com');
}else if($_POST['sales']=="Roni"){
	$mail->addAddress('ronny.masroni@indotaichen.com');
}else if($_POST['sales']=="Deden"){
	$mail->addAddress('deden.wijaya@indotaichen.com');
}else if($_POST['sales']=="Suci"){
	$mail->addAddress('suci.kurniawati@indotaichen.com');
}else if($_POST['sales']=="Richard"){
	$mail->addAddress('richard.asi@indotaichen.com');
}else if($_POST['sales']=="Yohanes"){
	$mail->addAddress('yohanes.pribadi@indotaichen.com');
}else if($_POST['sales']=="Ridwan"){
	$mail->addAddress('ridwan.setiawan@indotaichen.com');
}else if($_POST['sales']=="Frans"){
	$mail->addAddress('frans.subrata@indotaichen.com');
}else if($_POST['sales']=="Bambang"){
	$mail->addAddress('bambang.susiyanto@indotaichen.com');
}else if($_POST['sales']=="Fahrurrozi"){
	$mail->addAddress('ahmad.fahrurrozi@indotaichen.com');
}else if($_POST['sales']=="Gilang Kurnia"){
	$mail->addAddress('gilang.kurnia@indotaichen.com');
}else if($_POST['sales']=="Citrasari"){
	$mail->addAddress('citrasari.andadari@indotaichen.com');
}else if($_POST['sales']=="Fransiska"){
	$mail->addAddress('fransiska.amelia@indotaichen.com');
}else if($_POST['sales']=="Dennis"){
	$mail->addAddress('dennis.septian@indotaichen.com');
}else if($_POST['sales']=="Levia Zhuang"){
	$mail->addAddress('levia.zhuang@indotaichen.com');
}else if($_POST['sales']=="Besly"){
	$mail->addAddress('besly.immanuel@indotaichen.com');
	$mail->addAddress('bunbun.kui@indotaichen.com');
}else if($_POST['sales']=="Darien"){
	$mail->addAddress('darien.limarga@indotaichen.com');
}else if($_POST['sales']=="Ikhsan Ikhwana"){
	$mail->addAddress('ikhsan.ikhwana@indotaichen.com');
}else if($_POST['sales']==" Kevin Noventin"){
	$mail->addAddress('kevin.noventin@indotaichen.com');
}else if($_POST['sales']=="Alvin"){
	$mail->addAddress('alvin.christian@indotaichen.com');
}else if($_POST['sales']=="Thania"){
	$mail->addAddress('thania.marshella@indotaichen.com');
}else if($_POST['sales']=="Vivian"){
	$mail->addAddress('viviani.marsela@indotaichen.com');
}else if($_POST['sales']=="Vernanda"){
	$mail->addAddress('vernanda.olivia@indotaichen.com');
}else if($_POST['sales']=="Aldo Joshua"){
	$mail->addAddress('aldo.joshua@indotaichen.com');
}else if($_POST['sales']=="Krisna Chandra"){
	$mail->addAddress('krisna.chandra@indotaichen.com');
}else if($_POST['sales']=="Jonathan"){
	$mail->addAddress('jonathan.handito@indotaichen.com');
}else if($_POST['sales']=="Manuella Beatrice"){
	$mail->addAddress('manuella.beatrice@indotaichen.com');
}else if($_POST['sales']=="Gabriella Halim"){
	$mail->addAddress('gabriella.halim@indotaichen.com');
}else if($_POST['sales']=="Kefas"){
	$mail->addAddress('kefas.jose@indotaichen.com');
}else if($_POST['sales']=="Yesaya Wijaya"){
	$mail->addAddress('yesaya.wijaya@indotaichen.com');
}else if($_POST['sales']=="Emerline"){
	$mail->addAddress('emerline.valia@indotaichen.com');
}else if($_POST['sales']=="Rendy Suryana"){
	$mail->addAddress('rendy.suryana@indotaichen.com');
}

if(strpos($_POST['pelanggan'],'ADIDAS') !== false){
	//$mail->addAddress('yohanes.pribadi@indotaichen.com');
	$mail->addAddress('bambang.susiyanto@indotaichen.com');
	$mail->addAddress('ridwan.setiawan@indotaichen.com');
}
//$mail->addAddress('fanny.ardiansyah@indotaichen.com');
//$mail->addAddress('usman.as@indotaichen.com');

 // Subjek email
 $mail->Subject = 'BON PENGHUBUNG LANGGANAN PT. INDO TAICHEN '.$_POST['nokk'];

 // Mengatur format email ke HTML
 $mail->isHTML(true);

 // Konten/isi email
 $mailContent ='<div class="container">

	<div class="row">
		<div class="col-12">
		<p>Dear MKT team,</p>
		<p>Mohon di tindak lanjuti untuk bon penghubung berikut </p>
		<p>&nbsp;</p>
			<table style="font-family: Helvetica,Arial,sans-serif; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6" border="1" cellspacing="0" cellpadding="0">
				<tbody><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap colspan="4">
						<p>BON PENGHUBUNG LANGGANAN PT. INDO TAICHEN <a href="http://10.0.0.10/qc-final/ProsesBonMKT-'.$_POST['nokk'].'" target="_blank">'.$_POST['nokk'].'</a> </p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>NO. BPP</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$nou.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>LOT</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$lot.'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>CUSTOMER</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$_POST['pelanggan'].'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>UKURAN</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['lebar'].'X'.$_POST['grms'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>PO</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$po.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>ROLL</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['rol_mslh'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>ORDER</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$_POST['no_order'].'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>QTY</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['qty_mslh'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>JENIS KAIN</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$jns.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>PABRIK RAJUT</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['no_ko'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>ITEM</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$_POST['no_item'].'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>DELIVERY KAIN    JADI</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['tgl_delivery'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>WARNA</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$warna.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>DEPT PENANGGUNG JWB</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$multijawab.'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>NO WARNA</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$nowarna.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>PERSENTASE</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$persen.'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>MASALAH KAIN</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" colspan="3">
						<p>'.$masalah.'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>FOC</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" colspan="3" nowrap>
						<p align="right">'.$_POST['extra'].' KG '.$_POST['extra_p'].' '.$_POST['satuan2'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>Estimasi</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" colspan="3" nowrap>
						<p align="right">'.$_POST['estimasi'].' KG '.$_POST['estimasi_p'].' '.$_POST['satuan2'].'</p>
						</td>
					</tr>
				</tbody>
			</table>
			<p>&nbsp;</p>
			<p><strong>Thanks &amp; b&rsquo;regards</strong><br>
			<strong>Tenny/aisyah</strong></p>
		</div>
	</div>
</div>';
 $mail->Body = $mailContent;
 // Kirim email
 if(!$mail->send()){
	//echo 'Pesan tidak dapat dikirim.';
	//echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "<script>swal({
  title: 'Mailer Error:',   
  text: 'Pesan tidak dapat dikirim',
  type: 'warning',
  }).then((result) => {
  if (result.value) {
	
	 window.location.href='InputDataRev'; 
  }
});</script>";
	
}else{
	// echo 'Pesan telah terkirim';
}
		}else{ $sts_pbon="0";}
		if($_POST['sts_nodelay']=="1"){$sts_nodelay="1";}else{ $sts_nodelay="0";}	
		if($_POST['sts_tembakdok']=="1"){$sts_tembakdok="1";}else{ $sts_tembakdok="0";}
  	  $sqlData=mysqli_query($con,"INSERT INTO tbl_qcf SET
	  	  bpp='$nou',
		  nokk='$_POST[nokk]',
		  pelanggan='$_POST[pelanggan]',
		  no_order='$_POST[no_order]',
		  no_hanger='$_POST[no_hanger]',
		  no_item='$_POST[no_item]',
		  no_po='$po',
		  no_ko='$_POST[no_ko]',
		  jenis_kain='$jns',
		  styl='$styl',
		  berat_order='$_POST[qty1]',
		  panjang_order='$_POST[qty2]',
		  satuan_order='$_POST[satuan1]',
		  rol_bruto='$_POST[qty3]',
		  berat_bruto='$_POST[qty4]',
		  lebar='$_POST[lebar]',
		  gramasi='$_POST[grms]',
		  berat_extra='$_POST[extra]',
		  panjang_extra='$_POST[extra_p]',
		  estimasi='$_POST[estimasi]',
		  panjang_estimasi='$_POST[estimasi_p]',
		  lot='$lot',
		  rol='$_POST[rol]',
		  warna='$warna',
		  no_warna='$nowarna',
		  cek_warna='$cekwarna',
		  netto='$_POST[netto]',
		  panjang='$_POST[panjang]',
		  satuan='$_POST[satuan2]',
		  sisa='$_POST[sisa]',
		  tgl_masuk='$_POST[tglmsk]',
		  tgl_delivery='$_POST[tgl_delivery]',
		  qty_mslh='$_POST[qty_mslh]',
		  rol_mslh='$_POST[rol_mslh]',
		  t_jawab='$multijawab',
		  persen='$persen',
		  sts_pbon='$sts_pbon',
		  sts_nodelay='$sts_nodelay',
		  sts_tembakdok='$sts_tembakdok',
		  masalah='$masalah',
		  ket='$ket1',
		  sales='$sales',
		  lot_erp_qcf='$_POST[lot_erp_qcf]',
		  demand='$_POST[demand]',
		  tgl_update=now()");	 	  
	  
		if($sqlData){
			// echo "<script>alert('Data Tersimpan');</script>";
			// echo "<script>window.location.href='?p=Input-Data-KJ;</script>";
			echo "<script>swal({
  title: 'Data Tersimpan',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
    
	 window.location.href='InputDataKJ'; 
  }
});</script>";
		}
		
			
	}
    if($_POST['update']=="update"){
	  $warna=str_replace("'","''",$_POST['warna']);
	  $nowarna=str_replace("'","''",$_POST['no_warna']);	
	  $jns=str_replace("'","''",$_POST['jns_kain']);
	  $styl=str_replace("'","''",$_POST['styl']);	
	  $sales=str_replace("'","''",$_POST['sales']);	
	  $po=str_replace("'","''",$_POST['no_po']);
	  $masalah=str_replace("'","''",$_POST['masalah']);
	  $cekwarna=str_replace("'","''",$_POST['cekwarna']);
	  $ket1=str_replace("'","''",$_POST['ket']);
	  $lot=trim($_POST['lot']);
	  $t_jawab=$_POST['t_jawab'];
	  $multijawab="";
	  $persen=$_POST['persen'];
	  foreach($t_jawab as $t_jawab1)  
   		{  
      		$multijawab .= $t_jawab1.",";  
		}
		if($_POST['sts_pbon']=="1"){$sts_pbon="1";
		//email
	//require 'PHPMailer/PHPMailerAutoload.php';
	//$mail = new PHPMailer;
	// Konfigurasi SMTP
	$mail->isSMTP();
	$mail->Host 		= 'mail.indotaichen.com'; //mail.usmanas.web.id / mail.indotaichen.com
	$mail->SMTPAuth 	= true;
	$mail->Username 	= 'qcf.adm@indotaichen.com'; //usman@usmanas.web.id / dept.it@indotaichen.com
	$mail->Password 	= 'Final.1234567'; //fariz001 / D1t2017
	$mail->SMTPSecure 	= PHPMailer::ENCRYPTION_SMTPS;
	$mail->Port 		= 465;
	
	$mail->setFrom('qcf.adm@indotaichen.com', 'adm qcf');
	$mail->addReplyTo('qcf.adm@indotaichen.com', 'adm qcf');

// Menambahkan penerima
//$mail->addAddress('yohana.hantari@indotaichen.com');
//$mail->addAddress('putri.damayanti@indotaichen.com');
if($_POST['sales']=="Rangga Aditya"){
	$mail->addAddress('aditya.rangga@indotaichen.com');
}else if($_POST['sales']=="Budiman"){
	$mail->addAddress('budiman.mkt@indotaichen.com');
}else if($_POST['sales']=="Nia"){
	$mail->addAddress('nia.wuri@indotaichen.com');
}else if($_POST['sales']=="Bunbun"){
	$mail->addAddress('bunbun.kui@indotaichen.com');
}else if($_POST['sales']=="Heri"){
	$mail->addAddress('heri.bahtiar@indotaichen.com');
	$mail->addAddress('vany.leany@indotaichen.com');
}else if($_POST['sales']=="Vany Leany"){
	$mail->addAddress('vany.leany@indotaichen.com');
	$mail->addAddress('heri.bahtiar@indotaichen.com');
}else if($_POST['sales']=="Roni"){
	$mail->addAddress('ronny.masroni@indotaichen.com');
}else if($_POST['sales']=="Deden"){
	$mail->addAddress('deden.wijaya@indotaichen.com');
}else if($_POST['sales']=="Suci"){
	$mail->addAddress('suci.kurniawati@indotaichen.com');
}else if($_POST['sales']=="Richard"){
	$mail->addAddress('richard.asi@indotaichen.com');
}else if($_POST['sales']=="Yohanes"){
	$mail->addAddress('yohanes.pribadi@indotaichen.com');
}else if($_POST['sales']=="Ridwan"){
	$mail->addAddress('ridwan.setiawan@indotaichen.com');
}else if($_POST['sales']=="Frans"){
	$mail->addAddress('frans.subrata@indotaichen.com');
}else if($_POST['sales']=="Bambang"){
	$mail->addAddress('bambang.susiyanto@indotaichen.com');
}else if($_POST['sales']=="Fahrurrozi"){
	$mail->addAddress('ahmad.fahrurrozi@indotaichen.com');
}else if($_POST['sales']=="Gilang Kurnia"){
	$mail->addAddress('gilang.kurnia@indotaichen.com');
}else if($_POST['sales']=="Citrasari"){
	$mail->addAddress('citrasari.andadari@indotaichen.com');
}else if($_POST['sales']=="Fransiska"){
	$mail->addAddress('fransiska.amelia@indotaichen.com');
}else if($_POST['sales']=="Dennis"){
	$mail->addAddress('dennis.septian@indotaichen.com');
}else if($_POST['sales']=="Levia Zhuang"){
	$mail->addAddress('levia.zhuang@indotaichen.com');
}else if($_POST['sales']=="Besly"){
	$mail->addAddress('besly.immanuel@indotaichen.com');
	$mail->addAddress('bunbun.kui@indotaichen.com');
}else if($_POST['sales']=="Darien"){
	$mail->addAddress('darien.limarga@indotaichen.com');
}else if($_POST['sales']=="Ikhsan Ikhwana"){
	$mail->addAddress('ikhsan.ikhwana@indotaichen.com');
}else if($_POST['sales']==" Kevin Noventin"){
	$mail->addAddress('kevin.noventin@indotaichen.com');
}else if($_POST['sales']=="Alvin"){
	$mail->addAddress('alvin.christian@indotaichen.com');
}else if($_POST['sales']=="Thania"){
	$mail->addAddress('thania.marshella@indotaichen.com');
}else if($_POST['sales']=="Vivian"){
	$mail->addAddress('viviani.marsela@indotaichen.com');
}else if($_POST['sales']=="Vernanda"){
	$mail->addAddress('vernanda.olivia@indotaichen.com');
}else if($_POST['sales']=="Aldo Joshua"){
	$mail->addAddress('aldo.joshua@indotaichen.com');
}else if($_POST['sales']=="Krisna Chandra"){
	$mail->addAddress('krisna.chandra@indotaichen.com');
}else if($_POST['sales']=="Jonathan"){
	$mail->addAddress('jonathan.handito@indotaichen.com');
}else if($_POST['sales']=="Manuella Beatrice"){
	$mail->addAddress('manuella.beatrice@indotaichen.com');
}else if($_POST['sales']=="Gabriella Halim"){
	$mail->addAddress('gabriella.halim@indotaichen.com');
}else if($_POST['sales']=="Kefas"){
	$mail->addAddress('kefas.jose@indotaichen.com');
}else if($_POST['sales']=="Yesaya Wijaya"){
	$mail->addAddress('yesaya.wijaya@indotaichen.com');
}else if($_POST['sales']=="Emerline"){
	$mail->addAddress('emerline.valia@indotaichen.com');
}else if($_POST['sales']=="Rendy Suryana"){
	$mail->addAddress('rendy.suryana@indotaichen.com');
}

if(strpos($_POST['pelanggan'],'ADIDAS') !== false){
	//$mail->addAddress('yohanes.pribadi@indotaichen.com');
	$mail->addAddress('bambang.susiyanto@indotaichen.com');
	$mail->addAddress('ridwan.setiawan@indotaichen.com');
}
//$mail->addAddress('fanny.ardiansyah@indotaichen.com');
//$mail->addAddress('usman.as@indotaichen.com');

 // Subjek email
 $mail->Subject = 'BON PENGHUBUNG LANGGANAN PT. INDO TAICHEN '.$_POST['nokk'];

 // Mengatur format email ke HTML
 $mail->isHTML(true);

 // Konten/isi email
 $mailContent ='<div class="container">

	<div class="row">
		<div class="col-12">
		<p>Dear MKT team,</p>
		<p>Mohon di tindak lanjuti untuk bon penghubung berikut </p>
		<p>&nbsp;</p>
			<table style="font-family: Helvetica,Arial,sans-serif; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6" border="1" cellspacing="0" cellpadding="0">
				<tbody><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap colspan="4">
						<p>BON PENGHUBUNG LANGGANAN PT. INDO TAICHEN <a href="http://10.0.0.10/qc-final/ProsesBonMKT-'.$_POST['nokk'].'" target="_blank">'.$_POST['nokk'].'</a> </p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>NO. BPP</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$nou.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>LOT</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$lot.'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>CUSTOMER</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$_POST['pelanggan'].'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>UKURAN</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['lebar'].'X'.$_POST['grms'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>PO</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$po.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>ROLL</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['rol_mslh'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>ORDER</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$_POST['no_order'].'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>QTY</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['qty_mslh'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>JENIS KAIN</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$jns.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>PABRIK RAJUT</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['no_ko'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>ITEM</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$_POST['no_item'].'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>DELIVERY KAIN    JADI</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$_POST['tgl_delivery'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>WARNA</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$warna.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>DEPT PENANGGUNG JWB</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$multijawab.'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>NO WARNA</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p align="right">'.$nowarna.'</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>PERSENTASE</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>'.$persen.'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>MASALAH KAIN</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" colspan="3">
						<p>'.$masalah.'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>FOC</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" colspan="3" nowrap>
						<p align="right">'.$_POST['extra'].' KG '.$_POST['extra_p'].' '.$_POST['satuan2'].'</p>
						</td>
					</tr>
					<tr style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" nowrap>
						<p>Estimasi</p>
						</td>
						<td class="content-block aligncenter" style="font-family:  Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top" colspan="3" nowrap>
						<p align="right">'.$_POST['estimasi'].' KG '.$_POST['estimasi_p'].' '.$_POST['satuan2'].'</p>
						</td>
					</tr>
				</tbody>
			</table>
			<p>&nbsp;</p>
			<p><strong>Thanks &amp; b&rsquo;regards</strong><br>
			<strong>Tenny/aisyah</strong></p>
		</div>
	</div>
</div>';
 $mail->Body = $mailContent;
 // Kirim email
 if(!$mail->send()){
	//echo 'Pesan tidak dapat dikirim.';
	//echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "<script>swal({
  title: 'Mailer Error:',   
  text: 'Pesan tidak dapat dikirim',
  type: 'warning',
  }).then((result) => {
  if (result.value) {
	
	 window.location.href='InputDataRev'; 
  }
});</script>";
	
}else{
	// echo 'Pesan telah terkirim';
}
		}else{ $sts_pbon="0";}
		if($_POST['sts_nodelay']=="1"){$sts_nodelay="1";}else{ $sts_nodelay="0";}	
		if($_POST['sts_tembakdok']=="1"){$sts_tembakdok="1";}else{ $sts_tembakdok="0";}		
  	  $sqlData=mysqli_query($con,"UPDATE tbl_qcf SET 
		  
		  pelanggan='$_POST[pelanggan]',
		  no_order='$_POST[no_order]',
		  no_hanger='$_POST[no_hanger]',
		  no_item='$_POST[no_item]',
		  no_po='$po',
		  no_ko='$_POST[no_ko]',
		  jenis_kain='$jns',
		  styl='$styl',
		  berat_order='$_POST[qty1]',
		  panjang_order='$_POST[qty2]',
		  satuan_order='$_POST[satuan1]',
		  rol_bruto='$_POST[qty3]',
		  berat_bruto='$_POST[qty4]',
		  lebar='$_POST[lebar]',
		  gramasi='$_POST[grms]',
		  berat_extra='$_POST[extra]',
		  panjang_extra='$_POST[extra_p]',
		  estimasi='$_POST[estimasi]',
		  panjang_estimasi='$_POST[estimasi_p]',
		  lot='$lot',
		  rol='$_POST[rol]',
		  warna='$warna',
		  no_warna='$nowarna',
		  cek_warna='$cekwarna',
		  netto='$_POST[netto]',
		  panjang='$_POST[panjang]',
		  satuan='$_POST[satuan2]',
		  sisa='$_POST[sisa]',
		  tgl_masuk='$_POST[tglmsk]',
		  tgl_delivery='$_POST[tgl_delivery]',
		  qty_mslh='$_POST[qty_mslh]',
		  rol_mslh='$_POST[rol_mslh]',
		  t_jawab='$multijawab',
		  persen='$persen',
		  sts_pbon='$sts_pbon',
		  sts_nodelay='$sts_nodelay',
		  sts_tembakdok='$sts_tembakdok',
		  masalah='$masalah',
		  ket='$ket1',
		  sales='$sales',
		  lot_erp_qcf='$_POST[lot_erp_qcf]',
		  demand='$_POST[demand]',
		  tgl_update=now()
		  WHERE nokk='$_POST[nokk]'");	 	  
	  
		if($sqlData){
			// echo "<script>alert('Data Telah Diubah');</script>";
			// echo "<script>window.location.href='?p=Input-Data-KJ;</script>";
			echo "<script>swal({
  title: 'Data Telah DiUbah',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
    
	 window.location.href='InputDataKJ'; 
  }
});</script>";
		}
		
			
	}
?>
