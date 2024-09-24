<script type="text/javascript">
    function proses_nokk(){
        var nokk = document.getElementById("nokk").value;

        if (nokk == 0) {
            window.location.href='InputTempelBedaRoll';
        }else{
            window.location.href='InputTempelBedaRoll&'+nokk;
        }
    }

    function proses_shift() {
        var nokk    = document.getElementById("nokk").value;
        var shift = document.getElementById("shift").value;

        if (nokk == "") {
            swal({
                title: 'Nomor KK tidak boleh kosong',   
                text: 'Klik Ok untuk input data kembali',
                type: 'error'
                });
        }else if (shift == 0){
            swal({
                title: 'Shift tidak boleh kosong',   
                text: 'Klik Ok untuk input data kembali',
                type: 'error'
                });
        } else {
            window.location.href='InputTempelBedaRoll&'+nokk+'&'+shift;
        }
    }
</script>
<?php
include"koneksi.php";
ini_set("error_reporting", 1);
if($_POST['simpan']=="simpan")
{
	$ceksql=mysqli_query($con,"SELECT * FROM `tbl_tempel_beda_roll` WHERE `nokk`='$_GET[nokk]' and `shift`='$_POST[shift]' AND DATE_FORMAT(tgl_update, '%Y-%m-%d') = DATE_FORMAT(now(), '%Y-%m-%d') LIMIT 1");
    $cek=mysqli_num_rows($ceksql);
	if($cek>0){
    $pelanggan=str_replace("'","''",$_POST['pelanggan']);
    $order=str_replace("'","''",$_POST['no_order']);
    $jns=str_replace("'","''",$_POST['jenis_kain']);
    $warna=str_replace("'","''",$_POST['warna']);
    $no_warna=str_replace("'","''",$_POST['no_warna']);
    $comment=str_replace("'","''",$_POST['comment']);
	$sql1=mysqli_query($con,"UPDATE`tbl_tempel_beda_roll` SET
	`no_order`='$order',
    `no_item`='$_POST[no_item]',
    `no_hanger`='$_POST[no_hanger]',
    `no_po`='$_POST[no_po]',
	`pelanggan`='$pelanggan',
	`jenis_kain`='$jns',
	`warna`='$warna',
    `no_warna`='$no_warna',
	`lot`='$_POST[lot]',
	`groupshift`='$_POST[groupshift]',
	`roll_bruto`='$_POST[roll_bruto]',
	`bruto`='$_POST[bruto]',
	`roll_dikerjakan`='$_POST[roll_dikerjakan]',
	`ket_roll_dikerjakan`='$_POST[ket_roll_dikerjakan]',
    `operator`='$_POST[operator]',
    `lebar`='$_POST[lebar]',
    `gramasi`='$_POST[gramasi]',
    `tgl_update`=now(),
    `ip`='$_SERVER[REMOTE_ADDR]',
    `comment`='$_POST[comment]',
    `demand`='$_POST[demand]',
    `prod_order`='$_POST[prod_order]'
	WHERE `nokk`='$_POST[nokk]' and  `shift`='$_POST[shift]'");
	if($sql1){
        //echo " <script>alert('Data has been updated!');</script>";
        echo "<script>swal({
            title: 'Data has been updated!',   
            text: 'Klik Ok untuk input data kembali',
            type: 'success',
            }).then((result) => {
            if (result.value) {
                window.location.href='InputTempelBedaRoll&$_POST[nokk]';
               
            }
          });</script>";
		}
		}
    else{
    $pelanggan=str_replace("'","''",$_POST['pelanggan']);
    $order=str_replace("'","''",$_POST['no_order']);
    $jns=str_replace("'","''",$_POST['jenis_kain']);
    $warna=str_replace("'","''",$_POST['warna']);
    $no_warna=str_replace("'","''",$_POST['no_warna']);
    $catatan=str_replace("'","''",$_POST['catatan']);
	$sql=mysqli_query($con,"INSERT INTO `tbl_tempel_beda_roll` SET
	`nokk`='$_POST[nokk]',
	`no_order`='$order',
    `no_item`='$_POST[no_item]',
    `no_hanger`='$_POST[no_hanger]',
    `no_po`='$_POST[no_po]',
	`pelanggan`='$pelanggan',
	`jenis_kain`='$jns',
	`warna`='$warna',
    `no_warna`='$no_warna',
	`lot`='$_POST[lot]',
    `shift`='$_POST[shift]',
	`groupshift`='$_POST[groupshift]',
	`roll_bruto`='$_POST[roll_bruto]',
	`bruto`='$_POST[bruto]',
	`roll_dikerjakan`='$_POST[roll_dikerjakan]',
	`ket_roll_dikerjakan`='$_POST[ket_roll_dikerjakan]',
    `operator`='$_POST[operator]',
    `lebar`='$_POST[lebar]',
    `gramasi`='$_POST[gramasi]',
    `comment`='$_POST[comment]',
    `demand`='$_POST[demand]',
    `prod_order`='$_POST[prod_order]',
    `tgl_update`=now(),
    `tgl_buat`=now(),
    `ip`='$_SERVER[REMOTE_ADDR]'");
	if($sql){
        //echo " <script>alert('Data has been saved!');</script>";
        echo "<script>swal({
            title: 'Data has been saved!',   
            text: 'Klik Ok untuk input data kembali',
            type: 'success',
            }).then((result) => {
            if (result.value) {
                window.location.href='InputTempelBedaRoll&$_POST[nokk]';
               
            }
          });</script>";
		}
	}
}
?>

