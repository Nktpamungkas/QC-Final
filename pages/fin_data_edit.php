<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
	$modal=mysqli_query($con,"SELECT * FROM tbl_ncp_qcf_new WHERE id='$modal_id' ");
while($rcek=mysqli_fetch_array($modal)){	
?>
          <div class="modal-dialog">
            <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="EditDataFin" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data FIN </h4><span class="">
              <small class="label bg-green blink_me">new</small>
            </span>
              </div>
              <div class="modal-body">
              <input type="hidden" id="id" name="id" value="<?php echo $rcek['id'];?>">  
		<div class="form-group">
        <label for="penyebab" class="col-sm-3 control-label">Penyebab</label>
        <div class="col-sm-6">  
			<input name="penyebab" type="text" class="form-control" id="penyebab" value="<?php echo $rcek['penyebab']; ?>" placeholder="Nama Staff">			
        </div>
	    </div>    
		<div class="form-group">
        <label for="shift" class="col-sm-3 control-label">Shift</label>
        <div class="col-sm-3">  
		<select class="form-control" name="shift">
			<option value="">Pilih</option>
			<option value="A" <?php if($rcek['shift']=="A"){echo "SELECTED"; } ?>>A</option>
			<option value="B" <?php if($rcek['shift']=="B"){echo "SELECTED"; } ?>>B</option>
			<option value="C" <?php if($rcek['shift']=="C"){echo "SELECTED"; } ?>>C</option>
			<option value="A+B" <?php if($rcek['shift']=="A+B"){echo "SELECTED"; } ?>>A+B</option>
			<option value="B+C" <?php if($rcek['shift']=="B+C"){echo "SELECTED"; } ?>>B+C</option>
			<option value="C+A" <?php if($rcek['shift']=="C+A"){echo "SELECTED"; } ?>>C+A</option>
			<option value="Non-Shift" <?php if($rcek['shift']=="Non-Shift"){echo "SELECTED"; } ?>>Non-Shift</option>
		</select>		
        </div>
	</div>
	<div class="form-group">
        <label for="mesin" class="col-sm-3 control-label">Mesin</label>
        <div class="col-sm-4">  
		<select class="form-control" name="mesin">
			<option value="">Pilih</option>
			<option value="BELAH-CUCI 01" <?php if($rcek['mesin']=="BELAH-CUCI 01"){echo "SELECTED"; } ?>>BELAH-CUCI 01</option>
			<option value="BELAH-CUCI 02" <?php if($rcek['mesin']=="BELAH-CUCI 02"){echo "SELECTED"; } ?>>BELAH-CUCI 02</option>
			<option value="BELAH-CUCI 03" <?php if($rcek['mesin']=="BELAH-CUCI 03"){echo "SELECTED"; } ?>>BELAH-CUCI 03</option>
			<option value="BELAH-CUCI 04" <?php if($rcek['mesin']=="BELAH-CUCI 04"){echo "SELECTED"; } ?>>BELAH-CUCI 04</option>
			<option value="COMPACT 01" <?php if($rcek['mesin']=="COMPACT" or $rcek['mesin']=="COMPACT 01"){echo "SELECTED"; } ?>>COMPACT 01</option>
			<option value="COMPACT 02" <?php if($rcek['mesin']=="COMPACT 02"){echo "SELECTED"; } ?>>COMPACT 02</option>
			<option value="OVEN-01" <?php if($rcek['mesin']=="OVEN-01"){echo "SELECTED"; } ?>>OVEN-01</option>
			<option value="ST-01" <?php if($rcek['mesin']=="STENTER LK 01" or $rcek['mesin']=="ST-01"){echo "SELECTED"; } ?>>ST-01</option>
			<option value="ST-02" <?php if($rcek['mesin']=="STENTER FONG 2" or $rcek['mesin']=="ST-02"){echo "SELECTED"; } ?>>ST-02</option>
			<option value="ST-03" <?php if($rcek['mesin']=="STENTER LK 03" or $rcek['mesin']=="ST-03"){echo "SELECTED"; } ?>>ST-03</option>
			<option value="ST-04" <?php if($rcek['mesin']=="STENTER LK 04" or $rcek['mesin']=="ST-04"){echo "SELECTED"; } ?>>ST-04</option>
			<option value="ST-05" <?php if($rcek['mesin']=="STENTER LK 05" or $rcek['mesin']=="ST-05"){echo "SELECTED"; } ?>>ST-05</option>
			<option value="ST-06" <?php if($rcek['mesin']=="STENTER LK 06" or $rcek['mesin']=="ST-06"){echo "SELECTED"; } ?>>ST-06</option>
			<option value="ST-07" <?php if($rcek['mesin']=="STENTER LK 07" or $rcek['mesin']=="ST-07"){echo "SELECTED"; } ?>>ST-07</option>
			<option value="ST-08" <?php if($rcek['mesin']=="STENTER FONG 8" or $rcek['mesin']=="ST-08"){echo "SELECTED"; } ?>>ST-08</option>	
			<option value="ST-09" <?php if($rcek['mesin']=="STENTER YT 09" or $rcek['mesin']=="ST-09"){echo "SELECTED"; } ?>>ST-09</option>	
			<option value="ST-09" <?php if($rcek['mesin']=="INSPEK" or $rcek['mesin']=="INSPEK"){echo "SELECTED"; } ?>>INSPEK</option>	
		</select>			
        </div>
	    </div>
		<div class="form-group">
        <label for="perbaikan" class="col-sm-3 control-label">Perbaikan</label>
        <div class="col-sm-6">  
			<input name="perbaikan" type="text" class="form-control" id="perbaikan" value="<?php echo $rcek['perbaikan']; ?>" placeholder="Nama Staff">			
        </div>
	    </div>		  
		<div class="form-group">
        <label for="mesin_perbaikan" class="col-sm-3 control-label">Mesin Perbaikan</label>
        <div class="col-sm-4">  
		<select class="form-control" name="mesin_perbaikan">
			<option value="">Pilih</option>
			<option value="BELAH-CUCI 01" <?php if($rcek['mesin_perbaikan']=="BELAH-CUCI 01"){echo "SELECTED"; } ?>>BELAH-CUCI 01</option>
			<option value="BELAH-CUCI 02" <?php if($rcek['mesin_perbaikan']=="BELAH-CUCI 02"){echo "SELECTED"; } ?>>BELAH-CUCI 02</option>
			<option value="BELAH-CUCI 03" <?php if($rcek['mesin_perbaikan']=="BELAH-CUCI 03"){echo "SELECTED"; } ?>>BELAH-CUCI 03</option>
			<option value="BELAH-CUCI 04" <?php if($rcek['mesin_perbaikan']=="BELAH-CUCI 04"){echo "SELECTED"; } ?>>BELAH-CUCI 04</option>
			<option value="COMPACT 01" <?php if($rcek['mesin_perbaikan']=="COMPACT" or $rcek['mesin_perbaikan']=="COMPACT 01"){echo "SELECTED"; } ?>>COMPACT 01</option>
			<option value="COMPACT 02" <?php if($rcek['mesin_perbaikan']=="COMPACT 02"){echo "SELECTED"; } ?>>COMPACT 02</option>
			<option value="OVEN-01" <?php if($rcek['mesin_perbaikan']=="OVEN-01"){echo "SELECTED"; } ?>>OVEN-01</option>
			<option value="ST-01" <?php if($rcek['mesin_perbaikan']=="STENTER LK 01" or $rcek['mesin_perbaikan']=="ST-01"){echo "SELECTED"; } ?>>ST-01</option>
			<option value="ST-02" <?php if($rcek['mesin_perbaikan']=="STENTER FONG 2" or $rcek['mesin_perbaikan']=="ST-02"){echo "SELECTED"; } ?>>ST-02</option>
			<option value="ST-03" <?php if($rcek['mesin_perbaikan']=="STENTER LK 03" or $rcek['mesin_perbaikan']=="ST-03"){echo "SELECTED"; } ?>>ST-03</option>
			<option value="ST-04" <?php if($rcek['mesin_perbaikan']=="STENTER LK 04" or $rcek['mesin_perbaikan']=="ST-04"){echo "SELECTED"; } ?>>ST-04</option>
			<option value="ST-05" <?php if($rcek['mesin_perbaikan']=="STENTER LK 05" or $rcek['mesin_perbaikan']=="ST-05"){echo "SELECTED"; } ?>>ST-05</option>
			<option value="ST-06" <?php if($rcek['mesin_perbaikan']=="STENTER LK 06" or $rcek['mesin_perbaikan']=="ST-06"){echo "SELECTED"; } ?>>ST-06</option>
			<option value="ST-07" <?php if($rcek['mesin_perbaikan']=="STENTER LK 07" or $rcek['mesin_perbaikan']=="ST-07"){echo "SELECTED"; } ?>>ST-07</option>
			<option value="ST-08" <?php if($rcek['mesin_perbaikan']=="STENTER FONG 8" or $rcek['mesin_perbaikan']=="ST-08"){echo "SELECTED"; } ?>>ST-08</option>	
			<option value="ST-09" <?php if($rcek['mesin_perbaikan']=="STENTER YT 09" or $rcek['mesin_perbaikan']=="ST-09"){echo "SELECTED"; } ?>>ST-09</option>	
			<option value="ST-09" <?php if($rcek['mesin_perbaikan']=="INSPEK" or $rcek['mesin_perbaikan']=="INSPEK"){echo "SELECTED"; } ?>>INSPEK</option>	
		</select>			
        </div>
	    </div>
		<div class="form-group">
        <label for="jmlperbaikan" class="col-sm-3 control-label">Jumlah Perbaikan</label>
        <div class="col-sm-2">  
			<input name="jmlperbaikan" type="text" class="form-control" id="jmlperbaikan" value="<?php echo $rcek['jml_perbaikan']; ?>" placeholder="0">			
        </div>
	    </div>
		<div class="form-group">
        <label for="kategori" class="col-sm-3 control-label">Kategori</label>
        <div class="col-sm-5">  
			<input name="kategori" type="text" class="form-control" id="kategori" value="<?php echo $rcek['kategori']; ?>" placeholder="Kategori">			
        </div>
	    </div>     
				  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
          <?php } ?>
