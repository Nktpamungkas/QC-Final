<style>
input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
 
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
<script>
	
function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
</script>
<?php
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";
$nokk=$_GET['nokk'];
$no_test=$_GET['no_test'];
//$notest= isset($_POST['no_test']) ? $_POST['no_test'] : '';
//$sqlCek=mysqli_query("SELECT * FROM tbl_tq_nokk WHERE nokk='$nokk' and no_test='$notest' ORDER BY id DESC LIMIT 1");
//$cek=mysqli_num_rows($sqlCek);
//$rcek=mysqli_fetch_array($sqlCek);
$qryNoKK=mysqli_query($con,"SELECT * FROM tbl_tq_nokk WHERE no_test='$no_test'");
$NoKKcek=mysqli_num_rows($qryNoKK); 
$rNoKK=mysqli_fetch_array($qryNoKK);
$pos=strpos($rNoKK['pelanggan'], "/");
$posbuyer=substr($rNoKK['pelanggan'],$pos+1,50);
$buyer=str_replace("'","''",$posbuyer);
$langganan=substr($rNoKK['pelanggan'],0,$pos);
?>	
<?php 
$sqlCek1=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',fc_note,ph_note, abr_note, bas_note, dry_note, fla_note, fwe_note, fwi_note, burs_note,repp_note,wick_note,wick_note,absor_note,apper_note,fiber_note,pillb_note,pillm_note,pillr_note,thick_note,growth_note,recover_note,stretch_note,sns_note,snab_note,snam_note,snap_note,wash_note,water_note,acid_note,alkaline_note,crock_note,phenolic_note,cm_printing_note,cm_dye_note,light_note,light_pers_note,saliva_note,h_shrinkage_note,fibre_note) AS note_g FROM tbl_tq_test WHERE id_nokk='$rNoKK[id]' ORDER BY id DESC LIMIT 1");
$cek1=mysqli_num_rows($sqlCek1);
$rcek1=mysqli_fetch_array($sqlCek1);
$sqlCekR=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',rfc_note,rph_note, rabr_note, rbas_note, rdry_note, rfla_note, rfwe_note, rfwi_note, rburs_note,rrepp_note,rwick_note,rabsor_note,rapper_note,rfiber_note,rpillb_note,rpillm_note,rpillr_note,rthick_note,rgrowth_note,rrecover_note,rstretch_note,rsns_note,rsnab_note,rsnam_note,rsnap_note,rwash_note,rwater_note,racid_note,ralkaline_note,rcrock_note,rphenolic_note,rcm_printing_note,rcm_dye_note,rlight_note,rlight_pers_note,rsaliva_note,rh_shrinkage_note,rfibre_note) AS rnote_g FROM tbl_tq_randomtest WHERE no_item='$rNoKK[no_item]' OR no_hanger='$rNoKK[no_hanger]'");
$cekR=mysqli_num_rows($sqlCekR);
$rcekR=mysqli_fetch_array($sqlCekR);
$sqlCekD=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',dfc_note,dph_note, dabr_note, dbas_note, ddry_note, dfla_note, dfwe_note, dfwi_note, dburs_note,drepp_note,dwick_note,dabsor_note,dapper_note,dfiber_note,dpillb_note,dpillm_note,dpillr_note,dthick_note,dgrowth_note,drecover_note,dstretch_note,dsns_note,dsnab_note,dsnam_note,dsnap_note,dwash_note,dwater_note,dacid_note,dalkaline_note,dcrock_note,dphenolic_note,dcm_printing_note,dcm_dye_note,dlight_note,dlight_pers_note,dsaliva_note,dh_shrinkage_note,dfibre_note) AS dnote_g FROM tbl_tq_disptest WHERE id_nokk='$rNoKK[id]' ORDER BY id DESC LIMIT 1");
$cekD=mysqli_num_rows($sqlCekD);
$rcekD=mysqli_fetch_array($sqlCekD);

