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
                        <h4 class="modal-title">Standard Snag Pod</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="hasil_test" class="col-md-2 control-label">Hasil Test</label>
                                <div class="col-md-8">
                                    <textarea name="hasil_test" class="form-control" placeholder="" rows="10">Len :<?php if($r['sp_grdl1']!="" or $rcekR['rsp_grdl1']!=""){?>&#13;&#10;L1, Grade= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_grdl1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_grdl1'];}else{echo $r['sp_grdl1'];}?><?php } ?>
                                    <?php if($r['sp_clsl1']!="" or $rcekR['rsp_clsl1']!=""){?>&#13;&#10;L1, Cls= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_clsl1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_clsl1'];}else{echo $r['sp_clsl1'];}?><?php } ?>
                                    <?php if($r['sp_shol1']!="" or $rcekR['rsp_shol1']!=""){?>&#13;&#10;L1, Sho= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_shol1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_shol1'];}else{echo $r['sp_shol1'];}?><?php } ?>
                                    <?php if($r['sp_medl1']!="" or $rcekR['rsp_medl1']!=""){?>&#13;&#10;L1, Med= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_medl1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_medl1'];}else{echo $r['sp_medl1'];}?><?php } ?>
                                    <?php if($r['sp_lonl1']!="" or $rcekR['rsp_lonl1']!=""){?>&#13;&#10;L1, Long= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_lonl1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_lonl1'];}else{echo $r['sp_lonl1'];}?><?php } ?>
                                    <?php if($r['sp_grdl2']!="" or $rcekR['rsp_grdl2']!=""){?>&#13;&#10;L2, Grade= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_grdl2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_grdl2'];}else{echo $r['sp_grdl2'];}?><?php } ?>
                                    <?php if($r['sp_clsl2']!="" or $rcekR['rsp_clsl2']!=""){?>&#13;&#10;L2, Cls= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_clsl2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_clsl2'];}else{echo $r['sp_clsl2'];}?><?php } ?>
                                    <?php if($r['sp_shol2']!="" or $rcekR['rsp_shol2']!=""){?>&#13;&#10;L2, Sho= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_shol2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_shol2'];}else{echo $r['sp_shol2'];}?><?php } ?>
                                    <?php if($r['sp_medl2']!="" or $rcekR['rsp_medl2']!=""){?>&#13;&#10;L2, Med= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_medl2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_medl2'];}else{echo $r['sp_medl2'];}?><?php } ?>
                                    <?php if($r['sp_lonl2']!="" or $rcekR['rsp_lonl2']!=""){?>&#13;&#10;L2, Long= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_lonl2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_lonl2'];}else{echo $r['sp_lonl2'];}?><?php } ?>

                                    &#13;&#10;Width :<?php if($r['sp_grdw1']!="" or $rcekR['rsp_grdw1']!=""){?>&#13;&#10;W1, Grade= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_grdw1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_grdw1'];}else{echo $r['sp_grdw1'];}?><?php } ?>
                                    <?php if($r['sp_clsw1']!="" or $rcekR['rsp_clsw1']!=""){?>&#13;&#10;W1, Cls= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_clsw1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_clsw1'];}else{echo $r['sp_clsw1'];}?><?php } ?>
                                    <?php if($r['sp_show1']!="" or $rcekR['rsp_show1']!=""){?>&#13;&#10;W1, Sho= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_show1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_show1'];}else{echo $r['sp_show1'];}?><?php } ?>
                                    <?php if($r['sp_medw1']!="" or $rcekR['rsp_medw1']!=""){?>&#13;&#10;W1, Med= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_medw1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_medw1'];}else{echo $r['sp_medw1'];}?><?php } ?>
                                    <?php if($r['sp_lonw1']!="" or $rcekR['rsp_lonw1']!=""){?>&#13;&#10;W1, Long= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_lonw1'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_lonw1'];}else{echo $r['sp_lonw1'];}?><?php } ?>
                                    <?php if($r['sp_grdw2']!="" or $rcekR['rsp_grdw2']!=""){?>&#13;&#10;W2, Grade= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_grdw2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_grdw2'];}else{echo $r['sp_grdw2'];}?><?php } ?>
                                    <?php if($r['sp_clsw2']!="" or $rcekR['rsp_clsw2']!=""){?>&#13;&#10;W2, Cls= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_clsw2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_clsw2'];}else{echo $r['sp_clsw2'];}?><?php } ?>
                                    <?php if($r['sp_show2']!="" or $rcekR['rsp_show2']!=""){?>&#13;&#10;W2, Sho= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_show2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_show2'];}else{echo $r['sp_show2'];}?><?php } ?>
                                    <?php if($r['sp_medw2']!="" or $rcekR['rsp_medw2']!=""){?>&#13;&#10;W2, Med= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_medw2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_medw2'];}else{echo $r['sp_medw2'];}?><?php } ?>
                                    <?php if($r['sp_lonw2']!="" or $rcekR['rsp_lonw2']!=""){?>&#13;&#10;W2, Long= <?php if($r['stat_sp']=="RANDOM"){echo $rcekR['rsp_lonw2'];}else if($r['stat_sp']=="DISPOSISI"){echo $rcekD['dsp_lonw2'];}else{echo $r['sp_lonw2'];}?><?php } ?>
                                    </textarea>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="sp" class="col-md-2 control-label">Standard</label>
                                <div class="col-md-8">
                                    <textarea name="sp" class="form-control" placeholder="" rows="15">Face Side_Length_Grade &ge;3.5 (3 for > 8% EL) &#13;&#10;Face Side_Length_Classification &#13;&#10;Face Side_Length_#Snags< 2mm &#13;&#10;Face Side_Length_#Snags 2mm-5mm &#13;&#10;Face Side_Length_#Snags>5mm 
                                    &#13;&#10;Face Side_Width_Grade &ge;3.5 (3 for > 8% EL) &#13;&#10;Face Side_Width_Classification &#13;&#10;Face Side_Width_#Snags< 2mm &#13;&#10;Face Side_Width_#Snags 2mm-5mm &#13;&#10;Face Side_Width_#Snags>5mm 
                                    &#13;&#10;Back Side_Length_Defect on Faceside &#13;&#10;Back Side_Width_Defect on Faceside
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