<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$modal_id=$_GET['id'];
$modal=mysqli_query($con,"SELECT a.*, a.id as id_a, b.*, c.* From tbl_tq_nokk a 
INNER JOIN tbl_master_test b ON a.no_test=b.no_testmaster
INNER JOIN tbl_tq_test c ON a.id=c.id_nokk
WHERE a.no_test='$modal_id'");
while($r=mysqli_fetch_array($modal)){
    $sqlCekR=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',rfc_note,rph_note, rabr_note, rbas_note, rdry_note, rfla_note, rfwe_note, rfwi_note, rburs_note,rrepp_note,rwick_note,rabsor_note,rapper_note,rfiber_note,rpillb_note,rpillm_note,rpillr_note,rthick_note,rgrowth_note,rrecover_note,rstretch_note,rsns_note,rsnab_note,rsnam_note,rsnap_note,rwash_note,rwater_note,racid_note,ralkaline_note,rcrock_note,rphenolic_note,rcm_printing_note,rcm_dye_note,rlight_note,rlight_pers_note,rsaliva_note,rh_shrinkage_note,rfibre_note,rpilll_note,rsoil_note,rapperss_note,rbleeding_note,rchlorin_note,rdye_tf_note,rhumidity_note,rodour_note) AS rnote_g FROM tbl_tq_randomtest WHERE no_item='$r[no_item]' OR no_hanger='$r[no_hanger]'");
    $cekR=mysqli_num_rows($sqlCekR);
    $rcekR=mysqli_fetch_array($sqlCekR);
    $sqlCekD=mysqli_query($con,"SELECT *,
        CONCAT_WS(' ',dfc_note,dph_note, dabr_note, dbas_note, ddry_note, dfla_note, dfwe_note, dfwi_note, dburs_note,drepp_note,dwick_note,dabsor_note,dapper_note,dfiber_note,dpillb_note,dpillm_note,dpillr_note,dthick_note,dgrowth_note,drecover_note,dstretch_note,dsns_note,dsnab_note,dsnam_note,dsnap_note,dwash_note,dwater_note,dacid_note,dalkaline_note,dcrock_note,dphenolic_note,dcm_printing_note,dcm_dye_note,dlight_note,dlight_pers_note,dsaliva_note,dh_shrinkage_note,dfibre_note,dpilll_note,dsoil_note,dapperss_note,dbleeding_note,dchlorin_note,ddye_tf_note,dhumidity_note,dodour_note) AS dnote_g FROM tbl_tq_disptest WHERE id_nokk='$r[id_a]' ORDER BY id DESC LIMIT 1");
    $cekD=mysqli_num_rows($sqlCekD);
    $rcekD=mysqli_fetch_array($sqlCekD);
?>
         
<div class="modal-dialog modal1">
        <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Standard Water Fastness</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="hasil_test" class="col-md-2 control-label">Hasil Test</label>
                                <div class="col-md-8">
                                    <textarea name="hasil_test" class="form-control" placeholder="" rows="8"><?php if($r['water_colorchange']!="" or $rcekR['rwater_colorchange']!=""){?>Color Change= <?php if($r['stat_wtr']=="RANDOM"){echo $rcekR['rwater_colorchange'];}else if($r['stat_wtr']=="DISPOSISI"){echo $rcekD['dwater_colorchange'];}else{echo $r['water_colorchange'];}?><?php } ?>
                                    <?php if($r['water_acetate']!="" or $rcekR['rwater_acetate']!=""){?>&#13;&#10;Acetate= <?php if($r['stat_wtr']=="RANDOM"){echo $rcekR['rwater_acetate'];}else if($r['stat_wtr']=="DISPOSISI"){echo $rcekD['dwater_acetate'];}else{echo $r['water_acetate'];}?><?php } ?>
                                    <?php if($r['water_cotton']!="" or $rcekR['rwater_cotton']!=""){?>&#13;&#10;Cotton= <?php if($r['stat_wtr']=="RANDOM"){echo $rcekR['rwater_cotton'];}else if($r['stat_wtr']=="DISPOSISI"){echo $rcekD['dwater_cotton'];}else{echo $r['water_cotton'];}?><?php } ?>
                                    <?php if($r['water_nylon']!="" or $rcekR['rwater_nylon']!=""){?>&#13;&#10;Nylon= <?php if($r['stat_wtr']=="RANDOM"){echo $rcekR['rwater_nylon'];}else if($r['stat_wtr']=="DISPOSISI"){echo $rcekD['dwater_nylon'];}else{echo $r['water_nylon'];}?><?php } ?>
                                    <?php if($r['water_poly']!="" or $rcekR['rwater_poly']!=""){?>&#13;&#10;Polyester= <?php if($r['stat_wtr']=="RANDOM"){echo $rcekR['rwater_poly'];}else if($r['stat_wtr']=="DISPOSISI"){echo $rcekD['dwater_poly'];}else{echo $r['water_poly'];}?><?php } ?>
                                    <?php if($r['water_acrylic']!="" or $rcekR['rwater_acrylic']!=""){?>&#13;&#10;Acrylic= <?php if($r['stat_wtr']=="RANDOM"){echo $rcekR['rwater_acrylic'];}else if($r['stat_wtr']=="DISPOSISI"){echo $rcekD['dwater_acrylic'];}else{echo $r['water_acrylic'];}?><?php } ?>
                                    <?php if($r['water_wool']!="" or $rcekR['rwater_wool']!=""){?>&#13;&#10;Wool= <?php if($r['stat_wtr']=="RANDOM"){echo $rcekR['rwater_wool'];}else if($r['stat_wtr']=="DISPOSISI"){echo $rcekD['dwater_wool'];}else{echo $r['water_wool'];}?><?php } ?>
                                    <?php if($r['water_staining']!="" or $rcekR['rwater_staining']!=""){?>&#13;&#10;Staining= <?php if($r['stat_wtr']=="RANDOM"){echo $rcekR['rwater_staining'];}else if($r['stat_wtr']=="DISPOSISI"){echo $rcekD['dwater_staining'];}else{echo $r['water_staining'];}?><?php } ?>
                                    </textarea>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="wat" class="col-md-2 control-label">Standard</label>
                                <div class="col-md-8">
                                    <textarea name="wat" class="form-control" placeholder="" rows="8">4-5 Color Change &#13;&#10;4 Acetate &#13;&#10;4 Cotton &#13;&#10;4 Nylon &#13;&#10;4 Polyester &#13;&#10;4 Acrylic &#13;&#10;4 Wool
                                    </textarea>
                                </div>
                        </div>
		        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary" <?php if($_SESSION['lvl_id']!="LEADERTQ"){echo "disabled"; } ?> >Save Changes</button> -->
                    <!--<?php if($_SESSION['lvl_id']!="ADMIN"){echo "disabled"; } ?>-->
                </div>
            </form>
        </div>
            <!-- /.modal-content -->
</div>
          <!-- /.modal-dialog -->
          <?php } ?>