if($_POST['update']=="update"){
    $file_vbg = $_FILES['pic_vbg']['name'];
    // ambil data file
	$namaFile_vbg = $_FILES['pic_vbg']['name'];
    $namaSementara_vbg = $_FILES['pic_vbg']['tmp_name'];
    // tentukan lokasi file akan dipindahkan
	$dirUpload = "dist/img-visualbrand/";
	// pindahkan file
    $terupload_cover = move_uploaded_file($namaSementara_vbg, $dirUpload.$namaFile_vbg);
    $sqlKK=mysqli_query($con,"UPDATE tbl_tq_nokk SET
	`pic_vbg`='$file_vbg',
    `season`='$_POST[season]',
    `style`='$_POST[style]'
	WHERE `id`='$rNoKK[id]'");

	if($sqlKK){
			echo "<script>swal({
		title: 'Data KK Berhasil di Update',   
		text: 'Klik Ok untuk input data kembali',
		type: 'success',
		}).then((result) => {
		if (result.value) {
			
			window.location.href='ReportNew-$rNoKK[no_test]'; 
		}
		});</script>";
	}
}
?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form0" id="form0">
 <div class="box box-success" style="width: 98%;">
   <div class="box-header with-border">
    <h3 class="box-title">Report Adidas</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <?php if($rcek1['status']=="" and $no_test!=""){?>
  <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-info"></i> Informasi</h4>

        <p>Tidak dapat cetak laporan karena masih terdapat test yang belum selesai. <br>
        Periksa kembali test tersebut.</p>
      </div>
  <?php } ?>
  
  <div class="box-body"> 
	 <div class="col-md-6">
	  <!--	 
	  <div class="form-group">
		  <label for="no_order" class="col-sm-3 control-label">No Order</label>
		  <div class="col-sm-4">
			<input name="no_order" type="text" class="form-control" id="no_order" 
			value="" placeholder="No Order">
		  </div>				   
		</div>	 
      -->
                    <div class="form-group">
                        <label for="no_test" class="col-sm-3 control-label">No Test</label>
                        <div class="col-sm-5">
                            <div class="input-group">	  
                                <input name="no_test" type="text" class="form-control" id="no_test" 
                                    onchange="window.location='ReportNew-'+this.value" onBlur="window.location='ReportNew-'+this.value" value="<?php if($_GET['no_test']!=""){echo $_GET['no_test'];}?>" placeholder="No Test" required >
                                <span class="input-group-addon"><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-arrow-circle-right"></i> </a></span>
				            </div>	  
		                </div>
                    </div> 
                    <?php if($no_test!=""){ ?> 
                    <div class="form-group">
                    <label for="nokk" class="col-sm-3 control-label">No KK</label>
                    <div class="col-sm-5">
                        <?php 
                        ?>
                        <input name="no_order" type="text" class="form-control" id="no_order" placeholder="No Order" 
                            value="<?php if($NoKKcek>0){echo $rNoKK['nokk'];}?>" readonly="readonly">
                    </div>				   
                    </div>
                    <div class="form-group">
                            <label for="no_order" class="col-sm-3 control-label">No Order</label>
                            <div class="col-sm-4">
                                <input name="no_order" type="text" class="form-control" id="no_order" placeholder="No Order" 
                                value="<?php if($NoKKcek>0){echo $rNoKK['no_order'];}?>" readonly="readonly">
                            </div>				   
                            </div>
                        <div class="form-group">
                            <label for="no_po" class="col-sm-3 control-label">Pelanggan</label>
                            <div class="col-sm-8">
                                <input name="pelanggan" type="text" class="form-control" id="no_po" placeholder="Pelanggan" 
                                value="<?php if($NoKKcek>0){echo $rNoKK['pelanggan'];}?>" readonly="readonly" >
                            </div>				   
                            </div>	           
                            <div class="form-group">
                            <label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
                            <div class="col-sm-3">
                                <input name="no_hanger" type="text" class="form-control" id="no_hanger" placeholder="No Hanger" 
                                value="<?php if($NoKKcek>0){echo $rNoKK['no_hanger'];}?>" readonly="readonly">  
                            </div>
                            <div class="col-sm-3">
                            <input name="no_item" type="text" class="form-control" id="no_item" placeholder="No Item" 
                                value="<?php if($NoKKcek>0){echo $rNoKK['no_item'];}?>" readonly="readonly">
                            </div>	
                            </div>
                            <div class="form-group">
                            <label for="jns_kain" class="col-sm-3 control-label">Jenis Kain</label>
                            <div class="col-sm-8">
                                <textarea name="jns_kain" readonly="readonly" class="form-control" id="jns_kain" placeholder="Jenis Kain"><?php if($NoKKcek>0){echo $rNoKK['jenis_kain'];}?></textarea>
                                </div>
                            </div>
                    <div class="form-group">
                            <label for="warna" class="col-sm-3 control-label">Warna</label>
                            <div class="col-sm-8">
                                <textarea name="warna" readonly="readonly" class="form-control" id="warna" placeholder="Warna"><?php if($NoKKcek>0){echo $rNoKK['warna'];}?></textarea>
                            </div>				   
                            </div>
                    <div class="form-group">
                            <label for="lot" class="col-sm-3 control-label">Lot</label>
                            <div class="col-sm-2">
                                <input name="lot" type="text" class="form-control" id="lot" placeholder="Lot" 
                                value="<?php if($NoKKcek>0){echo $rNoKK['lot'];}?>" readonly="readonly" >
                            </div>				   
                            </div>
                    <div class="form-group">
                            <label for="buyer" class="col-sm-3 control-label">Buyer</label>
                            <div class="col-sm-8">
                                <input name="buyer" type="text" class="form-control" id="buyer" placeholder="Buyer" 
                                value="<?php if($NoKKcek>0){echo $rNoKK['buyer'];}?>" readonly="readonly" >
                            </div>				   
                            </div>
                    <?php if(($buyer==" VISION BRANDS" OR $buyer=="VISION BRANDS" OR $rNoKK['pelanggan']=="VISION BRANDS GROUP") AND $rcek1['status']!=""){ ?>
                    <div class="form-group">
                        <label for="season" class="col-sm-3 control-label">Season</label>
                        <div class="col-sm-4">
                                <select class="form-control select2" name="season" id="season" required>
                                    <option value="">Pilih</option>
                                    <?php 
                                    $qrys=mysqli_query($con,"SELECT nama FROM tbl_season_validity ORDER BY nama ASC");
                                    while($rs=mysqli_fetch_array($qrys)){
                                    ?>
                                    <option value="<?php echo $rs['nama'];?>" <?php if($rNoKK['season']==$rs['nama'] OR $Season==$rs['nama']){echo "SELECTED";}?>><?php echo $rs['nama'];?></option>	
                                    <?php }?>
                                </select>
                        </div>			   
                    </div>
                    <div class="form-group">
                        <label for="style" class="col-sm-3 control-label">Style</label>
                        <div class="col-sm-8">
                            <input name="style" type="text" class="form-control" id="style" placeholder="Style" 
                                value="<?php if($rNoKK['style']!=""){echo $rNoKK['style'];}?>" required >
                            <!-- <select class="form-control select2" name="style" id="style" required>
                                <option value="">Pilih</option>
                                <option value="OLTXOTP0041/OLTXOBOT0030" <?php if($rNoKK['style']=="OLTXOTP0041/OLTXOBOT0030"){echo "SELECTED";}?>>OLTXOTP0041/OLTXOBOT0030</option>
                                <option value="OLTXOTP0039" <?php if($rNoKK['style']=="OLTXOTP0039"){echo "SELECTED";}?>>OLTXOTP0039</option>
                                <option value="OLTXOBOT0028" <?php if($rNoKK['style']=="OLTXOBOT0028"){echo "SELECTED";}?>>OLTXOBOT0028</option>
                                <option value="OLTXOTP0044" <?php if($rNoKK['style']=="OLTXOTP0044"){echo "SELECTED";}?>>OLTXOTP0044</option>
                            </select> -->
                        </div>				   
                    </div> 
                    <div class="form-group">
                        <label for="pic_vbg" class="col-md-3 control-label">Upload Sample Picture Vision Brands</label>
                        <div class="col-sm-5">	  
                            <input type="file" id="pic_vbg" name="pic_vbg"><span style="color:red;"><?php if($NoKKcek>0){echo $rNoKK['pic_vbg'];} ?></span>
                            <span class="help-block with-errors"></span>
                        </div>	  
                    </div>
                    <?php } ?>
                    <?php } ?>
	 </div>
	