<?Php
if($_GET['nokk']!=""){$nokk=$_GET['nokk'];}else{$nokk=" ";}
if($_GET['shift']!=""){$shift=$_GET['shift'];}else{$shift=" ";}

//Data sudah disimpan di database mysqli
$msql=mysqli_query($con,"SELECT * FROM `tbl_tempel_beda_roll` WHERE `nokk`='$nokk' and `shift`='$_GET[shift]' AND DATE_FORMAT(tgl_update, '%Y-%m-%d') = DATE_FORMAT(now(), '%Y-%m-%d')");
$row=mysqli_fetch_array($msql);
$crow=mysqli_num_rows($msql);

//Data sudah disimpan di database mysqli
$msql1=mysqli_query($con,"SELECT * FROM `tbl_tempel_beda_roll` WHERE `nokk`='$nokk' and `shift`='$_GET[shift]' ");
$row1=mysqli_fetch_array($msql1);
$crow1=mysqli_num_rows($msql1);

//Data sudah disimpan di database mysqli
$qryfin=mysqli_query($con,"SELECT * FROM `tbl_tempel_beda_roll` WHERE `nokk`='$nokk' ORDER BY id DESC");
$rfin=mysqli_fetch_array($qryfin);
$cekfin=mysqli_num_rows($qryfin);