<script>
	//Initialize Select2 Elements
    $('.select2').select2()
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
		//Date picker
        $('#datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd',
          todayHighlight: true,
        });
	    //Date picker
        $('#datepicker1').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd',
          todayHighlight: true,
        });
		//Date picker
        $('#datepicker2').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd',
          todayHighlight: true,
        });
		//Timepicker
    	$('#timepicker').timepicker({
      	showInputs: false,
    	});
	    
	$(function () {	
//Timepicker
    $('.timepicker').timepicker({
                minuteStep: 1,
                showInputs: true,
                showMeridian: false,
                defaultTime: false	
	  	
    })
})
		
</script>
<script>
function aktif(){		
		if(document.forms['modal_popup']['ck4'].checked == true && (document.forms['modal_popup']['sts'].value=="Cancel" || document.forms['modal_popup']['sts'].value=="Disposisi")){
			document.modal_popup.disposisiqc.removeAttribute("disabled");
			document.modal_popup.disposisiqc.setAttribute("required",true);
			document.modal_popup.catat.setAttribute("required",true);
		}else{
			document.modal_popup.disposisiqc.setAttribute("disabled",true);
			document.modal_popup.disposisiqc.removeAttribute("required");
			document.modal_popup.catat.removeAttribute("required");
			
		}
}
</script>
