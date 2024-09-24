<script>
	
function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
function roundToThree(num) {    
    return +(Math.round(num + "e+3")  + "e-3");
}
	
function hitung_ky(){
    var lebar=document.forms['form1']['lebar'].value;
    var gramasi=document.forms['form1']['gramasi'].value;
    var hasil_ky;
        if(lebar>0){lebar=document.forms['form1']['lebar'].value;}else{ lebar=0;}
        if(gramasi>0){gramasi=document.forms['form1']['gramasi'].value;}else{ gramasi=0;}
        hasil=roundToTwo((parseFloat(lebar)*parseFloat(gramasi))/43.05).toFixed(0);
        hasil_ky=roundToTwo(1000/parseFloat(hasil));
        if(gramasi==0){document.forms['form1']['hasil_ky'].value=0;}else{
        document.forms['form1']['hasil_ky'].value=hasil_ky;}
}
function hitung_kg(){
    var kg=document.forms['form1']['kg'].value;
    var hasil_ky=document.forms['form1']['hasil_ky'].value;
    var hasil_y;
        if(kg>0){kg=document.forms['form1']['kg'].value;}else{ kg=0;}
        if(hasil_ky>0){hasil_ky=document.forms['form1']['hasil_ky'].value;}else{ hasil_ky=0;}
        hasil_y=roundToTwo(parseFloat(kg)*parseFloat(hasil_ky));
        if(hasil_ky==0){document.forms['form1']['hasil_y'].value=0;}else{
        document.forms['form1']['hasil_y'].value=hasil_y;}
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Konversi Yard</title>
	<script src="plugins/highcharts/code/highcharts.js"></script>
    <script src="plugins/highcharts/code/highcharts-3d.js"></script>
	<script src="plugins/highcharts/code/modules/exporting.js"></script>
    <script src="plugins/highcharts/code/modules/export-data.js"></script>
	<style type="text/css">
#container {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
	</style>
  </head>
  <body>
<form class="form-horizontal" action="LihatGrafikDT" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <div class="box box-success" style="width: 98%;">
        <div class="box-header with-border">
            <h3 class="box-title">Konversi Yard</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body"> 
	        <div class="col-md-10">
                <!-- KONVERSI YARD BEGIN-->
				<div class="form-group">
					<label for="lebar" class="col-sm-3 control-label">LEBAR</label>
					<div class="col-sm-3">
						<input name="lebar" type="text" class="form-control" id="lebar" value="" placeholder="Lebar" onChange="hitung_ky();" onBlur="hitung_ky();" style="text-align: right;">
					</div>                                  
                    <div class="col-sm-2">
                        <input name="label_ky" class="form-control" id="label_ky" value="Konversi Yard" placeholder="" style="text-align: left;" readonly>
					</div>
					<div class="col-sm-2">
                        <input name="hasil_ky" class="form-control" id="hasil_ky" value="0" placeholder="" style="text-align: right;">
					</div>
				</div>
                <div class="form-group">
                    <label for="gramasi" class="col-sm-3 control-label">GRAMASI</label>
                    <div class="col-sm-3">
                        <input name="gramasi" type="text" class="form-control" id="gramasi" value="" placeholder="Gramasi" onChange="hitung_ky();" onBlur="hitung_ky();" style="text-align: right;">
					</div>
                </div>
                <div class="form-group">
					<label for="kg" class="col-sm-3 control-label">KG</label>
					<div class="col-sm-3">
						<input name="kg" type="text" class="form-control" id="kg" value="" placeholder="KG" onChange="hitung_kg();" onBlur="hitung_kg();" style="text-align: right;">
					</div>                                  
                    <div class="col-sm-2">
                        <input name="label_y" class="form-control" id="label_y" value="Yard" placeholder="" style="text-align: left;" readonly>
					</div>
					<div class="col-sm-2">
                        <input name="hasil_y" class="form-control" id="hasil_y" value="0" placeholder="" style="text-align: right;">
					</div>
				</div>
                <!-- KONVERSI YARD END-->
            </div>
        </div>
    </div>
</form>
</body>
</html>