//Data belum disimpan di database mysqli
$sql=sqlsrv_query($conn,"select top 1
        x.*,dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight, 
        pm.Weight as Gramasi,pm.CuttableWidth as Lebar, pm.Description as ProductDesc, pm.ColorNo, pm.Color,
        dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount
        from
        (
        select
            so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PODate,
            sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.WeightUnitID, 
            soda.RefNo as DetailRefNo,jo.DocumentNo as NoOrder,soda.PONumber,
            pcb.ID as PCBID, pcb.Gross as Bruto,soda.HangerNo,pp.ProductCode,
            pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
            pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID,convert(char(20),sod.RequiredDate,120) as RequiredDate
            
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
                soda.RefNo,pcb.DocumentNo,soda.HangerNo,
                pcb.ID, pcb.DocumentNo, pcb.Gross,soda.PONumber,pp.ProductCode,
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
        $pelanggan=$r1['partnername'];
        $buyer=$r2['partnername'];
        $child=$r['ChildLevel'];
    if($nokk!=""){	
            if($child > 0){
                $sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='$r[RootID]' and ChildLevel='0'");
                $rowgp=sqlsrv_fetch_array($sqlgetparent,SQLSRV_FETCH_ASSOC);
                
                //$nomLot=substr("$row2[LotNo]",0,1);
                $nomLot=$rowgp['LotNo'];
                $nomorLot="$nomLot/K$r[ChildLevel]";				
                                    
            }else{
                $nomorLot=$r['LotNo'];
                    
            }
    
            $sqlLot1="Select count(*) as TotalLot From ProcessControlBatches where PCID='$r[PCID]' and RootID='0' and LotNo < '1000'";
            $qryLot1 = sqlsrv_query($conn,$sqlLot1) or die('A error occured : ');							
            $rowLot=sqlsrv_fetch_array($qryLot1,SQLSRV_FETCH_ASSOC);
            $lotno=$rowLot['TotalLot']."-".$nomorLot;
    }

$sqlp=mysqli_query($con,"SELECT
	no_lot,
	no_mc,
	bruto,
	sum(net_wight) AS `neto`,
	count(net_wight) AS rolb,
	count(net_wight) AS roln,
	sum(yard_) AS panjang,
	satuan,user_packing
FROM
	tbl_kite a
INNER JOIN tmp_detail_kite b ON a.nokk = b.nokkKite
WHERE
	a.nokk = '$nokk' ");
	$rp=mysqli_fetch_array($sqlp);
?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Input Data</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
    </div>
    <div class="box-body">
        <div class="col-md-6">
            <div class="form-group">
				<label for="nokk" class="col-sm-3 control-label">No Kartu Kerja</label>
                <div class="col-sm-4">
					<input name="nokk" type="text" class="form-control" id="nokk" 
					onchange="proses_nokk()" value="<?php echo $_GET['nokk'];?>" placeholder="No KK" required >
			    </div>
			</div>
            <div class="form-group">
            <label for="shift" class="col-sm-3 control-label">Shift</label>
                    <div class="col-sm-2">
                        <select class="form-control chosen-select" name="shift" required id="shift" onchange="proses_shift()">
                            <option value="0">Pilih</option>
                            <option value="1" <?php if($_GET['shift']=="1"){echo "SELECTED";}?>>1</option>
                            <option value="2" <?php if($_GET['shift']=="2"){echo "SELECTED";}?>>2</option>
                            <option value="3" <?php if($_GET['shift']=="3"){echo "SELECTED";}?>>3</option>
                        </select>
                    </div>
            </div>
            <div class="form-group">
				<label for="groupshift" class="col-sm-3 control-label">Group</label>
                    <div class="col-sm-3">
                    <?php if($crow>0){$grup=$row['groupshift'];}?>
                        <select class="form-control select2" name="groupshift" required>
                            <option value="">Pilih</option>
                            <option value="A" <?php if($grup=="A"){echo "SELECTED";}?>>A</option>
                            <option value="B" <?php if($grup=="B"){echo "SELECTED";}?>>B</option>
                            <option value="C" <?php if($grup=="C"){echo "SELECTED";}?>>C</option>
                        </select>
                    </div>
            </div>
            <div class="form-group">
                <label for="no_order" class="col-sm-3 control-label">No Order</label>
                <div class="col-sm-4">
                    <input name="no_order" type="text" class="form-control" id="no_order" value="<?php if($crow>0){echo $row['no_order'];}else{echo $r['NoOrder'];} ?>" placeholder="No Order" required/>
                </div>
            </div>
            <div class="form-group">
                <label for="pelanggan" class="col-sm-3 control-label">Pelanggan</label>
                <div class="col-sm-8">
                    <input name="pelanggan" type="text" class="form-control" id="pelanggan" 
			        value="<?php if($crow>0){echo $row['pelanggan'];}else{if($_GET['nokk']!="" and $r1['partnername']!=""){echo $r1['partnername']."/".$r2['partnername'];}}?>" placeholder="Pelanggan" >
                </div>
            </div>
            <div class="form-group">
                <label for="no_po" class="col-sm-3 control-label">PO</label>
                <div class="col-sm-4">
                    <input name="no_po" type="text" class="form-control" id="no_po" value="<?php if($crow>0){echo $row['no_po'];}else{echo $r['PONumber'];} ?>" placeholder="No Order" required/>
                </div>
            </div>
            <div class="form-group">
                <label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
                  <div class="col-sm-3">
                    <input name="no_hanger" type="text" class="form-control" id="no_hanger" 
                    value="<?php if($crow>0){echo $row['no_hanger'];}else{if($r['HangerNo']){echo $r['HangerNo'];}}?>" placeholder="No Hanger">  
                  </div>
				  <div class="col-sm-3">
				  <input name="no_item" type="text" class="form-control" id="no_item" 
                    value="<?php if($row['no_item']!=""){echo $row['no_item'];}else if($r['ProductCode']!=""){echo $r['ProductCode'];}else{if($r['HangerNo']){echo $r['HangerNo'];}}?>" placeholder="No Item">
				  </div>	
            </div>
            <div class="form-group">
                <label for="jenis_kain" class="col-sm-3 control-label">Jenis Kain</label>
                <div class="col-sm-8">
                    <textarea name="jenis_kain" class="form-control" id="jenis_kain" placeholder="Jenis Kain"><?php if($crow>0){echo $row['jenis_kain'];}else{echo stripslashes($r['ProductDesc']);}?></textarea>
                </div>
            </div>
            <div class="form-group">
			    <label for="l_g" class="col-sm-3 control-label">Lebar X Gramasi</label>
                <div class="col-sm-2">
                    <input name="lebar" type="text" class="form-control" id="lebar" 
                    value="<?php if($crow>0){echo $row['lebar'];}else{echo round($r['Lebar']);} ?>" placeholder="0" required>
                </div>
                <div class="col-sm-2">
                    <input name="gramasi" type="text" class="form-control" id="gramasi" 
                    value="<?php if($crow>0){echo $row['gramasi'];}else{echo round($r['Gramasi']);} ?>" placeholder="0" required>
                </div>		
			</div>
            <div class="form-group">
                <label for="warna" class="col-sm-3 control-label">Warna</label>
                <div class="col-sm-8">
                    <textarea name="warna" class="form-control" id="warna" placeholder="Warna"><?php if($crow>0){echo $row['warna'];}else{echo stripslashes($r['Color']);}?></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="no_warna" class="col-sm-3 control-label">No Warna</label>
                <div class="col-sm-8">
                    <textarea name="no_warna" class="form-control" id="no_warna" placeholder="No Warna"><?php if($crow>0){echo $row['no_warna'];}else{echo stripslashes($r['ColorNo']);}?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="lot" class="col-sm-3 control-label">Lot</label>
                <div class="col-sm-2">
                    <input name="lot" class="form-control" type="text" id="lot" value="<?php if($cek>0){echo $rcek['lot'];}else{if($nomorLot!=""){echo $lotno;}}?>" placeholder="Lot">
                </div>
            </div>
            <div class="form-group">
                <label for="qty_bruto" class="col-sm-3 control-label">Qty Bruto</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input name="roll_bruto" type="text" class="form-control" id="roll_bruto" value="<?php if($crow > 0){echo $row['roll_bruto'];}else{echo $rp['rolb'];}?>" placeholder="" required>
                        <span class="input-group-addon">Roll</span>
					</div>
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input name="bruto" type="text" class="form-control" id="bruto" value="<?php if($crow>0){echo $row['bruto'];}else{echo number_format($rp['bruto'],'2','.','');} ?>" placeholder="0.00" required>
                        <span class="input-group-addon">KGs</span>
					</div>
                </div>
            </div>
            <div class="form-group">
                <label for="roll_dikerjakan" class="col-sm-3 control-label">Roll Dikerjakan</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input name="roll_dikerjakan" type="text" class="form-control" id="roll_dikerjakan" value="<?php if($crow>0){echo $row['roll_dikerjakan'];}?>" placeholder="" required>
                        <span class="input-group-addon">Roll</span>
					</div>
                </div>
                <div class="col-sm-3">
                    <input name="ket_roll_dikerjakan" type="text" class="form-control" id="ket_roll_dikerjakan" value="<?php if($crow>0){echo $row['ket_roll_dikerjakan'];} ?>" placeholder="Masukkan Roll" required>
				</div>
            </div>
            <div class="form-group">
                <label for="operator" class="col-sm-3 control-label">Operator</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select class="form-control select2" name="operator" id="operator">
                                <option value="">Pilih</option>
                                <?php 
                                $qryo=mysqli_query($con,"SELECT nama FROM tbl_operator ORDER BY nama ASC");
                                while($ro=mysqli_fetch_array($qryo)){
                                ?>
                                <option value="<?php echo $ro['nama'];?>" <?php if($row['operator']==$ro['nama']){echo "SELECTED";}?>><?php echo $ro['nama'];?></option>	
                                <?php }?>
                            </select>
                            <span class="input-group-btn"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#DataOperator"> ...</button></span>
						</div>
                    </div>
            </div>
            <div class="form-group">
                <label for="prod_order" class="col-sm-3 control-label">No Production Order</label>
                <div class="col-sm-4">
                    <input name="prod_order" type="text" class="form-control" id="prod_order" value="<?php if($crow>0){echo $row['prod_order'];} ?>" placeholder="No Production Order" required/>
                </div>
            </div>
            <div class="form-group">
                <label for="demand" class="col-sm-3 control-label">No Demand</label>
                <div class="col-sm-4">
                    <input name="demand" type="text" class="form-control" id="demand" value="<?php if($crow>0){echo $row['demand'];} ?>" placeholder="No Demand" required/>
                </div>
            </div>
            <div class="form-group">
                <label for="comment" class="col-sm-3 control-label">Comments</label>
                <div class="col-sm-8">
                    <textarea name="comment" class="form-control" id="comment" placeholder="Comments"><?php echo $row['comment'];?></textarea>  
                </div>				   
            </div>
        </div>
    </div>
    <div class="box-footer">
            <?php if($_GET['nokk']!="" and $_GET['shift']!="" and $cek==0){ ?>
            <button type="submit" class="btn btn-primary pull-right" name="simpan" value="simpan"><i class="fa fa-save"></i> Simpan</button> 
            <?php }else if($_GET['nokk']!="" and $_GET['shift']!="" and $cek>0){?>
            <button type="submit" class="btn btn-primary pull-right" name="ubah" value="ubah"><i class="fa fa-edit"></i> Ubah</button>
            <?php } ?>
            <button type="button" class="btn btn-warning pull-left" name="lihat" value="lihat" onClick="window.location.href='LihatTempelBedaRoll'"><i class="fa fa-search"></i> Lihat Data</button> 	   
    </div>
</div>
</form>
<div class="modal fade" id="DataOperator">
          <div class="modal-dialog ">
            <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Operator</h4>
              </div>
              <div class="modal-body">
                  <input type="hidden" id="id" name="id">
                  <div class="form-group">
                  <label for="operator" class="col-md-3 control-label">Nama Operator</label>
                  <div class="col-md-6">
                  <input type="text" class="form-control" id="operator" name="operator" required>
                  <span class="help-block with-errors"></span>
                  </div>
                  </div>		    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<input type="submit" value="Simpan" name="simpan_operator" id="simpan_operator" class="btn btn-primary pull-right" >  
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div>
<?php 
if($_POST['simpan_operator']=="Simpan"){
	$nama=strtoupper($_POST['operator']);
	$sqlData1=mysqli_query($con,"INSERT INTO tbl_operator SET 
		  nama='$nama'");
	if($sqlData1){	
	echo "<script>swal({
  title: 'Data Telah Tersimpan',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
         window.location.href='InputTempelBedaRoll-$nokk';
	 
  }
});</script>";
		}
}
?>
