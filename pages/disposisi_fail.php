<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$id=$_GET['id'];
$qryt=mysqli_query($con,"SELECT a.no_test,b.* from db_qc.tbl_tq_nokk a 
left join db_qc.tbl_tq_test b on a.id = b.id_nokk where a.id ='$id'");
$rcek1=mysqli_fetch_array($qryt);	

$qrydis=mysqli_query($con,"SELECT * from db_qc.tbl_tq_disptest where id_nokk ='$id'");
$rcekD=mysqli_fetch_array($qrydis);
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Test Disposisi dan Fail</h4>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-bordered table-hover table-striped" border="0" width="100%">
                    <thead>
                        <tr>
                            <th align="center" width="20%">Nama Test</th>
                            <th align="center" width="15%">Status</th>
                            <th align="center" width="25%">Hasil Disposisi</th>
                            <th align="center" width="25%">Hasil Aktual/Fail</th>
                        </tr>
                    </thead>
                    <tbody> 
                    <?php if($rcek1['stat_fla']=='DISPOSISI' or $rcek1['stat_fla']=='FAIL'){ ?>
                        <tr>
                            <td align="center">FLAMMABILITY</td>
                            <td align="center"><?php echo $rcek1['stat_fla'];?></td>
                            <td align="left"><?php if($rcek1['stat_fla']=='DISPOSISI'){echo $rcekD['dflamability'];}?></td>
                            <td align="left"><?php if($rcek1['stat_fla']=='FAIL' or $rcek1['stat_fla']=='DISPOSISI'){echo $rcek1['flamability'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_fib']=='DISPOSISI' or $rcek1['stat_fib']=='FAIL'){ ?>
                        <tr>
                            <td align="center">FIBER CONTENT</td>
                            <td align="center"><?php echo $rcek1['stat_fib'];?></td>
                            <td align="left"><?php if($rcek1['stat_fib']=='DISPOSISI'){if($rcekD['dfc_cott']!=""){echo $rcekD['dfc_cott']."% ".$rcekD['dfc_cott1']." ";} if($rcekD['dfc_poly']!=""){echo $rcekD['dfc_poly']."% ".$rcekD['dfc_poly1']." ";} if($rcekD['dfc_elastane']!=""){echo $rcekD['dfc_elastane']."% ".$rcekD['dfc_elastane1']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_fib']=='FAIL' or $rcek1['stat_fla']=='DISPOSISI'){if($rcek1['fc_cott']!=""){echo $rcek1['fc_cott']."% ".$rcek1['fc_cott1']." ";} if($rcek1['fc_poly']!=""){echo $rcek1['fc_poly']."% ".$rcek1['fc_poly1']." ";} if($rcek1['fc_elastane']!=""){echo $rcek1['fc_elastane']."% ".$rcek1['fc_elastane1']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_fc']=='DISPOSISI' or $rcek1['stat_fc']=='FAIL'){ ?>
                        <tr>
                            <td align="center">FABRIC COUNT</td>
                            <td align="center"><?php echo $rcek1['stat_fc'];?></td>
                            <td align="left"><?php if($rcek1['stat_fc']=='DISPOSISI'){echo "W : ".$rcekD['dfc_wpi'];}?> <br/> <?php if($rcek1['stat_fc']=='DISPOSISI'){echo "C : ".$rcekD['dfc_cpi'];}?></td>
                            <td align="left"><?php if($rcek1['stat_fc']=='FAIL' or $rcek1['stat_fc']=='DISPOSISI'){echo "W : ".$rcek1['fc_wpi'];}?> <br/> <?php if($rcek1['stat_fc']=='FAIL' or $rcek1['stat_fc']=='DISPOSISI'){echo "C : ".$rcek1['fc_cpi'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_fwss']=='DISPOSISI' or $rcek1['stat_fwss']=='FAIL'){ ?>
                        <tr>
                            <td align="center">SHRINKAGE & SPIRALITY</td>
                            <td align="center"><?php echo $rcek1['stat_fwss'];?></td>
                            <td align="left"><?php if($rcek1['stat_fwss']=='DISPOSISI'){if($rcekD['dshrinkage_l1']!=''){echo "L1 : ".$rcekD['dshrinkage_l1']." ";} if($rcekD['dshrinkage_l2']!=''){echo "L2 : ".$rcekD['dshrinkage_l2']." ";} if($rcekD['dshrinkage_l3']!=''){echo "L3 : ".$rcekD['dshrinkage_l3']." ";} if($rcekD['dshrinkage_l4']!=''){echo "L4 : ".$rcekD['dshrinkage_l4']." ";} if($rcekD['dshrinkage_l5']!=''){echo "L5 : ".$rcekD['dshrinkage_l5']." ";} if($rcekD['dshrinkage_l6']!=''){echo "L6 : ".$rcekD['dshrinkage_l6']." ";} }?> <br /><?php if($rcek1['stat_fwss']=='DISPOSISI'){if($rcekD['dshrinkage_w1']!=''){echo "W1 : ".$rcekD['dshrinkage_w1']." ";} if($rcekD['dshrinkage_w2']!=''){echo "W2 : ".$rcekD['dshrinkage_w2']." ";} if($rcekD['dshrinkage_w3']!=''){echo "W3 : ".$rcekD['dshrinkage_w3']." ";} if($rcekD['dshrinkage_w4']!=''){echo "W4 : ".$rcekD['dshrinkage_w4']." ";} if($rcekD['dshrinkage_w5']!=''){echo "W5 : ".$rcekD['dshrinkage_w5']." ";} if($rcekD['dshrinkage_w6']!=''){echo "W6 : ".$rcekD['dshrinkage_w6']." ";} }?> <br/> <?php if($rcek1['stat_fwss']=='DISPOSISI'){if($rcekD['dspirality1']!=''){echo "Spirality 1 : ".$rcekD['dspirality1']." ";} if($rcekD['dspirality2']!=''){echo "Spirality 2 : ".$rcekD['dspirality2']." ";} if($rcekD['dspirality3']!=''){echo "Spirality 3 : ".$rcekD['dspirality3']." ";} if($rcekD['dspirality4']!=''){echo "Spirality 4 : ".$rcekD['dspirality4']." ";} if($rcekD['dspirality5']!=''){echo "Spirality 5 : ".$rcekD['dspirality5']." ";} if($rcekD['dspirality6']!=''){echo "Spirality 6 : ".$rcekD['dspirality6']." ";} }?></td>
                            <td align="left"><?php if($rcek1['stat_fwss']=='FAIL' or $rcek1['stat_fwss']=='DISPOSISI'){if($rcek1['shrinkage_l1']!=''){echo "L1 : ".$rcek1['shrinkage_l1']." ";} if($rcek1['shrinkage_l2']!=''){echo "L2 : ".$rcek1['shrinkage_l2']." ";} if($rcek1['shrinkage_l3']!=''){echo "L3 : ".$rcek1['shrinkage_l3']." ";} if($rcek1['shrinkage_l4']!=''){echo "L4 : ".$rcek1['shrinkage_l4']." ";} if($rcek1['shrinkage_l5']!=''){echo "L5 : ".$rcek1['shrinkage_l5']." ";} if($rcek1['shrinkage_l6']!=''){echo "L6 : ".$rcek1['shrinkage_l6']." ";} }?> <br /><?php if($rcek1['stat_fwss']=='FAIL' or $rcek1['stat_fwss']=='DISPOSISI'){if($rcek1['shrinkage_w1']!=''){echo "W1 : ".$rcek1['shrinkage_w1']." ";} if($rcek1['shrinkage_w2']!=''){echo "W2 : ".$rcek1['shrinkage_w2']." ";} if($rcek1['shrinkage_w3']!=''){echo "W3 : ".$rcek1['shrinkage_w3']." ";} if($rcek1['shrinkage_w4']!=''){echo "W4 : ".$rcek1['shrinkage_w4']." ";} if($rcek1['shrinkage_w5']!=''){echo "W5 : ".$rcek1['shrinkage_w5']." ";} if($rcek1['shrinkage_w6']!=''){echo "W6 : ".$rcek1['shrinkage_w6']." ";} }?> <br/> <?php if($rcek1['stat_fwss']=='FAIL' or $rcek1['stat_fwss']=='DISPOSISI'){if($rcek1['spirality1']!=''){echo "Spirality 1 : ".$rcek1['spirality1']." ";} if($rcek1['spirality2']!=''){echo "Spirality 2 : ".$rcek1['spirality2']." ";} if($rcek1['spirality3']!=''){echo "Spirality 3 : ".$rcek1['spirality3']." ";} if($rcek1['spirality4']!=''){echo "Spirality 4 : ".$rcek1['spirality4']." ";} if($rcek1['spirality5']!=''){echo "Spirality 5 : ".$rcek1['spirality5']." ";} if($rcek1['spirality6']!=''){echo "Spirality 6 : ".$rcek1['spirality6']." ";} }?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_fwss2']=='DISPOSISI' or $rcek1['stat_fwss2']=='FAIL'){ ?>
                        <tr>
                            <td align="center">FABRIC WEIGHT</td>
                            <td align="center"><?php echo $rcek1['stat_fwss2'];?></td>
                            <td align="left"><?php if($rcek1['stat_fwss2']=='DISPOSISI'){echo $rcekD['df_weight'];}?></td>
                            <td align="left"><?php if($rcek1['stat_fwss2']=='FAIL' or $rcek1['stat_fwss2']=='DISPOSISI'){echo $rcek1['f_weight'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_fwss3']=='DISPOSISI' or $rcek1['stat_fwss3']=='FAIL'){ ?>
                        <tr>
                            <td align="center">FABRIC WIDTH</td>
                            <td align="center"><?php echo $rcek1['stat_fwss3'];?></td>
                            <td align="left"><?php if($rcek1['stat_fwss3']=='DISPOSISI'){echo $rcekD['df_width'];}?></td>
                            <td align="left"><?php if($rcek1['stat_fwss3']=='FAIL' or $rcek1['stat_fwss3']=='DISPOSISI'){echo $rcek1['f_width'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_bsk']=='DISPOSISI' or $rcek1['stat_bsk']=='FAIL'){ ?>
                        <tr>
                            <td align="center">BOW & SKEW</td>
                            <td align="center"><?php echo $rcek1['stat_bsk'];?></td>
                            <td align="left"><?php if($rcek1['stat_bsk']=='DISPOSISI'){echo "Bow : ".$rcekD['dbow'];}?> <br/> <?php if($rcek1['stat_bsk']=='DISPOSISI'){echo "Skew : ".$rcekD['dskew'];}?></td>
                            <td align="left"><?php if($rcek1['stat_bsk']=='FAIL' or $rcek1['stat_bsk']=='DISPOSISI'){echo "Bow : ".$rcek1['bow'];}?> <br/> <?php if($rcek1['stat_bsk']=='FAIL' or $rcek1['stat_bsk']=='DISPOSISI'){echo "Skew : ".$rcek1['skew'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_pm']=='DISPOSISI' or $rcek1['stat_pm']=='FAIL'){ ?>
                        <tr>
                            <td align="center">PILLING MARTINDLE</td>
                            <td align="center"><?php echo $rcek1['stat_pm'];?></td>
                            <td align="left"><?php if($rcek1['stat_pm']=='DISPOSISI'){if($rcekD['dpm_f1']!=''){echo "Face 1 : ".$rcekD['dpm_f1']." ";} 
                                                                                 if($rcekD['dpm_f2']!=''){echo "Face 2 : ".$rcekD['dpm_f2']." ";} 
                                                                                 if($rcekD['dpm_f3']!=''){echo "Face 3 : ".$rcekD['dpm_f3']." ";} 
                                                                                 if($rcekD['dpm_f4']!=''){echo "Face 4 : ".$rcekD['dpm_f4']." ";} 
                                                                                 if($rcekD['dpm_f5']!=''){echo "Face 5 : ".$rcekD['dpm_f5']." ";}} ?> <br/> 
                                            <?php if($rcek1['stat_pm']=='DISPOSISI'){if($rcekD['dpm_b1']!=''){echo "Back 1 : ".$rcekD['dpm_b1']." ";} 
                                                                                if($rcekD['dpm_b2']!=''){echo "Back 2 : ".$rcekD['dpm_b2']." ";} 
                                                                                if($rcekD['dpm_b3']!=''){echo "Back 3 : ".$rcekD['dpm_b3']." ";} 
                                                                                if($rcekD['dpm_b4']!=''){echo "Back 4 : ".$rcekD['dpm_b4']." ";} 
                                                                                if($rcekD['dpm_b5']!=''){echo "Back 5 : ".$rcekD['dpm_b5']." ";}} ?></td>
                            <td align="left"><?php if($rcek1['stat_pm']=='FAIL' or $rcek1['stat_pm']=='DISPOSISI'){if($rcek1['pm_f1']!=''){echo "Face 1 : ".$rcek1['pm_f1']." ";} 
                                                                                 if($rcek1['pm_f2']!=''){echo "Face 2 : ".$rcek1['pm_f2']." ";} 
                                                                                 if($rcek1['pm_f3']!=''){echo "Face 3 : ".$rcek1['pm_f3']." ";} 
                                                                                 if($rcek1['pm_f4']!=''){echo "Face 4 : ".$rcek1['pm_f4']." ";} 
                                                                                 if($rcek1['pm_f5']!=''){echo "Face 5 : ".$rcek1['pm_f5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_pm']=='FAIL' or $rcek1['stat_pm']=='DISPOSISI'){if($rcek1['pm_b1']!=''){echo "Back 1 : ".$rcek1['pm_b1']." ";} 
                                                                                if($rcek1['pm_b2']!=''){echo "Back 2 : ".$rcek1['pm_b2']." ";} 
                                                                                if($rcek1['pm_b3']!=''){echo "Back 3 : ".$rcek1['pm_b3']." ";} 
                                                                                if($rcek1['pm_b4']!=''){echo "Back 4 : ".$rcek1['pm_b4']." ";} 
                                                                                if($rcek1['pm_b5']!=''){echo "Back 5 : ".$rcek1['pm_b5']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_pl']=='DISPOSISI' or $rcek1['stat_pl']=='FAIL'){ ?>
                        <tr>
                            <td align="center">PILLING LOCUS</td>
                            <td align="center"><?php echo $rcek1['stat_pl'];?></td>
                            <td align="left"><?php if($rcek1['stat_pl']=='DISPOSISI'){if($rcekD['dpl_f1']!=''){echo "Face 1 : ".$rcekD['dpl_f1']." ";} 
                                                                                 if($rcekD['dpl_f2']!=''){echo "Face 2 : ".$rcekD['dpl_f2']." ";} 
                                                                                 if($rcekD['dpl_f3']!=''){echo "Face 3 : ".$rcekD['dpl_f3']." ";} 
                                                                                 if($rcekD['dpl_f4']!=''){echo "Face 4 : ".$rcekD['dpl_f4']." ";} 
                                                                                 if($rcekD['dpl_f5']!=''){echo "Face 5 : ".$rcekD['dpl_f5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_pl']=='DISPOSISI'){if($rcekD['dpl_b1']!=''){echo "Back 1 : ".$rcekD['dpl_b1']." ";} 
                                                                                if($rcekD['dpl_b2']!=''){echo "Back 2 : ".$rcekD['dpl_b2']." ";} 
                                                                                if($rcekD['dpl_b3']!=''){echo "Back 3 : ".$rcekD['dpl_b3']." ";} 
                                                                                if($rcekD['dpl_b4']!=''){echo "Back 4 : ".$rcekD['dpl_b4']." ";} 
                                                                                if($rcekD['dpl_b5']!=''){echo "Back 5 : ".$rcekD['dpl_b5']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_pl']=='FAIL' or $rcek1['stat_pl']=='DISPOSISI'){if($rcek1['pl_f1']!=''){echo "Face 1 : ".$rcek1['pl_f1']." ";} 
                                                                                 if($rcek1['pl_f2']!=''){echo "Face 2 : ".$rcek1['pl_f2']." ";} 
                                                                                 if($rcek1['pl_f3']!=''){echo "Face 3 : ".$rcek1['pl_f3']." ";} 
                                                                                 if($rcek1['pl_f4']!=''){echo "Face 4 : ".$rcek1['pl_f4']." ";} 
                                                                                 if($rcek1['pl_f5']!=''){echo "Face 5 : ".$rcek1['pl_f5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_pl']=='FAIL' or $rcek1['stat_pl']=='DISPOSISI'){if($rcek1['pl_b1']!=''){echo "Back 1 : ".$rcek1['pl_b1']." ";} 
                                                                                if($rcek1['pl_b2']!=''){echo "Back 2 : ".$rcek1['pl_b2']." ";} 
                                                                                if($rcek1['pl_b3']!=''){echo "Back 3 : ".$rcek1['pl_b3']." ";} 
                                                                                if($rcek1['pl_b4']!=''){echo "Back 4 : ".$rcek1['pl_b4']." ";} 
                                                                                if($rcek1['pl_b5']!=''){echo "Back 5 : ".$rcek1['pl_b5']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_pb']=='DISPOSISI' or $rcek1['stat_pb']=='FAIL'){ ?>
                        <tr>
                            <td align="center">PILLING BOX</td>
                            <td align="center"><?php echo $rcek1['stat_pb'];?></td>
                            <td align="left"><?php if($rcek1['stat_pb']=='DISPOSISI'){if($rcekD['dpb_f1']!=''){echo "FACE 1/PILLING : ".$rcekD['dpb_f1']." ";} if($rcekD['dpb_b1']!=''){echo "BACK 1 : ".$rcekD['dpb_b1']." ";}}?> <br/> <?php if($rcek1['stat_pb']=='DISPOSISI'){if($rcekD['dpb_f2']!=''){echo "FACE 2/FUZZING : ".$rcekD['dpb_f2']." ";}}?> <br/> <?php if($rcek1['stat_pb']=='DISPOSISI'){if($rcekD['dpb_f3']!=''){echo "FACE 3/MATTING : ".$rcekD['dpb_f3']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_pb']=='FAIL' or $rcek1['stat_pb']=='DISPOSISI'){if($rcek1['pb_f1']!=''){echo "FACE 1/PILLING : ".$rcek1['pb_f1']." ";} if($rcek1['pb_b1']!=''){echo "BACK 1 : ".$rcek1['pb_b1']." ";}}?> <br/> <?php if($rcek1['stat_pb']=='FAIL' or $rcek1['stat_pb']=='DISPOSISI'){if($rcek1['pb_f2']!=''){echo "FACE 2/FUZZING : ".$rcek1['pb_f2']." ";}}?> <br/> <?php if($rcek1['stat_pb']=='FAIL' or $rcek1['stat_pb']=='DISPOSISI'){if($rcek1['pb_f3']!=''){echo "FACE 3/MATTING : ".$rcek1['pb_f3']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_prt']=='DISPOSISI' or $rcek1['stat_prt']=='FAIL'){ ?>
                        <tr>
                            <td align="center">PILLING RANDOM TUMBLER</td>
                            <td align="center"><?php echo $rcek1['stat_prt'];?></td>
                            <td align="left"><?php if($rcek1['stat_prt']=='DISPOSISI'){if($rcekD['dprt_f1']!=''){echo "Face 1 : ".$rcekD['dprt_f1']." ";} 
                                                                                 if($rcekD['dprt_f2']!=''){echo "Face 2 : ".$rcekD['dprt_f2']." ";} 
                                                                                 if($rcekD['dprt_f3']!=''){echo "Face 3 : ".$rcekD['dprt_f3']." ";} 
                                                                                 if($rcekD['dprt_f4']!=''){echo "Face 4 : ".$rcekD['dprt_f4']." ";} 
                                                                                 if($rcekD['dprt_f5']!=''){echo "Face 5 : ".$rcekD['dprt_f5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_prt']=='DISPOSISI'){if($rcekD['dprt_b1']!=''){echo "Back 1 : ".$rcekD['dprt_b1']." ";} 
                                                                                if($rcekD['dprt_b2']!=''){echo "Back 2 : ".$rcekD['dprt_b2']." ";} 
                                                                                if($rcekD['dprt_b3']!=''){echo "Back 3 : ".$rcekD['dprt_b3']." ";} 
                                                                                if($rcekD['dprt_b4']!=''){echo "Back 4 : ".$rcekD['dprt_b4']." ";} 
                                                                                if($rcekD['dprt_b5']!=''){echo "Back 5 : ".$rcekD['dprt_b5']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_prt']=='FAIL' or $rcek1['stat_prt']=='DISPOSISI'){if($rcek1['prt_f1']!=''){echo "Face 1 : ".$rcek1['prt_f1']." ";} 
                                                                                 if($rcek1['prt_f2']!=''){echo "Face 2 : ".$rcek1['prt_f2']." ";} 
                                                                                 if($rcek1['prt_f3']!=''){echo "Face 3 : ".$rcek1['prt_f3']." ";} 
                                                                                 if($rcek1['prt_f4']!=''){echo "Face 4 : ".$rcek1['prt_f4']." ";} 
                                                                                 if($rcek1['prt_f5']!=''){echo "Face 5 : ".$rcek1['prt_f5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_prt']=='FAIL' or $rcek1['stat_prt']=='DISPOSISI'){if($rcek1['prt_b1']!=''){echo "Back 1 : ".$rcek1['prt_b1']." ";} 
                                                                                if($rcek1['prt_b2']!=''){echo "Back 2 : ".$rcek1['prt_b2']." ";} 
                                                                                if($rcek1['prt_b3']!=''){echo "Back 3 : ".$rcek1['prt_b3']." ";} 
                                                                                if($rcek1['prt_b4']!=''){echo "Back 4 : ".$rcek1['prt_b4']." ";} 
                                                                                if($rcek1['prt_b5']!=''){echo "Back 5 : ".$rcek1['prt_b5']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_abr']=='DISPOSISI' or $rcek1['stat_abr']=='FAIL'){ ?>
                        <tr>
                            <td align="center">ABRATION</td>
                            <td align="center"><?php echo $rcek1['stat_abr'];?></td>
                            <td align="left"><?php if($rcek1['stat_abr']=='DISPOSISI'){echo $rcek1['abration'];}?></td>
                            <td align="left"><?php if($rcek1['stat_abr']=='FAIL' or $rcek1['stat_abr']=='DISPOSISI'){echo $rcek1['abration'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_sm']=='DISPOSISI' or $rcek1['stat_sm']=='FAIL'){ ?>
                        <tr>
                            <td align="center">SNAGGING MACE</td>
                            <td align="center"><?php echo $rcek1['stat_sm'];?></td>
                            <td align="left"><?php if($rcek1['stat_sm']=='DISPOSISI'){if($rcekD['dsm_l1']!=''){echo "Len 1 : ".$rcekD['dsm_l1']." ";} 
                                                                                 if($rcekD['dsm_l2']!=''){echo "Len 2 : ".$rcekD['dsm_l2']." ";} 
                                                                                 if($rcekD['dsm_l3']!=''){echo "Len 3 : ".$rcekD['dsm_l3']." ";} 
                                                                                 if($rcekD['dsm_l4']!=''){echo "Len 4 : ".$rcekD['dsm_l4']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sm']=='DISPOSISI'){if($rcekD['dsm_w1']!=''){echo "Wid 1 : ".$rcekD['dsm_w1']." ";} 
                                                                                if($rcekD['dsm_w2']!=''){echo "Wid 2 : ".$rcekD['dsm_w2']." ";} 
                                                                                if($rcekD['dsm_w3']!=''){echo "Wid 3 : ".$rcekD['dsm_w3']." ";} 
                                                                                if($rcekD['dsm_w4']!=''){echo "Wid 4 : ".$rcekD['dsm_w4']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_sm']=='FAIL' or $rcek1['stat_sm']=='DISPOSISI'){if($rcek1['sm_l1']!=''){echo "Len 1 : ".$rcek1['sm_l1']." ";} 
                                                                                 if($rcek1['sm_l2']!=''){echo "Len 2 : ".$rcek1['sm_l2']." ";} 
                                                                                 if($rcek1['sm_l3']!=''){echo "Len 3 : ".$rcek1['sm_l3']." ";} 
                                                                                 if($rcek1['sm_l4']!=''){echo "Len 4 : ".$rcek1['sm_l4']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sm']=='FAIL' or $rcek1['stat_sm']=='DISPOSISI'){if($rcek1['sm_w1']!=''){echo "Wid 1 : ".$rcek1['sm_w1']." ";} 
                                                                                if($rcek1['sm_w2']!=''){echo "Wid 2 : ".$rcek1['sm_w2']." ";} 
                                                                                if($rcek1['sm_w3']!=''){echo "Wid 3 : ".$rcek1['sm_w3']." ";} 
                                                                                if($rcek1['sm_w4']!=''){echo "Wid 4 : ".$rcek1['sm_w4']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_sp']=='DISPOSISI' or $rcek1['stat_sp']=='FAIL'){ ?>
                        <tr>
                            <td align="center">SNAGGING POD</td>
                            <td align="center"><?php echo $rcek1['stat_sp'];?></td>
                            <td align="left"><?php if($rcek1['stat_sp']=='DISPOSISI'){if($rcekD['dsp_grdl1']!=''){echo "Grade Len 1 : ".$rcekD['dsp_grdl1']." ";} 
                                                                                 if($rcekD['dsp_clsl1']!=''){echo "Class Len 1 : ".$rcekD['dsp_clsl1']." ";} 
                                                                                 if($rcekD['dsp_shol1']!=''){echo "Short Len 1 : ".$rcekD['dsp_shol1']." ";} 
                                                                                 if($rcekD['dsp_medl1']!=''){echo "Medium Len 1 : ".$rcekD['dsp_medl1']." ";} 
                                                                                 if($rcekD['dsp_lonl1']!=''){echo "Long Len 1 : ".$rcekD['dsp_lonl1']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sp']=='DISPOSISI'){if($rcekD['dsp_grdw1']!=''){echo "Grade Wid 1 : ".$rcekD['dsp_grdw1']." ";} 
                                                                                if($rcekD['dsp_clsw1']!=''){echo "Class Wid 1 : ".$rcekD['dsp_clsw1']." ";} 
                                                                                if($rcekD['dsp_show1']!=''){echo "Short Wid 1 : ".$rcekD['dsp_show1']." ";} 
                                                                                if($rcekD['dsp_medw1']!=''){echo "Medium Wid 1 : ".$rcekD['dsp_medw1']." ";} 
                                                                                if($rcekD['dsp_lonw1']!=''){echo "Long Wid 1 : ".$rcekD['dsp_lonw1']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_sp']=='FAIL' or $rcek1['stat_sp']=='DISPOSISI'){if($rcek1['sp_grdl1']!=''){echo "Grade Len 1 : ".$rcek1['sp_grdl1']." ";} 
                                                                                 if($rcek1['sp_clsl1']!=''){echo "Class Len 1 : ".$rcek1['sp_clsl1']." ";} 
                                                                                 if($rcek1['sp_shol1']!=''){echo "Short Len 1 : ".$rcek1['sp_shol1']." ";} 
                                                                                 if($rcek1['sp_medl1']!=''){echo "Medium Len 1 : ".$rcek1['sp_medl1']." ";} 
                                                                                 if($rcek1['sp_lonl1']!=''){echo "Long Len 1 : ".$rcek1['sp_lonl1']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sp']=='FAIL' or $rcek1['stat_sp']=='DISPOSISI'){if($rcek1['sp_grdw1']!=''){echo "Grade Wid 1 : ".$rcek1['sp_grdw1']." ";} 
                                                                                if($rcek1['sp_clsw1']!=''){echo "Class Wid 1 : ".$rcek1['sp_clsw1']." ";} 
                                                                                if($rcek1['sp_show1']!=''){echo "Short Wid 1 : ".$rcek1['sp_show1']." ";} 
                                                                                if($rcek1['sp_medw1']!=''){echo "Medium Wid 1 : ".$rcek1['sp_medw1']." ";} 
                                                                                if($rcek1['sp_lonw1']!=''){echo "Long Wid 1 : ".$rcek1['sp_lonw1']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_sb']=='DISPOSISI' or $rcek1['stat_sb']=='FAIL'){ ?>
                        <tr>
                            <td align="center">BEAN BAG</td>
                            <td align="center"><?php echo $rcek1['stat_sb'];?></td>
                            <td align="left"><?php if($rcek1['stat_sb']=='DISPOSISI'){echo "Len : ".$rcekD['dsb_l1']." ";}?> <br/> <?php if($rcek1['stat_sb']=='DISPOSISI'){echo "Wid : ".$rcekD['dsb_w1'];}?></td>
                            <td align="left"><?php if($rcek1['stat_sb']=='FAIL' or $rcek1['stat_sb']=='DISPOSISI'){echo "Len : ".$rcek1['sb_l1']." ";}?> <br/> <?php if($rcek1['stat_sb']=='FAIL' or $rcek1['stat_sb']=='DISPOSISI'){echo "Wid : ".$rcek1['sb_w1'];}?></td>
                            
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_bs']=='DISPOSISI' or $rcek1['stat_bs']=='FAIL'){ ?>
                        <tr>
                            <td align="center">BURSTING STRENGTH (TRU BURST)</td>
                            <td align="center"><?php echo $rcek1['stat_bs'];?></td>
                            <td align="left"><?php if($rcek1['stat_bs']=='DISPOSISI'){echo $rcekD['dbs_tru'];}?></td>
                            <td align="left"><?php if($rcek1['stat_bs']=='FAIL' or $rcek1['stat_bs']=='DISPOSISI'){echo $rcek1['bs_tru'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_bs2']=='DISPOSISI' or $rcek1['stat_bs2']=='FAIL'){ ?>
                        <tr>
                            <td align="center">BURSTING STRENGTH (INSTRON)</td>
                            <td align="center"><?php echo $rcek1['stat_bs2'];?></td>
                            <td align="left"><?php if($rcek1['stat_bs2']=='DISPOSISI'){echo $rcekD['dbs_instron'];}?></td>
                            <td align="left"><?php if($rcek1['stat_bs2']=='FAIL' or $rcek1['stat_bs2']=='DISPOSISI'){echo $rcek1['bs_instron'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_bs3']=='DISPOSISI' or $rcek1['stat_bs3']=='FAIL'){ ?>
                        <tr>
                            <td align="center">BURSTING STRENGTH (MULLEN)</td>
                            <td align="center"><?php echo $rcek1['stat_bs3'];?></td>
                            <td align="left"><?php if($rcek1['stat_bs3']=='DISPOSISI'){echo $rcekD['dbs_mullen'];}?></td>
                            <td align="left"><?php if($rcek1['stat_bs3']=='FAIL' or $rcek1['stat_bs3']=='DISPOSISI'){echo $rcek1['bs_mullen'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_th']=='DISPOSISI' or $rcek1['stat_th']=='FAIL'){ ?>
                        <tr>
                            <td align="center">PILLING BOX</td>
                            <td align="center"><?php echo $rcek1['stat_th'];?></td>
                            <td align="left"><?php if($rcek1['stat_th']=='DISPOSISI'){if($rcekD['dthick1']!=''){echo "1 : ".$rcekD['dthick1'];} }?> <br/> <?php if($rcek1['stat_th']=='DISPOSISI'){if($rcekD['dthick2']!=''){echo "2 : ".$rcekD['dthick2'];}}?> <br/> <?php if($rcek1['stat_th']=='DISPOSISI'){if($rcekD['dthick3']!=''){echo "3 : ".$rcekD['dthick3'];}}?> <br/> <?php if($rcek1['stat_th']=='DISPOSISI'){if($rcekD['dthickav']!=''){echo "AV : ".$rcekD['dthickav'];}}?></td>
                            <td align="left"><?php if($rcek1['stat_th']=='FAIL' or $rcek1['stat_th']=='DISPOSISI'){if($rcek1['thick1']!=''){echo "1 : ".$rcek1['thick1'];} }?> <br/> <?php if($rcek1['stat_th']=='FAIL' or $rcek1['stat_th']=='DISPOSISI'){if($rcek1['thick2']!=''){echo "2 : ".$rcek1['thick2'];}}?> <br/> <?php if($rcek1['stat_th']=='FAIL' or $rcek1['stat_th']=='DISPOSISI'){if($rcek1['thick3']!=''){echo "3 : ".$rcek1['thick3'];}}?> <br/> <?php if($rcek1['stat_th']=='FAIL' or $rcek1['stat_th']=='DISPOSISI'){if($rcek1['thickav']!=''){echo "AV : ".$rcek1['thickav'];}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_sr']=='DISPOSISI' or $rcek1['stat_sr']=='FAIL'){ ?>
                        <tr>
                            <td align="center">STRETCH & RECOVERY</td>
                            <td align="center"><?php echo $rcek1['stat_sr'];?></td>
                            <td align="left"><?php if($rcek1['stat_sr']=='DISPOSISI'){if($rcekD['dstretch_l1']!=''){echo "Stretch Len 1 : ".$rcekD['dstretch_l1']." ";} 
                                                                                 if($rcekD['dstretch_l2']!=''){echo "Stretch Len 2 : ".$rcekD['dstretch_l2']." ";} 
                                                                                 if($rcekD['dstretch_l3']!=''){echo "Stretch Len 3 : ".$rcekD['dstretch_l3']." ";} 
                                                                                 if($rcekD['dstretch_l4']!=''){echo "Stretch Len 4 : ".$rcekD['dstretch_l4']." ";} 
                                                                                 if($rcekD['dstretch_l5']!=''){echo "Stretch Len 5 : ".$rcekD['dstretch_l5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sr']=='DISPOSISI'){if($rcekD['dstretch_w1']!=''){echo "Stretch Wid 1 : ".$rcekD['dstretch_w1']." ";} 
                                                                                if($rcekD['dstretch_w2']!=''){echo "Stretch Wid 2 : ".$rcekD['dstretch_w2']." ";} 
                                                                                if($rcekD['dstretch_w3']!=''){echo "Stretch Wid 3 : ".$rcekD['dstretch_w3']." ";} 
                                                                                if($rcekD['dstretch_w4']!=''){echo "Stretch Wid 4 : ".$rcekD['dstretch_w4']." ";} 
                                                                                if($rcekD['dstretch_w5']!=''){echo "Stretch Wid 5 : ".$rcekD['dstretch_w5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sr']=='DISPOSISI'){if($rcekD['drecover_l1']!=''){echo "Recovery Len 1 : ".$rcekD['drecover_l1']." ";} 
                                                                                if($rcekD['drecover_l2']!=''){echo "Recovery Len 2 : ".$rcekD['drecover_l2']." ";} 
                                                                                if($rcekD['drecover_l3']!=''){echo "Recovery Len 3 : ".$rcekD['drecover_l3']." ";} 
                                                                                if($rcekD['drecover_l4']!=''){echo "Recovery Len 4 : ".$rcekD['drecover_l4']." ";} 
                                                                                if($rcekD['drecover_l5']!=''){echo "Recovery Len 5 : ".$rcekD['drecover_l5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sr']=='DISPOSISI'){if($rcekD['drecover_w1']!=''){echo "Recovery Wid 1 : ".$rcekD['drecover_w1']." ";} 
                                                                                if($rcekD['drecover_w2']!=''){echo "Recovery Wid 2 : ".$rcekD['drecover_w2']." ";} 
                                                                                if($rcekD['drecover_w3']!=''){echo "Recovery Wid 3 : ".$rcekD['drecover_w3']." ";} 
                                                                                if($rcekD['drecover_w4']!=''){echo "Recovery Wid 4 : ".$rcekD['drecover_w4']." ";} 
                                                                                if($rcekD['drecover_w5']!=''){echo "Recovery Wid 5 : ".$rcekD['drecover_w5']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_sr']=='FAIL' or $rcek1['stat_sr']=='DISPOSISI'){if($rcek1['stretch_l1']!=''){echo "Stretch Len 1 : ".$rcek1['stretch_l1']." ";} 
                                                                                 if($rcek1['stretch_l2']!=''){echo "Stretch Len 2 : ".$rcek1['stretch_l2']." ";} 
                                                                                 if($rcek1['stretch_l3']!=''){echo "Stretch Len 3 : ".$rcek1['stretch_l3']." ";} 
                                                                                 if($rcek1['stretch_l4']!=''){echo "Stretch Len 4 : ".$rcek1['stretch_l4']." ";} 
                                                                                 if($rcek1['stretch_l5']!=''){echo "Stretch Len 5 : ".$rcek1['stretch_l5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sr']=='FAIL' or $rcek1['stat_sr']=='DISPOSISI'){if($rcek1['stretch_w1']!=''){echo "Stretch Wid 1 : ".$rcek1['stretch_w1']." ";} 
                                                                                if($rcek1['stretch_w2']!=''){echo "Stretch Wid 2 : ".$rcek1['stretch_w2']." ";} 
                                                                                if($rcek1['stretch_w3']!=''){echo "Stretch Wid 3 : ".$rcek1['stretch_w3']." ";} 
                                                                                if($rcek1['stretch_w4']!=''){echo "Stretch Wid 4 : ".$rcek1['stretch_w4']." ";} 
                                                                                if($rcek1['stretch_w5']!=''){echo "Stretch Wid 5 : ".$rcek1['stretch_w5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sr']=='FAIL' or $rcek1['stat_sr']=='DISPOSISI'){if($rcek1['recover_l1']!=''){echo "Recovery Len 1 : ".$rcek1['recover_l1']." ";} 
                                                                                if($rcek1['recover_l2']!=''){echo "Recovery Len 2 : ".$rcek1['recover_l2']." ";} 
                                                                                if($rcek1['recover_l3']!=''){echo "Recovery Len 3 : ".$rcek1['recover_l3']." ";} 
                                                                                if($rcek1['recover_l4']!=''){echo "Recovery Len 4 : ".$rcek1['recover_l4']." ";} 
                                                                                if($rcek1['recover_l5']!=''){echo "Recovery Len 5 : ".$rcek1['recover_l5']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_sr']=='FAIL' or $rcek1['stat_sr']=='DISPOSISI'){if($rcek1['recover_w1']!=''){echo "Recovery Wid 1 : ".$rcek1['recover_w1']." ";} 
                                                                                if($rcek1['recover_w2']!=''){echo "Recovery Wid 2 : ".$rcek1['recover_w2']." ";} 
                                                                                if($rcek1['recover_w3']!=''){echo "Recovery Wid 3 : ".$rcek1['recover_w3']." ";} 
                                                                                if($rcek1['recover_w4']!=''){echo "Recovery Wid 4 : ".$rcek1['recover_w4']." ";} 
                                                                                if($rcek1['recover_w5']!=''){echo "Recovery Wid 5 : ".$rcek1['recover_w5']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_gr']=='DISPOSISI' or $rcek1['stat_gr']=='FAIL'){ ?>
                        <tr>
                            <td align="center">GROWTH</td>
                            <td align="center"><?php echo $rcek1['stat_gr'];?></td>
                            <td align="left"><?php if($rcek1['stat_gr']=='DISPOSISI'){if($rcekD['dgrowth_l1']!=''){echo "Growth Len 1 : ".$rcekD['dgrowth_l1']." ";} 
                                                                                 if($rcekD['dgrowth_l2']!=''){echo "Growth Len 2 : ".$rcekD['dgrowth_l2']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_gr']=='DISPOSISI'){if($rcekD['dgrowth_w1']!=''){echo "Growth Wid 1 : ".$rcekD['dgrowth_w1']." ";} 
                                                                                if($rcekD['dgrowth_w2']!=''){echo "Growth Wid 2 : ".$rcekD['dgrowth_w2']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_gr']=='DISPOSISI'){if($rcekD['drec_growth_l1']!=''){echo "Rec Len 1 : ".$rcekD['drec_growth_l1']." ";} 
                                                                                 if($rcekD['drec_growth_l2']!=''){echo "Rec Len 2 : ".$rcekD['drec_growth_l2']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_gr']=='DISPOSISI'){if($rcekD['drec_growth_w1']!=''){echo "Rec Wid 1 : ".$rcekD['drec_growth_w1']." ";} 
                                                                                if($rcekD['drec_growth_w2']!=''){echo "Rec Wid 2 : ".$rcekD['drec_growth_w2']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_gr']=='FAIL' or $rcek1['stat_gr']=='DISPOSISI'){if($rcek1['growth_l1']!=''){echo "Growth Len 1 : ".$rcek1['growth_l1']." ";} 
                                                                                 if($rcek1['growth_l2']!=''){echo "Growth Len 2 : ".$rcek1['growth_l2']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_gr']=='FAIL' or $rcek1['stat_gr']=='DISPOSISI'){if($rcek1['growth_w1']!=''){echo "Growth Wid 1 : ".$rcek1['growth_w1']." ";} 
                                                                                if($rcek1['growth_w2']!=''){echo "Growth Wid 2 : ".$rcek1['growth_w2']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_gr']=='FAIL' or $rcek1['stat_gr']=='DISPOSISI'){if($rcek1['rec_growth_l1']!=''){echo "Rec Len 1 : ".$rcek1['rec_growth_l1']." ";} 
                                                                                 if($rcek1['rec_growth_l2']!=''){echo "Rec Len 2 : ".$rcek1['rec_growth_l2']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_gr']=='FAIL' or $rcek1['stat_gr']=='DISPOSISI'){if($rcek1['rec_growth_w1']!=''){echo "Rec Wid 1 : ".$rcek1['rec_growth_w1']." ";} 
                                                                                if($rcek1['rec_growth_w2']!=''){echo "Rec Wid 2 : ".$rcek1['rec_growth_w2']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_ap']=='DISPOSISI' or $rcek1['stat_ap']=='FAIL'){ ?>
                        <tr>
                            <td align="center">APPEARANCE</td>
                            <td align="center"><?php echo $rcek1['stat_ap'];?></td>
                            <td align="left"><?php if($rcek1['stat_ap']=='DISPOSISI'){if($rcekD['dapper_pf1']!=''){echo "Pill. Face 1 : ".$rcekD['dapper_pf1']." ";} 
                                                                                 if($rcekD['dapper_pb1']!=''){echo "Pill. Back 1 : ".$rcekD['dapper_pb1']." ";} 
                                                                                 if($rcekD['dapper_ch1']!=''){echo "Pass/Fail 1 : ".$rcekD['dapper_ch1']." ";} 
                                                                                 if($rcekD['dapper_cc1']!=''){echo "Color Change 1 : ".$rcekD['dapper_cc1']." ";} 
                                                                                 if($rcekD['dapper_st']!=''){echo "Staining 1 : ".$rcekD['dapper_st']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_ap']=='DISPOSISI'){if($rcekD['dapper_acetate']!=''){echo "Acetate : ".$rcekD['dapper_acetate']." ";} 
                                                                                if($rcekD['dapper_cotton']!=''){echo "Cotton : ".$rcekD['dapper_cotton']." ";} 
                                                                                if($rcekD['dapper_nylon']!=''){echo "Nylon : ".$rcekD['dapper_nylon']." ";} 
                                                                                if($rcekD['dapper_poly']!=''){echo "Poly : ".$rcekD['dapper_poly']." ";} 
                                                                                if($rcekD['dapper_acrylic']!=''){echo "Acrylic : ".$rcekD['dapper_acrylic']." ";} 
                                                                                if($rcekD['dapper_wool']!=''){echo "Wool : ".$rcekD['dapper_wool']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_ap']=='DISPOSISI'){if($rcekD['dapper_pf2']!=''){echo "Pill. Face 2 : ".$rcekD['dapper_pf2']." ";} 
                                                                                 if($rcekD['dapper_pb2']!=''){echo "Pill. Back 2 : ".$rcekD['dapper_pb2']." ";} 
                                                                                 if($rcekD['dapper_ch2']!=''){echo "Pass/Fail 2 : ".$rcekD['dapper_ch2']." ";} 
                                                                                 if($rcekD['dapper_cc2']!=''){echo "Color Change 2 : ".$rcekD['dapper_cc2']." ";} 
                                                                                 if($rcekD['dapper_st2']!=''){echo "Staining 2 : ".$rcekD['dapper_st2']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_ap']=='FAIL' or $rcek1['stat_ap']=='DISPOSISI'){if($rcek1['apper_pf1']!=''){echo "Pill. Face 1 : ".$rcek1['apper_pf1']." ";} 
                                                                                 if($rcek1['apper_pb1']!=''){echo "Pill. Back 1 : ".$rcek1['apper_pb1']." ";} 
                                                                                 if($rcek1['apper_ch1']!=''){echo "Pass/Fail 1 : ".$rcek1['apper_ch1']." ";} 
                                                                                 if($rcek1['apper_cc1']!=''){echo "Color Change 1 : ".$rcek1['apper_cc1']." ";} 
                                                                                 if($rcek1['apper_st']!=''){echo "Staining 1 : ".$rcek1['apper_st']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_ap']=='FAIL' or $rcek1['stat_ap']=='DISPOSISI'){if($rcek1['apper_acetate']!=''){echo "Acetate : ".$rcek1['apper_acetate']." ";} 
                                                                                if($rcek1['apper_cotton']!=''){echo "Cotton : ".$rcek1['apper_cotton']." ";} 
                                                                                if($rcek1['apper_nylon']!=''){echo "Nylon : ".$rcek1['apper_nylon']." ";} 
                                                                                if($rcek1['apper_poly']!=''){echo "Poly : ".$rcek1['apper_poly']." ";} 
                                                                                if($rcek1['apper_acrylic']!=''){echo "Acrylic : ".$rcek1['apper_acrylic']." ";} 
                                                                                if($rcek1['apper_wool']!=''){echo "Wool : ".$rcek1['apper_wool']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_ap']=='FAIL' or $rcek1['stat_ap']=='DISPOSISI'){if($rcek1['apper_pf2']!=''){echo "Pill. Face 2 : ".$rcek1['apper_pf2']." ";} 
                                                                                 if($rcek1['apper_pb2']!=''){echo "Pill. Back 2 : ".$rcek1['apper_pb2']." ";} 
                                                                                 if($rcek1['apper_ch2']!=''){echo "Pass/Fail 2 : ".$rcek1['apper_ch2']." ";} 
                                                                                 if($rcek1['apper_cc2']!=''){echo "Color Change 2 : ".$rcek1['apper_cc2']." ";} 
                                                                                 if($rcek1['apper_st2']!=''){echo "Staining 2 : ".$rcek1['apper_st2']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_odour']=='DISPOSISI' or $rcek1['stat_odour']=='FAIL'){ ?>
                        <tr>
                            <td align="center">ODOUR</td>
                            <td align="center"><?php echo $rcek1['stat_odour'];?></td>
                            <td align="left"><?php if($rcek1['stat_odour']=='DISPOSISI'){echo $rcekD['dodour'];}?></td>
                            <td align="left"><?php if($rcek1['stat_odour']=='FAIL' or $rcek1['stat_odour']=='DISPOSISI'){echo $rcek1['odour'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_hs']=='DISPOSISI' or $rcek1['stat_hs']=='FAIL'){ ?>
                        <tr>
                            <td align="center">HEAT SHRINKAGE</td>
                            <td align="center"><?php echo $rcek1['stat_hs'];?></td>
                            <td align="left"><?php if($rcek1['stat_hs']=='DISPOSISI'){if($rcekD['dh_shrinkage_l1']!=''){echo "Len 1 : ".$rcekD['dh_shrinkage_l1']." ";} 
                                                                                 if($rcekD['dh_shrinkage_w1']!=''){echo "Wid 1 : ".$rcekD['dh_shrinkage_w1']." ";} 
                                                                                 if($rcekD['dh_shrinkage_grd']!=''){echo "Grade : ".$rcekD['dh_shrinkage_grd']." ";} 
                                                                                 if($rcekD['dh_shrinkage_app']!=''){echo "Appearance : ".$rcekD['dh_shrinkage_app']." ";} 
                                                                                 if($rcekD['dh_shrinkage_temp']!=''){echo "Suhu : ".$rcekD['dh_shrinkage_temp']." ";}}?> </td>
                            <td align="left"><?php if($rcek1['stat_hs']=='FAIL' or $rcek1['stat_hs']=='DISPOSISI'){if($rcek1['h_shrinkage_l1']!=''){echo "Len 1 : ".$rcek1['h_shrinkage_l1']." ";} 
                                                                                 if($rcek1['h_shrinkage_w1']!=''){echo "Wid 1 : ".$rcek1['h_shrinkage_w1']." ";} 
                                                                                 if($rcek1['h_shrinkage_grd']!=''){echo "Grade : ".$rcek1['h_shrinkage_grd']." ";} 
                                                                                 if($rcek1['h_shrinkage_app']!=''){echo "Appearance : ".$rcek1['h_shrinkage_app']." ";} 
                                                                                 if($rcek1['h_shrinkage_temp']!=''){echo "Suhu : ".$rcek1['h_shrinkage_temp']." ";}}?> </td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_ff']=='DISPOSISI' or $rcek1['stat_ff']=='FAIL'){ ?>
                        <tr>
                            <td align="center">FIBRE/FUZZ</td>
                            <td align="center"><?php echo $rcek1['stat_ff'];?></td>
                            <td align="left"><?php if($rcek1['stat_ff']=='DISPOSISI'){echo "Fibre Transfer : ".$rcekD['dfibre_transfer']." ";}?> <br/> <?php if($rcekD['stat_ff']=='DISPOSISI'){echo "Grade : ".$rcekD['dfibre_grade']." ";}?></td>
                            <td align="left"><?php if($rcek1['stat_ff']=='FAIL' or $rcek1['stat_ff']=='DISPOSISI'){echo "Fibre Transfer : ".$rcek1['fibre_transfer']." ";}?> <br/> <?php if($rcek1['stat_ff']=='FAIL' or $rcek1['stat_ff']=='DISPOSISI'){echo "Grade : ".$rcek1['fibre_grade']." ";}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_wf']=='DISPOSISI' or $rcek1['stat_wf']=='FAIL'){ ?>
                        <tr>
                            <td align="center">WASHING FASTNESS</td>
                            <td align="center"><?php echo $rcek1['stat_wf'];?></td>
                            <td align="left"><?php if($rcek1['stat_wf']=='DISPOSISI'){if($rcekD['dwash_temp']!=''){echo "Suhu : ".$rcekD['dwash_temp']." ";} 
                                                                                 if($rcekD['dwash_colorchange']!=''){echo "CC : ".$rcekD['dwash_colorchange']." ";} 
                                                                                 if($rcekD['dwash_acetate']!=''){echo "Acetate : ".$rcekD['dwash_acetate']." ";} 
                                                                                 if($rcekD['dwash_cotton']!=''){echo "Cotton : ".$rcekD['dwash_cotton']." ";} 
                                                                                 if($rcekD['dwash_nylon']!=''){echo "Nylon : ".$rcekD['dwash_nylon']." ";}}?> <br/>
                                            <?php if($rcek1['stat_wf']=='DISPOSISI'){if($rcekD['dwash_poly']!=''){echo "Poly : ".$rcekD['dwash_poly']." ";} 
                                                                                 if($rcekD['dwash_acrylic']!=''){echo "Acrylic : ".$rcekD['dwash_acrylic']." ";} 
                                                                                 if($rcekD['dwash_wool']!=''){echo "Wool : ".$rcekD['dwash_wool." "'];} 
                                                                                 if($rcekD['dwash_staining']!=''){echo "Staining : ".$rcekD['dwash_staining']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_wf']=='FAIL' or $rcek1['stat_wf']=='DISPOSISI'){if($rcek1['wash_temp']!=''){echo "Suhu : ".$rcek1['wash_temp']." ";} 
                                                                                 if($rcek1['wash_colorchange']!=''){echo "CC : ".$rcek1['wash_colorchange']." ";} 
                                                                                 if($rcek1['wash_acetate']!=''){echo "Acetate : ".$rcek1['wash_acetate']." ";} 
                                                                                 if($rcek1['wash_cotton']!=''){echo "Cotton : ".$rcek1['wash_cotton']." ";} 
                                                                                 if($rcek1['wash_nylon']!=''){echo "Nylon : ".$rcek1['wash_nylon']." ";}}?> <br/>
                                            <?php if($rcek1['stat_wf']=='FAIL' or $rcek1['stat_wf']=='DISPOSISI'){if($rcek1['wash_poly']!=''){echo "Poly : ".$rcek1['wash_poly']." ";} 
                                                                                 if($rcek1['wash_acrylic']!=''){echo "Acrylic : ".$rcek1['wash_acrylic']." ";} 
                                                                                 if($rcek1['wash_wool']!=''){echo "Wool : ".$rcek1['wash_wool." "'];} 
                                                                                 if($rcek1['wash_staining']!=''){echo "Staining : ".$rcek1['wash_staining']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_wtr']=='DISPOSISI' or $rcek1['stat_wtr']=='FAIL'){ ?>
                        <tr>
                            <td align="center">WATER FASTNESS</td>
                            <td align="center"><?php echo $rcek1['stat_wtr'];?></td>
                            <td align="left"><?php if($rcek1['stat_wtr']=='DISPOSISI'){if($rcekD['dwater_colorchange']!=''){echo "CC : ".$rcekD['dwater_colorchange']." ";} 
                                                                                 if($rcekD['dwater_acetate']!=''){echo "Acetate : ".$rcekD['dwater_acetate']." ";} 
                                                                                 if($rcekD['dwater_cotton']!=''){echo "Cotton : ".$rcekD['dwater_cotton']." ";} 
                                                                                 if($rcekD['dwater_nylon']!=''){echo "Nylon : ".$rcekD['dwater_nylon']." ";}}?> <br/>
                                            <?php if($rcek1['stat_wtr']=='DISPOSISI'){if($rcekD['dwater_poly']!=''){echo "Poly : ".$rcekD['dwater_poly']." ";} 
                                                                                 if($rcekD['dwater_acrylic']!=''){echo "Acrylic : ".$rcekD['dwater_acrylic']." ";} 
                                                                                 if($rcekD['dwater_wool']!=''){echo "Wool : ".$rcekD['dwater_wool']." ";} 
                                                                                 if($rcekD['dwater_staining']!=''){echo "Staining : ".$rcekD['dwater_staining']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_wtr']=='FAIL' or $rcek1['stat_wtr']=='DISPOSISI'){if($rcek1['water_colorchange']!=''){echo "CC : ".$rcek1['water_colorchange']." ";} 
                                                                                 if($rcek1['water_acetate']!=''){echo "Acetate : ".$rcek1['water_acetate']." ";} 
                                                                                 if($rcek1['water_cotton']!=''){echo "Cotton : ".$rcek1['water_cotton']." ";} 
                                                                                 if($rcek1['water_nylon']!=''){echo "Nylon : ".$rcek1['water_nylon']." ";}}?> <br/>
                                            <?php if($rcek1['stat_wtr']=='FAIL' or $rcek1['stat_wtr']=='DISPOSISI'){if($rcek1['water_poly']!=''){echo "Poly : ".$rcek1['water_poly']." ";} 
                                                                                 if($rcek1['water_acrylic']!=''){echo "Acrylic : ".$rcek1['water_acrylic']." ";} 
                                                                                 if($rcek1['water_wool']!=''){echo "Wool : ".$rcek1['water_wool']." ";} 
                                                                                 if($rcek1['water_staining']!=''){echo "Staining : ".$rcek1['water_staining']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_pac']=='DISPOSISI' or $rcek1['stat_pac']=='FAIL'){ ?>
                        <tr>
                            <td align="center">PERSPIRATION ACID</td>
                            <td align="center"><?php echo $rcek1['stat_pac'];?></td>
                            <td align="left"><?php if($rcek1['stat_pac']=='DISPOSISI'){if($rcekD['dacid_colorchange']!=''){echo "CC : ".$rcekD['dacid_colorchange']." ";} 
                                                                                 if($rcekD['dacid_acetate']!=''){echo "Acetate : ".$rcekD['dacid_acetate']." ";} 
                                                                                 if($rcekD['dacid_cotton']!=''){echo "Cotton : ".$rcekD['dacid_cotton']." ";} 
                                                                                 if($rcekD['dacid_nylon']!=''){echo "Nylon : ".$rcekD['dacid_nylon']." ";}}?> <br/>
                                            <?php if($rcek1['stat_pac']=='DISPOSISI'){if($rcekD['dacid_poly']!=''){echo "Poly : ".$rcekD['dacid_poly']." ";} 
                                                                                 if($rcekD['dacid_acrylic']!=''){echo "Acrylic : ".$rcekD['dacid_acrylic']." ";} 
                                                                                 if($rcekD['dacid_wool']!=''){echo "Wool : ".$rcekD['dacid_wool']." ";} 
                                                                                 if($rcekD['dacid_staining']!=''){echo "Staining : ".$rcekD['dacid_staining']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_pac']=='FAIL' or $rcek1['stat_pac']=='DISPOSISI'){if($rcek1['acid_colorchange']!=''){echo "CC : ".$rcek1['acid_colorchange']." ";} 
                                                                                 if($rcek1['acid_acetate']!=''){echo "Acetate : ".$rcek1['acid_acetate']." ";} 
                                                                                 if($rcek1['acid_cotton']!=''){echo "Cotton : ".$rcek1['acid_cotton']." ";} 
                                                                                 if($rcek1['acid_nylon']!=''){echo "Nylon : ".$rcek1['acid_nylon']." ";}}?> <br/>
                                            <?php if($rcek1['stat_pac']=='FAIL' or $rcek1['stat_pac']=='DISPOSISI'){if($rcek1['acid_poly']!=''){echo "Poly : ".$rcek1['acid_poly']." ";} 
                                                                                 if($rcek1['acid_acrylic']!=''){echo "Acrylic : ".$rcek1['acid_acrylic']." ";} 
                                                                                 if($rcek1['acid_wool']!=''){echo "Wool : ".$rcek1['acid_wool']." ";} 
                                                                                 if($rcek1['acid_staining']!=''){echo "Staining : ".$rcek1['acid_staining']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_pal']=='DISPOSISI' or $rcek1['stat_pal']=='FAIL'){ ?>
                        <tr>
                            <td align="center">PERSPIRATION ALKALINE</td>
                            <td align="center"><?php echo $rcek1['stat_pal'];?></td>
                            <td align="left"><?php if($rcek1['stat_pal']=='DISPOSISI'){if($rcekD['dalkaline_colorchange']!=''){echo "CC : ".$rcekD['dalkaline_colorchange']." ";} 
                                                                                 if($rcekD['dalkaline_acetate']!=''){echo "Acetate : ".$rcekD['dalkaline_acetate']." ";} 
                                                                                 if($rcekD['dalkaline_cotton']!=''){echo "Cotton : ".$rcekD['dalkaline_cotton']." ";} 
                                                                                 if($rcekD['dalkaline_nylon']!=''){echo "Nylon : ".$rcekD['dalkaline_nylon']." ";}}?> <br/>
                                            <?php if($rcek1['stat_pal']=='DISPOSISI'){if($rcekD['dalkaline_poly']!=''){echo "Poly : ".$rcekD['dalkaline_poly']." ";} 
                                                                                 if($rcekD['dalkaline_acrylic']!=''){echo "Acrylic : ".$rcekD['dalkaline_acrylic']." ";} 
                                                                                 if($rcekD['dalkaline_wool']!=''){echo "Wool : ".$rcekD['dalkaline_wool']." ";} 
                                                                                 if($rcekD['dalkaline_staining']!=''){echo "Staining : ".$rcekD['dalkaline_staining']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_pal']=='FAIL' or $rcek1['stat_pal']=='DISPOSISI'){if($rcek1['alkaline_colorchange']!=''){echo "CC : ".$rcek1['alkaline_colorchange']." ";} 
                                                                                 if($rcek1['alkaline_acetate']!=''){echo "Acetate : ".$rcek1['alkaline_acetate']." ";} 
                                                                                 if($rcek1['alkaline_cotton']!=''){echo "Cotton : ".$rcek1['alkaline_cotton']." ";} 
                                                                                 if($rcek1['alkaline_nylon']!=''){echo "Nylon : ".$rcek1['alkaline_nylon']." ";}}?> <br/>
                                            <?php if($rcek1['stat_pal']=='FAIL' or $rcek1['stat_pal']=='DISPOSISI'){if($rcek1['alkaline_poly']!=''){echo "Poly : ".$rcek1['alkaline_poly']." ";} 
                                                                                 if($rcek1['alkaline_acrylic']!=''){echo "Acrylic : ".$rcek1['alkaline_acrylic']." ";} 
                                                                                 if($rcek1['alkaline_wool']!=''){echo "Wool : ".$rcek1['alkaline_wool']." ";} 
                                                                                 if($rcek1['alkaline_staining']!=''){echo "Staining : ".$rcek1['alkaline_staining']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_cr']=='DISPOSISI' or $rcek1['stat_cr']=='FAIL'){ ?>
                        <tr>
                            <td align="center">CROCKING</td>
                            <td align="center"><?php echo $rcek1['stat_cr'];?></td>
                            <td align="left"><?php if($rcek1['stat_cr']=='DISPOSISI'){if($rcekD['dcrock_len1']!=''){echo "Len 1 : ".$rcekD['dcrock_len1']." "." ";} 
                                                                                 if($rcekD['dcrock_len2']!=''){echo "Len 2 : ".$rcekD['dcrock_len2']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_cr']=='DISPOSISI'){if($rcekD['dcrock_wid1']!=''){echo "Wid 1 : ".$rcekD['dcrock_wid1']." ";} 
                                                                                if($rcekD['dcrock_wid2']!=''){echo "Wid 2 : ".$rcekD['dcrock_wid2']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_cr']=='FAIL' or $rcek1['stat_cr']=='DISPOSISI'){if($rcek1['crock_len1']!=''){echo "Len 1 : ".$rcek1['crock_len1']." "." ";} 
                                                                                 if($rcek1['crock_len2']!=''){echo "Len 2 : ".$rcek1['crock_len2']." ";}}?> <br/> 
                                            <?php if($rcek1['stat_cr']=='FAIL' or $rcek1['stat_cr']=='DISPOSISI'){if($rcek1['crock_wid1']!=''){echo "Wid 1 : ".$rcek1['crock_wid1']." ";} 
                                                                                if($rcek1['crock_wid2']!=''){echo "Wid 2 : ".$rcek1['crock_wid2']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_py']=='DISPOSISI' or $rcek1['stat_py']=='FAIL'){ ?>
                        <tr>
                            <td align="center">PHENOLIC YELLOWING</td>
                            <td align="center"><?php echo $rcek1['stat_py'];?></td>
                            <td align="left"><?php if($rcek1['stat_py']=='DISPOSISI'){echo $rcekD['dphenolic_colorchange'];}?></td>
                            <td align="left"><?php if($rcek1['stat_py']=='FAIL' or $rcek1['stat_py']=='DISPOSISI'){echo $rcek1['phenolic_colorchange'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_cmo']=='DISPOSISI' or $rcek1['stat_cmo']=='FAIL'){ ?>
                        <tr>
                            <td align="center">COLOR MIGRATION - OVEN TEST</td>
                            <td align="center"><?php echo $rcek1['stat_cmo'];?></td>
                            <td align="left"><?php if($rcek1['stat_cmo']=='DISPOSISI'){echo $rcekD['dcm_printing_colorchange'];}?></td>
                            <td align="left"><?php if($rcek1['stat_cmo']=='FAIL' or $rcek1['stat_cmo']=='DISPOSISI'){echo $rcek1['cm_printing_colorchange'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_cm']=='DISPOSISI' or $rcek1['stat_cm']=='FAIL'){ ?>
                        <tr>
                            <td align="center">HEAT SHRINKAGE</td>
                            <td align="center"><?php echo $rcek1['stat_cm'];?></td>
                            <td align="left"><?php if($rcek1['stat_cm']=='DISPOSISI'){if($rcekD['dcm_dye_temp']!=''){echo "Suhu : ".$rcekD['dcm_dye_temp']." ";} 
                                                                                 if($rcekD['dcm_dye_colorchange']!=''){echo "CC : ".$rcekD['dcm_dye_colorchange']." ";} 
                                                                                 if($rcekD['dcm_dye_stainingface']!=''){echo "Staining Face : ".$rcekD['dcm_dye_stainingface']." ";} 
                                                                                 if($rcekD['dcm_dye_stainingback']!=''){echo "Staining Back : ".$rcekD['dcm_dye_stainingback']." ";}}?> </td>
                            <td align="left"><?php if($rcek1['stat_cm']=='FAIL' or $rcek1['stat_cm']=='DISPOSISI'){if($rcek1['cm_dye_temp']!=''){echo "Suhu : ".$rcek1['cm_dye_temp']." ";} 
                                                                                 if($rcek1['cm_dye_colorchange']!=''){echo "CC : ".$rcek1['cm_dye_colorchange']." ";} 
                                                                                 if($rcek1['cm_dye_stainingface']!=''){echo "Staining Face : ".$rcek1['cm_dye_stainingface']." ";} 
                                                                                 if($rcek1['cm_dye_stainingback']!=''){echo "Staining Back : ".$rcek1['cm_dye_stainingback']." ";}}?> </td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_lg']=='DISPOSISI' or $rcek1['stat_lg']=='FAIL'){ ?>
                        <tr>
                            <td align="center">LIGHT FASTNESS</td>
                            <td align="center"><?php echo $rcek1['stat_lg'];?></td>
                            <td align="left"><?php if($rcek1['stat_lg']=='DISPOSISI'){echo "Rating 1 : ".$rcekD['dlight_rating1'];}?> <br/> <?php if($rcek1['stat_lg']=='DISPOSISI'){echo "Rating 2 : ".$rcekD['dlight_rating2'];}?></td>
                            <td align="left"><?php if($rcek1['stat_lg']=='FAIL' or $rcek1['stat_lg']=='DISPOSISI'){echo "Rating 1 : ".$rcek1['light_rating1'];}?> <br/> <?php if($rcek1['stat_lg']=='FAIL' or $rcek1['stat_lg']=='DISPOSISI'){echo "Rating 2 : ".$rcek1['light_rating2'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_lp']=='DISPOSISI' or $rcek1['stat_lp']=='FAIL'){ ?>
                        <tr>
                            <td align="center">LIGHT PERSPIRATION FASTNESS</td>
                            <td align="center"><?php echo $rcek1['stat_lp'];?></td>
                            <td align="left"><?php if($rcek1['stat_lp']=='DISPOSISI'){echo $rcekD['dlight_pers_colorchange'];}?></td>
                            <td align="left"><?php if($rcek1['stat_lp']=='FAIL' or $rcek1['stat_lp']=='DISPOSISI'){echo $rcek1['light_pers_colorchange'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_slv']=='DISPOSISI' or $rcek1['stat_slv']=='FAIL'){ ?>
                        <tr>
                            <td align="center">SALIVA FASTNESS</td>
                            <td align="center"><?php echo $rcek1['stat_slv'];?></td>
                            <td align="left"><?php if($rcek1['stat_slv']=='DISPOSISI'){echo $rcekD['dsaliva_staining'];}?></td>
                            <td align="left"><?php if($rcek1['stat_slv']=='FAIL' or $rcek1['stat_slv']=='DISPOSISI'){echo $rcek1['saliva_staining'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_wic']=='DISPOSISI' or $rcek1['stat_wic']=='FAIL'){ ?>
                        <tr>
                            <td align="center">WICKING LENGTH</td>
                            <td align="center"><?php echo $rcek1['stat_wic'];?></td>
                            <td align="left"><?php if($rcek1['stat_wic']=='DISPOSISI'){if($rcekD['dwick_l1']!=''){echo "Before Wash : ".$rcekD['dwick_l1']." ";} if($rcekD['dwick_l2']!=''){echo "After Wash : ".$rcekD['dwick_l2']." ";}}?> <br/> <?php if($rcek1['stat_wic']=='DISPOSISI'){if($rcekD['dwick_l3']!=''){echo "Before Wash : ".$rcekD['dwick_l3']." ";} if($rcekD['dwick_l4']!=''){echo "After Wash : ".$rcekD['dwick_l4']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_wic']=='FAIL' or $rcek1['stat_wic']=='DISPOSISI'){if($rcek1['wick_l1']!=''){echo "Before Wash : ".$rcek1['wick_l1']." ";} if($rcek1['wick_l2']!=''){echo "After Wash : ".$rcek1['wick_l2']." ";}}?> <br/> <?php if($rcek1['stat_wic']=='FAIL' or $rcek1['stat_wic']=='DISPOSISI'){if($rcek1['wick_l3']!=''){echo "Before Wash : ".$rcek1['wick_l3']." ";} if($rcek1['wick_l4']!=''){echo "After Wash : ".$rcek1['wick_l4']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_wic1']=='DISPOSISI' or $rcek1['stat_wic1']=='FAIL'){ ?>
                        <tr>
                            <td align="center">WICKING WIDTH</td>
                            <td align="center"><?php echo $rcek1['stat_wic1'];?></td>
                            <td align="left"><?php if($rcek1['stat_wic1']=='DISPOSISI'){if($rcekD['dwick_w1']!=''){echo "Before Wash : ".$rcekD['dwick_w1']." ";} if($rcekD['dwick_w2']!=''){echo "After Wash : ".$rcekD['dwick_w2']." ";}}?> <br/> <?php if($rcek1['stat_wic1']=='DISPOSISI'){if($rcekD['dwick_w3']!=''){echo "Before Wash : ".$rcekD['dwick_w3']." ";} if($rcekD['dwick_w4']!=''){echo "After Wash : ".$rcekD['dwick_w4']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_wic1']=='FAIL' or $rcek1['stat_wic1']=='DISPOSISI'){if($rcek1['wick_w1']!=''){echo "Before Wash : ".$rcek1['wick_w1']." ";} if($rcek1['wick_w2']!=''){echo "After Wash : ".$rcek1['wick_w2']." ";}}?> <br/> <?php if($rcek1['stat_wic1']=='FAIL' or $rcek1['stat_wic1']=='DISPOSISI'){if($rcek1['wick_w3']!=''){echo "Before Wash : ".$rcek1['wick_w3']." ";} if($rcek1['wick_w4']!=''){echo "After Wash : ".$rcek1['wick_w4']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_abs']=='DISPOSISI' or $rcek1['stat_abs']=='FAIL'){ ?>
                        <tr>
                            <td align="center">ABSORBENCY ORIGINAL</td>
                            <td align="center"><?php echo $rcek1['stat_abs'];?></td>
                            <td align="left"><?php if($rcek1['stat_abs']=='DISPOSISI'){echo "Original 1 : ".$rcekD['dabsor_f2'];}?> <br/> <?php if($rcek1['stat_abs']=='DISPOSISI'){echo "Original 2 : ".$rcekD['dabsor_f1'];}?></td>
                            <td align="left"><?php if($rcek1['stat_abs']=='FAIL' or $rcek1['stat_abs']=='DISPOSISI'){echo "Original 1 : ".$rcek1['absor_f2'];}?> <br/> <?php if($rcek1['stat_abs']=='FAIL' or $rcek1['stat_abs']=='DISPOSISI'){echo "Original 2 : ".$rcek1['absor_f1'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_abs1']=='DISPOSISI' or $rcek1['stat_abs1']=='FAIL'){ ?>
                        <tr>
                            <td align="center">ABSORBENCY AFTERWASH</td>
                            <td align="center"><?php echo $rcek1['stat_abs1'];?></td>
                            <td align="left"><?php if($rcek1['stat_abs1']=='DISPOSISI'){echo "Afterwash 1 : ".$rcekD['dabsor_b2'];}?> <br/> <?php if($rcek1['stat_abs1']=='DISPOSISI'){echo "Afterwash 2 : ".$rcekD['dabsor_b1'];}?></td>
                            <td align="left"><?php if($rcek1['stat_abs1']=='FAIL' or $rcek1['stat_abs1']=='DISPOSISI'){echo "Afterwash 1 : ".$rcek1['absor_b2'];}?> <br/> <?php if($rcek1['stat_abs1']=='FAIL' or $rcek1['stat_abs1']=='DISPOSISI'){echo "Afterwash 2 : ".$rcek1['absor_b1'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_dry']=='DISPOSISI' or $rcek1['stat_dry']=='FAIL'){ ?>
                        <tr>
                            <td align="center">DRYING TIME ORIGINAL</td>
                            <td align="center"><?php echo $rcek1['stat_dry'];?></td>
                            <td align="left"><?php if($rcek1['stat_dry']=='DISPOSISI'){echo $rcekD['ddry1'];}?></td>
                            <td align="left"><?php if($rcek1['stat_dry']=='FAIL' or $rcek1['stat_dry']=='DISPOSISI'){echo $rcek1['dry1'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_dry1']=='DISPOSISI' or $rcek1['stat_dry1']=='FAIL'){ ?>
                        <tr>
                            <td align="center">DRYING TIME AFTERWASH</td>
                            <td align="center"><?php echo $rcek1['stat_dry1'];?></td>
                            <td align="left"><?php if($rcek1['stat_dry1']=='DISPOSISI'){echo $rcekD['ddryaf1'];}?></td>
                            <td align="left"><?php if($rcek1['stat_dry1']=='FAIL' or $rcek1['stat_dry1']=='DISPOSISI'){echo $rcek1['dryaf1'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_wp']=='DISPOSISI' or $rcek1['stat_wp']=='FAIL'){ ?>
                        <tr>
                            <td align="center">WATER REPPELENT ORIGINAL</td>
                            <td align="center"><?php echo $rcek1['stat_wp'];?></td>
                            <td align="left"><?php if($rcek1['stat_wp']=='DISPOSISI'){echo $rcekD['drepp1'];}?></td>
                            <td align="left"><?php if($rcek1['stat_wp']=='FAIL' or $rcek1['stat_wp']=='DISPOSISI'){echo $rcek1['repp1'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_wp1']=='DISPOSISI' or $rcek1['stat_wp1']=='FAIL'){ ?>
                        <tr>
                            <td align="center">WATER REPPELENT AFTERWASH</td>
                            <td align="center"><?php echo $rcek1['stat_wp1'];?></td>
                            <td align="left"><?php if($rcek1['stat_wp1']=='DISPOSISI'){echo $rcekD['drepp2'];}?></td>
                            <td align="left"><?php if($rcek1['stat_wp1']=='FAIL' or $rcek1['stat_wp1']=='DISPOSISI'){echo $rcek1['repp2'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_ph']=='DISPOSISI' or $rcek1['stat_ph']=='FAIL'){ ?>
                        <tr>
                            <td align="center">PH</td>
                            <td align="center"><?php echo $rcek1['stat_ph'];?></td>
                            <td align="left"><?php if($rcek1['stat_ph']=='DISPOSISI'){echo $rcekD['dph'];}?></td>
                            <td align="left"><?php if($rcek1['stat_ph']=='FAIL' or $rcek1['stat_ph']=='DISPOSISI'){echo $rcek1['ph'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_sor']=='DISPOSISI' or $rcek1['stat_sor']=='FAIL'){ ?>
                        <tr>
                            <td align="center">SOIL RELEASE</td>
                            <td align="center"><?php echo $rcek1['stat_sor'];?></td>
                            <td align="left"><?php if($rcek1['stat_sor']=='DISPOSISI'){echo $rcekD['dsoil'];}?></td>
                            <td align="left"><?php if($rcek1['stat_sor']=='FAIL' or $rcek1['stat_sor']=='DISPOSISI'){echo $rcek1['soil'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_hum']=='DISPOSISI' or $rcek1['stat_hum']=='FAIL'){ ?>
                        <tr>
                            <td align="center">HUMIDITY</td>
                            <td align="center"><?php echo $rcek1['stat_hum'];?></td>
                            <td align="left"><?php if($rcek1['stat_hum']=='DISPOSISI'){echo $rcekD['dhumidity'];}?></td>
                            <td align="left"><?php if($rcek1['stat_hum']=='FAIL' or $rcek1['stat_hum']=='DISPOSISI'){echo $rcek1['humidity'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_bld']=='DISPOSISI' or $rcek1['stat_bld']=='FAIL'){ ?>
                        <tr>
                            <td align="center">BLEEDING</td>
                            <td align="center"><?php echo $rcek1['stat_bld'];?></td>
                            <td align="left"><?php if($rcek1['stat_bld']=='DISPOSISI'){echo $rcekD['dbleeding'];}?></td>
                            <td align="left"><?php if($rcek1['stat_bld']=='FAIL' or $rcek1['stat_bld']=='DISPOSISI'){echo $rcek1['bleeding'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_chl']=='DISPOSISI' or $rcek1['stat_chl']=='FAIL'){ ?>
                        <tr>
                            <td align="center">CHLORIN</td>
                            <td align="center"><?php echo $rcek1['stat_chl'];?></td>
                            <td align="left"><?php if($rcek1['stat_chl']=='DISPOSISI'){echo $rcekD['dchlorin'];}?></td>
                            <td align="left"><?php if($rcek1['stat_chl']=='FAIL' or $rcek1['stat_chl']=='DISPOSISI'){echo $rcek1['chlorin'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_nchl']=='DISPOSISI' or $rcek1['stat_nchl']=='FAIL'){ ?>
                        <tr>
                            <td align="center">NON-CHLORIN</td>
                            <td align="center"><?php echo $rcek1['stat_nchl'];?></td>
                            <td align="left"><?php if($rcek1['stat_nchl']=='DISPOSISI'){echo $rcek1['nchlorin1'];}?> <br/> <?php if($rcek1['stat_nchl']=='DISPOSISI'){echo $rcek1['nchlorin2'];}?></td>
                            <td align="left"><?php if($rcek1['stat_nchl']=='FAIL' or $rcek1['stat_nchl']=='DISPOSISI'){echo $rcek1['nchlorin1'];}?> <br/> <?php if($rcek1['stat_nchl']=='FAIL' or $rcek1['stat_nchl']=='DISPOSISI'){echo $rcek1['nchlorin2'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_dye']=='DISPOSISI' or $rcek1['stat_dye']=='FAIL'){ ?>
                        <tr>
                            <td align="center">DYE TRANSFER</td>
                            <td align="center"><?php echo $rcek1['stat_dye'];?></td>
                            <td align="left"><?php if($rcek1['stat_dye']=='DISPOSISI'){if($rcekD['ddye_tf_acetate']!=''){echo "Acetate : ".$rcekD['ddye_tf_acetate']." ";} 
                                                                                 if($rcekD['ddye_tf_cotton']!=''){echo "Cotton : ".$rcekD['ddye_tf_cotton']." ";} 
                                                                                 if($rcekD['ddye_tf_nylon']!=''){echo "Nylon : ".$rcekD['ddye_tf_nylon']." ";} 
                                                                                 if($rcekD['ddye_tf_poly']!=''){echo "Poly : ".$rcekD['ddye_tf_poly']." ";}}?> <br/>
                                            <?php if($rcek1['stat_dye']=='DISPOSISI'){if($rcekD['ddye_tf_acrylic']!=''){echo "Acrylic : ".$rcekD['ddye_tf_acrylic']." ";} 
                                                                                 if($rcekD['ddye_tf_wool']!=''){echo "Wool : ".$rcekD['ddye_tf_wool']." ";} 
                                                                                 if($rcekD['ddye_tf_sstaining']!=''){echo "S.Staining : ".$rcekD['ddye_tf_sstaining']." ";} 
                                                                                 if($rcekD['ddye_tf_cstaining']!=''){echo "C.Staining : ".$rcekD['ddye_tf_cstaining']." ";}}?></td>
                            <td align="left"><?php if($rcek1['stat_dye']=='FAIL' or $rcek1['stat_dye']=='DISPOSISI'){if($rcek1['dye_tf_acetate']!=''){echo "Acetate : ".$rcek1['dye_tf_acetate']." ";} 
                                                                                 if($rcek1['dye_tf_cotton']!=''){echo "Cotton : ".$rcek1['dye_tf_cotton']." ";} 
                                                                                 if($rcek1['dye_tf_nylon']!=''){echo "Nylon : ".$rcek1['dye_tf_nylon']." ";} 
                                                                                 if($rcek1['dye_tf_poly']!=''){echo "Poly : ".$rcek1['dye_tf_poly']." ";}}?> <br/>
                                            <?php if($rcek1['stat_dye']=='FAIL' or $rcek1['stat_dye']=='DISPOSISI'){if($rcek1['dye_tf_acrylic']!=''){echo "Acrylic : ".$rcek1['dye_tf_acrylic']." ";} 
                                                                                 if($rcek1['dye_tf_wool']!=''){echo "Wool : ".$rcek1['dye_tf_wool']." ";} 
                                                                                 if($rcek1['dye_tf_sstaining']!=''){echo "S.Staining : ".$rcek1['dye_tf_sstaining']." ";} 
                                                                                 if($rcek1['dye_tf_cstaining']!=''){echo "C.Staining : ".$rcek1['dye_tf_cstaining']." ";}}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_curling']=='DISPOSISI' or $rcek1['stat_curling']=='FAIL'){ ?>
                        <tr>
                            <td align="center">CURLING</td>
                            <td align="center"><?php echo $rcek1['stat_curling'];?></td>
                            <td align="left"><?php if($rcek1['stat_curling']=='DISPOSISI'){echo $rcekD['dcurling'];}?></td>
                            <td align="left"><?php if($rcek1['stat_curling']=='FAIL'){echo $rcek1['curling'];}?></td>
                        </tr>
                    <?php }?>
                    <?php if($rcek1['stat_nedle']=='DISPOSISI' or $rcek1['stat_nedle']=='FAIL'){ ?>
                        <tr>
                            <td align="center">NEDLE HOLES &amp; CRACKING</td>
                            <td align="center"><?php echo $rcek1['stat_nedle'];?></td>
                            <td align="left"><?php if($rcek1['stat_nedle']=='DISPOSISI'){echo $rcekD['dnedle'];}?></td>
                            <td align="left"><?php if($rcek1['stat_nedle']=='FAIL' or $rcek1['stat_nedle']=='DISPOSISI'){echo $rcek1['nedle'];}?></td>
                            
                        </tr>
                    <?php }?>
                    </tbody>
                </table>                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<script>
$(function () { 	
$(".select2").select2({
      theme: 'bootstrap4',
	  placeholder: "Select",
      allowClear: true,	
    });
$("#example").DataTable({
	});
});
</script>
