<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
//$notest= isset($_POST['no_test']) ? $_POST['no_test'] : '';
$notest=$_GET['no_test'];
$sqlCek=mysqli_query($con,"SELECT a.*,b.* FROM tbl_tq_nokk a 
LEFT JOIN tbl_master_test b ON a.no_test=b.no_testmaster
WHERE no_test='$notest'");
$cek=mysqli_num_rows($sqlCek);
$rcek=mysqli_fetch_array($sqlCek);
?>	
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form0" id="form0">
 <div class="box box-info">
   <div class="box-header with-border">
    <h3 class="box-title">Edit Testing</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body"> 
	 <div class="col-md-6">
	  <!--<div class="form-group">-->
					  <!--<label for="no_id" class="col-sm-3 control-label">No ID</label>
					  <div class="col-sm-4">
					  <div class="input-group">
					  
					  <span class="input-group-addon"><button type="submit" name="cari_no">Cari</button></span>
					  </div>
			  </div>
					</div>-->
            <div class="form-group">
            <label for="no_test" class="col-sm-3 control-label">No Test</label>
            <div class="col-sm-4">
                <input name="no_test" type="text" class="form-control" id="no_test" placeholder="No Test"  
                onchange="window.location='EditTQNew-'+this.value" value="<?php echo $_GET['no_test'];?>" >
            </div>				   
            </div>
			<?php if($notest!=""){ ?>
            <div class="form-group">
	            <input name="no_id" type="hidden" class="form-control" id="no_id" value="<?php echo $rcek['no_id'];?>" placeholder="No ID">
                <label for="nokk" class="col-sm-3 control-label">No KK</label>
                    <div class="col-sm-4">
                        <input name="nokk" type="text" class="form-control" id="nokk" 
                        value="<?php if($cek>0){echo $rcek['nokk'];}?>" placeholder="No KK" required readonly="readonly">
                        <!--<span class="input-group-addon"><button type="submit" name="cari_nokk">Cari</button></span>-->	  
		            </div>
		    </div>
            <div class="form-group">
                <label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
                <div class="col-sm-4">
                    <input name="no_hanger" type="text" class="form-control" id="no_hanger" placeholder="No Hanger" 
                    value="<?php if($cek>0){echo $rcek['no_hanger'];}?>" <?php if($_SESSION['akses']=='biasa' OR $_SESSION['nama1']!='Janu Dwi Laksono'){ echo "readonly"; } ?>>  
                </div>
			    <div class="col-sm-4">
				    <input name="no_item" type="text" class="form-control" id="no_item" placeholder="No Item" 
				    value="<?php if($cek>0){echo $rcek['no_item'];}?>" <?php if($_SESSION['akses']=='biasa' OR $_SESSION['nama1']!='Janu Dwi Laksono'){ echo "readonly"; } ?>>
			    </div>	
            </div>
	           <div class="form-group">
                  <label for="no_order" class="col-sm-3 control-label">No Order</label>
                  <div class="col-sm-4">
                    <input name="no_order" type="text" class="form-control" id="no_order" placeholder="No Order" 
                    value="<?php if($cek>0){echo $rcek['no_order'];}else{echo $r['NoOrder'];} ?>" <?php if($_SESSION['akses']=='biasa' OR $_SESSION['nama1']!='Janu Dwi Laksono'){ echo "readonly"; } ?>>
                  </div>				   
                </div>
		 	   <div class="form-group">
                  <label for="no_po" class="col-sm-3 control-label">Pelanggan</label>
                  <div class="col-sm-8">
                    <input name="pelanggan" type="text" class="form-control" id="no_po" placeholder="Pelanggan" 
                    value="<?php if($cek>0){echo $rcek['pelanggan'];}else if($r1['partnername']!=""){echo $pelanggan;}else{}?>" <?php if($_SESSION['akses']=='biasa' OR $_SESSION['nama1']!='Janu Dwi Laksono'){ echo "readonly"; } ?> >
                  </div>				   
                </div>
	           <div class="form-group">
                  <label for="no_po" class="col-sm-3 control-label">PO</label>
                  <div class="col-sm-5">
                    <input name="no_po" type="text" class="form-control" id="no_po" placeholder="PO" 
                    value="<?php if($cek>0){echo $rcek['no_po'];}else{echo $r['PONumber'];} ?>" <?php if($_SESSION['akses']=='biasa' OR $_SESSION['nama1']!='Janu Dwi Laksono'){ echo "readonly"; } ?> >
                  </div>				   
                </div>
				<div class="form-group">
                  <label for="l_g" class="col-sm-3 control-label">Lebar X Gramasi</label>
                  <div class="col-sm-3">
                    <input name="lebar" type="text" required class="form-control" id="lebar" placeholder="0" 
                    value="<?php if($cek>0){echo $rcek['lebar'];}else{echo round($r['Lebar']);} ?>">
                  </div>
				  <div class="col-sm-3">
                    <input name="grms" type="text" required class="form-control" id="grms" placeholder="0" 
                    value="<?php if($cek>0){echo $rcek['gramasi'];}else{echo round($r['Gramasi']);} ?>">
                  </div>		
                </div>
				<div class="form-group">
                  	<label for="jns_kain" class="col-sm-3 control-label">Jenis Kain</label>
                  	<div class="col-sm-8">
					  	<textarea name="jns_kain" class="form-control" id="jns_kain" placeholder="Jenis Kain"><?php if($cek>0){echo $rcek['jenis_kain'];}else{echo $r['ProductDesc'];}?></textarea>
					</div>
                </div>	 		
		 		
	  	</div>
	  		<!-- col --> 
	  <div class="col-md-6">		  
		 		<div class="form-group">
                  <label for="warna" class="col-sm-3 control-label">Warna</label>
                  <div class="col-sm-8">
                    <textarea name="warna" <?php if($_SESSION['akses']=='biasa' OR $_SESSION['nama1']!='Janu Dwi Laksono'){ echo "readonly"; } ?> class="form-control" id="warna" placeholder="Warna"><?php if($cek>0){echo $rcek['warna'];}else{echo $r['Color'];}?></textarea>
                  </div>				   
                </div>
		 		<div class="form-group">
                  <label for="no_warna" class="col-sm-3 control-label">No Warna</label>
                  <div class="col-sm-8">
                    <textarea name="no_warna" <?php if($_SESSION['akses']=='biasa' OR $_SESSION['nama1']!='Janu Dwi Laksono'){ echo "readonly"; } ?> class="form-control" id="no_warna" placeholder="No Warna"><?php if($cek>0){echo $rcek['no_warna'];}else{echo $r['ColorNo'];}?></textarea>
                  </div>				   
                </div>
		 		<div class="form-group">
                  <label for="lot" class="col-sm-3 control-label">Lot</label>
                  <div class="col-sm-2">
                    <input name="lot" type="text" class="form-control" id="lot" placeholder="Lot" 
                    value="<?php if($cek>0){echo $rcek['lot'];}else{echo $lotno;} ?>" >
                  </div>				   
                </div>
		  		<div class="form-group">
                  <label for="suhu" class="col-sm-3 control-label">Suhu</label>
                  <div class="col-sm-3">
					<div class="input-group">  
                    <input name="suhu" type="text" class="form-control" id="suhu" placeholder="Suhu" 
                    value="<?php if($cek>0){echo $rcek['suhu'];}else{} ?>" <?php if($_SESSION['akses']=='biasa' OR $_SESSION['nama1']!='Janu Dwi Laksono'){ echo "readonly"; } ?> >
					<span class="input-group-addon">&deg;C</span>	
					</div>  
                  </div>				   
                </div>
            <div class="form-group">
          	<label for="buyer" class="col-sm-3 control-label">Buyer</label>
				<div class="col-sm-5">
					<input name="buyer" type="text" class="form-control" id="buyer" placeholder="Buyer"
					value="<?php if($cek>0){echo $rcek['buyer'];}else{} ?>" <?php if($_SESSION['akses']=='biasa' OR $_SESSION['nama1']!='Janu Dwi Laksono'){ echo "readonly"; } ?>>
				</div>
			</div>
			<div class="form-group">
				<label for="development" class="col-sm-3 control-label">Development</label>
				<div class="col-sm-3">
					<div class="input-group">  
						<select name="development" id="development" class="form-control select2">
							<option value="">Pilih</option>
							<option value="Development" <?php if($rcek['development']=="Development"){echo "SELECTED";}?>>Development</option>
							<option value="1st Bulk" <?php if($rcek['development']=="1st Bulk"){echo "SELECTED";}?>>1st Bulk</option>
							<option value="Reorder" <?php if($rcek['development']=="Reorder"){echo "SELECTED";}?>>Reorder</option>
						</select>
					</div>
				</div>				   
			</div>
			<div class="form-group">
			<label for="season" class="col-sm-3 control-label">Season</label>
			<div class="col-sm-4">
				<div class="input-group">
					<select class="form-control select2" name="season" id="season">
						<option value="">Pilih</option>
						<?php 
						$qrys=mysqli_query($con,"SELECT nama FROM tbl_season_validity ORDER BY nama ASC");
						while($rs=mysqli_fetch_array($qrys)){
						?>
						<option value="<?php echo $rs['nama'];?>" <?php if($rcek['season']==$rs['nama']){echo "SELECTED";}?>><?php echo $rs['nama'];?></option>	
						<?php }?>
					</select>
				</div>
		 	</div>			   
        </div>
			<?php } ?>
	 </div>
	
</div>
	<!--<?php if($_GET['no_test']!=""){ ?>	 
	<div class="box-footer">
        <button type="submit" class="btn btn-primary pull-left" name="save" value="save"><i class="fa fa-save"></i> Simpan</button> 
    </div>
	<?php } ?>-->
    <!-- /.box-footer -->
</div>

<?php if($_GET['no_test']!=""){ ?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Detail Testing</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
<div class="box-body"> 
    <div class="col-md-12">
     
		<?php
		//$buyer=$_GET[buyer];
		//$buyer=$_GET[buyer];
		$qMB=mysqli_query($con,"SELECT * FROM tbl_master_test WHERE no_testmaster='$_GET[no_test]'");
		$cekMB=mysqli_num_rows($qMB);
					
        if($cekMB>0){
            while($dMB=mysqli_fetch_array($qMB)){
            $detail=explode(",",$dMB['physical']);
            $detail1=explode(",",$dMB['functional']);
            $detail2=explode(",",$dMB['colorfastness']);
		?>
		<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="form-group">
                <span class='badge bg-blue'><label for="physical" class="col-sm-2">PHYSICAL</label></span>
            </div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="FLAMMABILITY" <?php if(in_array("FLAMMABILITY",$detail)){echo "checked";} ?>> Flammability &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="FIBER CONTENT" <?php if(in_array("FIBER CONTENT",$detail)){echo "checked";} ?>> Fiber Content  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="FABRIC COUNT" <?php if(in_array("FABRIC COUNT",$detail)){echo "checked";} ?>> Fabric Count
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="BOW & SKEW" <?php if(in_array("BOW & SKEW",$detail)){echo "checked";} ?>> Bow &amp; Skew &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="PILLING MARTINDLE" <?php if(in_array("PILLING MARTINDLE",$detail)){echo "checked";} ?>> Pilling Martindale &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="FABRIC WEIGHT & SHRINKAGE & SPIRALITY" <?php if(in_array("FABRIC WEIGHT & SHRINKAGE & SPIRALITY",$detail)){echo "checked";} ?>> Fabric Weight &amp; Shrinkage &amp; Spirality 
				</label>
			</div>
			<div class="form-group">
			    <label><input type="checkbox" class="minimal" name="physical[]" value="PILLING BOX" <?php if(in_array("PILLING BOX",$detail)){echo "checked";} ?>> Pilling Box &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="PILLING RANDOM TUMBLER" <?php if(in_array("PILLING RANDOM TUMBLER",$detail)){echo "checked";} ?>> Pilling Random Tumbler  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="ABRATION" <?php if(in_array("ABRATION",$detail)){echo "checked";} ?>> Abration
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="SNAGGING MACE" <?php if(in_array("SNAGGING MACE",$detail)){echo "checked";} ?>> Snagging Mace &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; 
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="SNAGGING POD" <?php if(in_array("SNAGGING POD",$detail)){echo "checked";} ?>> Snagging Pod &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; 
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="BEAN BAG" <?php if(in_array("BEAN BAG",$detail)){echo "checked";} ?>> Bean Bag
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="BURSTING STRENGTH" <?php if(in_array("BURSTING STRENGTH",$detail)){echo "checked";} ?>> Bursting Strength &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="THICKNESS" <?php if(in_array("THICKNESS",$detail)){echo "checked";} ?>> Thickness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="STRETCH & RECOVERY" <?php if(in_array("STRETCH & RECOVERY",$detail)){echo "checked";} ?>> Stretch &amp; Recovery 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="GROWTH" <?php if(in_array("GROWTH",$detail)){echo "checked";} ?>> Growth &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="APPEARANCE" <?php if(in_array("APPEARANCE",$detail)){echo "checked";} ?>> Appearance &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="HEAT SHRINKAGE" <?php if(in_array("HEAT SHRINKAGE",$detail)){echo "checked";} ?>> Heat Shrinkage 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="FIBRE/FUZZ" <?php if(in_array("FIBRE/FUZZ",$detail)){echo "checked";} ?>> Fibre/Fuzz &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="PILLING LOCUS" <?php if(in_array("PILLING LOCUS",$detail)){echo "checked";} ?>> Pilling Locus &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="ODOUR" <?php if(in_array("ODOUR",$detail)){echo "checked";} ?>> Odour
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="CURLING" <?php if(in_array("CURLING",$detail)){echo "checked";} ?>> Curling &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="NEDLE" <?php if(in_array("NEDLE",$detail)){echo "checked";} ?>> Nedle Holes & Cracking &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
				</label>
			</div>
            <div class="form-group">
                <span class='badge bg-blue'><label for="functional" class="col-sm-2">FUNCTIONAL &amp; PH</label></span>
            </div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="functional[]" value="WICKING" <?php if(in_array("WICKING",$detail1)){echo "checked";} ?>> Wicking &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="functional[]" value="ABSORBENCY" <?php if(in_array("ABSORBENCY",$detail1)){echo "checked";} ?>> Absorbency &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="functional[]" value="DRYING TIME" <?php if(in_array("DRYING TIME",$detail1)){echo "checked";} ?>> Drying Time
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="functional[]" value="WATER REPPELENT" <?php if(in_array("WATER REPPELENT",$detail1)){echo "checked";} ?>> Water Reppelent &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="functional[]" value="PH" <?php if(in_array("PH",$detail1)){echo "checked";} ?>> PH &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="functional[]" value="SOIL RELEASE" <?php if(in_array("SOIL RELEASE",$detail1)){echo "checked";} ?>> Soil Release 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="functional[]" value="HUMIDITY" <?php if(in_array("HUMIDITY",$detail1)){echo "checked";} ?>> Humidity &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
			</div>
            <div class="form-group">
                <span class='badge bg-blue'><label for="colorfastness" class="col-sm-2">COLORFASTNESS</label></span>
            </div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="WASHING" <?php if(in_array("WASHING",$detail2)){echo "checked";} ?>> Washing Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="PERSPIRATION ACID" <?php if(in_array("PERSPIRATION ACID",$detail2)){echo "checked";} ?>> Perpiration Fastness Acid &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="PERSPIRATION ALKALINE" <?php if(in_array("PERSPIRATION ALKALINE",$detail2)){echo "checked";} ?>> Perpiration Fastness Alkaline
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="WATER" <?php if(in_array("WATER",$detail2)){echo "checked";} ?>> Water Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="CROCKING" <?php if(in_array("CROCKING",$detail2)){echo "checked";} ?>> Crocking Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="PHENOLIC YELLOWING" <?php if(in_array("PHENOLIC YELLOWING",$detail2)){echo "checked";} ?>> Phenolic Yellowing 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="LIGHT" <?php if(in_array("LIGHT",$detail2)){echo "checked";} ?>> Light Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="COLOR MIGRATION-OVEN TEST" <?php if(in_array("COLOR MIGRATION-OVEN TEST",$detail2)){echo "checked";} ?>> Color Migration - Oven Test &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="COLOR MIGRATION" <?php if(in_array("COLOR MIGRATION",$detail2)){echo "checked";} ?>> Color Migration Fastness
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="LIGHT PERSPIRATION" <?php if(in_array("LIGHT PERSPIRATION",$detail2)){echo "checked";} ?>> Light Perspiration &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="SALIVA" <?php if(in_array("SALIVA",$detail2)){echo "checked";} ?>> Saliva Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="BLEEDING" <?php if(in_array("BLEEDING",$detail2)){echo "checked";} ?>> Bleeding 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="CHLORIN & NON-CHLORIN" <?php if(in_array("CHLORIN & NON-CHLORIN",$detail2)){echo "checked";} ?>> Chlorin &amp; Non-Chlorin &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="DYE TRANSFER" <?php if(in_array("DYE TRANSFER",$detail2)){echo "checked";} ?>> Dye Transfer &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
			</div>
            <?php } ?>
		</form>
                
            <?php }else{ ?>
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="form-group">
                <span class='badge bg-blue'><label for="physical" class="col-sm-2">PHYSICAL</label></span>
            </div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="FLAMMABILITY"> Flammability &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="FIBER CONTENT"> Fiber Content  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="FABRIC COUNT"> Fabric Count
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="BOW & SKEW"> Bow &amp; Skew &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="PILLING MARTINDLE"> Pilling Martindale &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="FABRIC WEIGHT & SHRINKAGE & SPIRALITY"> Fabric Weight &amp; Shrinkage &amp; Spirality 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="PILLING BOX"> Pilling Box &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="PILLING RANDOM TUMBLER"> Pilling Random Tumbler  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="ABRATION"> Abration
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="SNAGGING MACE"> Snagging Mace &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; 
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="SNAGGING POD"> Snagging Pod &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; 
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="BEAN BAG"> Bean Bag
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="BURSTING STRENGTH"> Bursting Strength &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="THICKNESS"> Thickness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="STRETCH & RECOVERY"> Stretch &amp; Recovery 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="GROWTH"> Growth &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="APPEARANCE"> Appearance &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="HEAT SHRINKAGE"> Heat Shrinkage 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="FIBRE/FUZZ"> Fibre/Fuzz &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="PILLING LOCUS"> Pilling Locus &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="ODOUR"> Odour
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="physical[]" value="CURLING"> Curling &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="physical[]" value="NEDLE"> Nedle Holes & Cracking &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
			</div>
            <div class="form-group">
                <span class='badge bg-blue'><label for="functional" class="col-sm-2">FUNCTIONAL &amp; PH</label></span>
            </div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="functional[]" value="WICKING"> Wicking &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="functional[]" value="ABSORBENCY"> Absorbency &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="functional[]" value="DRYING TIME"> Drying Time
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="functional[]" value="WATER REPPELENT"> Water Reppelent &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="functional[]" value="PH"> PH &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="functional[]" value="SOIL RELEASE"> Soil Release 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="functional[]" value="HUMIDITY"> Humidity &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
			</div>
            <div class="form-group">
                <span class='badge bg-blue'><label for="colorfastness" class="col-sm-2">COLORFASTNESS</label></span>
            </div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="WASHING"> Washing Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="PERSPIRATION ACID"> Perpiration Fastness Acid &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="PERSPIRATION ALKALINE"> Perpiration Fastness Alkaline
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="WATER"> Water Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="CROCKING"> Crocking Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="PHENOLIC YELLOWING"> Phenolic Yellowing 
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="LIGHT"> Light Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="COLOR MIGRATION-OVEN TEST"> Color Migration - Oven Test &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="COLOR MIGRATION"> Color Migration Fastness
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="LIGHT PERSPIRATION"> Light Perspiration &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="SALIVA"> Saliva Fastness &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="BLEEDING"> Bleeding
				</label>
			</div>
			<div class="form-group">
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="CHLORIN & NON-CHLORIN"> Chlorin &amp; Non-Chlorin &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
				<label><input type="checkbox" class="minimal" name="colorfastness[]" value="DYE TRANSFER"> Dye Transfer &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</label>
			</div>
		</form>
			<?php } ?>
</div>
</div>
 	<?php if($_GET['no_test']!=""){ 
	$qrytm=mysqli_query($con,"SELECT a.*, b.* FROM tbl_tq_nokk a LEFT JOIN tbl_tq_test b ON a.id=b.id_nokk WHERE no_test='$_GET[no_test]'");
	$rtm=mysqli_fetch_array($qrytm);	 
	?>
		 
	<div class="box-footer">
        <button type="submit" class="btn btn-primary pull-left" name="save" value="save"><i class="fa fa-save"></i> Simpan</button> 
    </div>
	<?php } ?>

</div>
<?php } ?>
</form>
						
                    </div>
                </div>
            </div>

<?php
if($_POST['save']=="save"){
        $checkbox1=$_POST['physical'];
        $checkbox2=$_POST['functional'];
        $checkbox3=$_POST['colorfastness'];
		$buyer=strtoupper($_POST['buyer']);
		$nohanger=strtoupper($_POST['no_hanger']);
		$noitem=strtoupper($_POST['no_item']);
		$nopo=str_replace("'","''",$_POST['no_po']);
		$noorder=str_replace("'","''",$_POST['no_order']);
		$nowarna=str_replace("'","''",$_POST['no_warna']);
		$notestmaster=$_POST['no_test'];
		$lebar=$_POST['lebar'];
		$gramasi=$_POST['grms'];
		$jns_kain=$_POST['jns_kain'];
		$pelanggan=str_replace("'","''",$_POST['pelanggan']);
        $chkp="";
        $chkf="";
        $chkc="";   
		foreach($checkbox1 as $chk1)  
   		{  
      		$chkp .= $chk1.",";  
        }
        foreach($checkbox2 as $chk2)  
   		{  
      		$chkf .= $chk2.",";  
        } 
        foreach($checkbox3 as $chk3)  
   		{  
      		$chkc .= $chk3.",";  
   		}
    $sqlData=mysqli_query($con,"UPDATE tbl_master_test SET
          buyer='$buyer',
			no_itemtest='$noitem',
			no_testmaster='$notestmaster',
			physical='$chkp',
          functional='$chkf',
          colorfastness='$chkc',
			tgl_update=now()
		WHERE no_testmaster='$notestmaster'
	");
	$sqlData1=mysqli_query($con,"UPDATE tbl_tq_nokk SET
	lebar='$lebar',
	gramasi='$gramasi',
	jenis_kain='$jns_kain',
	pelanggan='$pelanggan',
	no_item='$noitem',
	no_hanger='$nohanger',
	no_po='$nopo',
	no_order='$noorder',
	lot='$_POST[lot]',
	warna='$_POST[warna]',
	no_warna='$nowarna',
	buyer='$buyer',
	suhu='$_POST[suhu]',
	development='$_POST[development]',
	season='$_POST[season]',
	tgl_update=now()
	WHERE no_test='$notest'
	");
    if($sqlData1){
			
        echo "<script>swal({
    title: 'Data Tersimpan',   
    text: 'Klik Ok untuk input data kembali',
    type: 'success',
    }).then((result) => {
    if (result.value) {
    window.location.href='EditTQNew-$notest';
    }
    });</script>";
    }
}
if($notest!="" and $cek==0){
    echo "<script>swal({
 title: 'No Test Tidak Ditemukan',   
 text: 'Klik Ok untuk input data kembali',
 type: 'info',
 }).then((result) => {
 if (result.value) {
   
    window.location.href='EditTQNew'; 
 }
});</script>";
}
?>