</div>	 
   <div class="box-footer"> 
        <?php if($NoKKcek>0){ ?>
        <button type="submit" class="btn btn-primary pull-right" name="update" value="update">Update <i class="fa fa-edit"></i></button>
        <?php }?>	
	    <?php if(($langganan=="ADIDAS " OR $buyer==" ADIDAS" OR $buyer=="ADIDAS") AND $rcek1['status']!=""){ ?>
 	        <a href="pages/cetak/cetak_report_adidas_new.php?idkk=<?php echo $rNoKK['id'];?>&noitem=<?php echo $rNoKK['no_item'];?>&nohanger=<?php echo $rNoKK['no_hanger'];?>" target="_blank" class="btn btn-success" <?php if($rcek1['status']=="Reject"):?> onclick="return confirm('Summary Test Quality berstatus Reject, apakah ingin tetap mencetak laporan?')" <?php endif; ?>><i class="fa fa-print"></i> Print Report Adidas</a>
	        <!-- <a href="pages/cetak/cetak_reportfunc_adidas.php?idkk=<?php echo $rNoKK['id'];?>&noitem=<?php echo $rNoKK['no_item'];?>&nohanger=<?php echo $rNoKK['no_hanger'];?>" target="_blank" class="btn btn-success" <?php if($rcek1['status']=="Reject"):?> onclick="return confirm('Summary Test Quality berstatus Reject, apakah ingin tetap mencetak laporan?')"<?php endif; ?>><i class="fa fa-print"></i> Print Report Functional</a> -->
        <?php }?>
        <?php if(($buyer==" VISION BRANDS" OR $buyer=="VISION BRANDS" OR $rNoKK['pelanggan']=="VISION BRANDS GROUP") AND $rcek1['status']!=""){ ?>
            <a href="pages/cetak/cetak_report_visionbrand.php?idkk=<?php echo $rNoKK['id'];?>&noitem=<?php echo $rNoKK['no_item'];?>&nohanger=<?php echo $rNoKK['no_hanger'];?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Report Vision Brands</a>
        <?php }?>
        <!--<?php if($rNoKK['buyer']=="UNDER ARMOUR" and $rcek1['status']!=""){ ?>
            <a href="#"><i class="fa fa-print"></i> Print Report Physical</a>
	        <a href="#"><i class="fa fa-print"></i> Print Report Functional</a>
        <?php }?>-->
   </div>
    <!-- /.box-footer -->
</div>
</form>         
				  </div>
                </div>
            </div>
        </div>
<!-- Modal -->
<div class="modal fade modal-3d-slit" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:90%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Data Kain Masuk</h4>
			</div>
			<div class="modal-body">
				<table id="lookup" class="table table-bordered table-hover table-striped" width="100%">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="10%">No Order</th>
                            <th width="8%">No Test</th>
							<th width="14%">No KK</th>
							<th width="31%">Jenis Kain</th>
							<th width="22%">Lot</th>
							<th width="8%">No Hanger</th>
							<th width="8%">No Item</th>
                            <th width="8%">Warna</th>
						</tr>
					</thead>
					<tbody>
						<?php
                                //Data ditampilkan ke tabel
                                $sql = mysqli_query($con,"SELECT a.* FROM tbl_tq_nokk a INNER JOIN tbl_tq_test b ON a.id=b.id_nokk WHERE LENGTH(a.no_test) = 12 ");
                                $no="1";
                                while ($r = mysqli_fetch_array($sql)) {
                                    ?>
						<tr class="pilih-no_test" data-no_test="<?php echo $r['no_test']; ?>">
							<td align="center">
								<?php echo $no; ?>
							</td>
							<td align="center">
								<?php echo $r['no_order']; ?>
							</td>
                            <td align="center">
								<?php echo $r['no_test']; ?>
							</td>
							<td align="center">
								<?php echo $r['nokk']; ?>
							</td>
							<td>
								<?php echo $r['jenis_kain']; ?>
							</td>
							<td align="center">
								<?php echo $r['lot']; ?>
							</td>
							<td align="right">
								<?php echo $r['no_hanger']; ?>
							</td>
							<td align="center">
								<?php echo $r['no_item']; ?>
							</td>
                            <td align="center">
								<?php echo $r['warna']; ?>
							</td>
						</tr>
						<?php
                                    $no++;
                                }
                                ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>