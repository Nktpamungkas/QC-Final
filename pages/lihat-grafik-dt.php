<?php
$Evap_0		        = isset($_GET['ev1']) ? $_GET['ev1'] : '';
$Evap_5		        = isset($_GET['ev2']) ? $_GET['ev2'] : '';
$Evap_10		    = isset($_GET['ev3']) ? $_GET['ev3'] : '';
$Evap_15		    = isset($_GET['ev4']) ? $_GET['ev4'] : '';
$Evap_20		    = isset($_GET['ev5']) ? $_GET['ev5'] : '';
$Evap_25		    = isset($_GET['ev6']) ? $_GET['ev6'] : '';
$Evap_30		    = isset($_GET['ev7']) ? $_GET['ev7'] : '';
$Evap_35		    = isset($_GET['ev8']) ? $_GET['ev8'] : '';
$Evap_40		    = isset($_GET['ev9']) ? $_GET['ev9'] : '';
$Evap_45		    = isset($_GET['ev10']) ? $_GET['ev10'] : '';
$Evap_50		    = isset($_GET['ev11']) ? $_GET['ev11'] : '';
$Evap_55		    = isset($_GET['ev12']) ? $_GET['ev12'] : '';
$Evap_60		    = isset($_GET['ev13']) ? $_GET['ev13'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Grafik</title>
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

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Grafik Evaporation Rate</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body chart-responsive">
                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                <div class="box-footer">
                    <div class="pull-right">
                        <input type="button" class="btn btn-block btn-social btn-linkedin btn-sm" name="kembali" value="Kembali" onClick="window.location.href='RumusHitung'">	   
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
</body>
</html>
<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'line',        
    },
    credits: {
        enabled: false
    },
    tooltip: {
        shared: true,
        crosshairs: true,
        headerFormat: '<b>{point.key}</b><br/>'
    },
    title: {
        text: 'Evaporation'
    },
    subtitle: {
        text: '0 s/d 60 Menit'
    },
    xAxis: {
		categories: ['0 Min', '5 Min', '10 Min', '15 Min', '20 Min', '25 Min', '30 Min', '35 Min', '40 Min', '45 Min', '50 Min', '55 Min', '60 Min'],
        labels: {
            rotation: 0,
            align: 'right',
            style: {
                fontSize: '10px',
            }
        }
    },
    legend: {
        enabled: true
    },
    yAxis: {
        title: {
            text: 'Evaporation (g/h)'
        }
    },
    series: [{
        name: 'Evaporation (g/h)',
        data: [<?php echo $Evap_0; ?>, <?php echo $Evap_5; ?>, <?php echo $Evap_10; ?>, <?php echo $Evap_15; ?>, <?php echo $Evap_20; ?>, <?php echo $Evap_25; ?>, <?php echo $Evap_30; ?>, <?php echo $Evap_35; ?>, <?php echo $Evap_40; ?>, <?php echo $_GET['ev10']; ?>, <?php echo $Evap_50; ?>, <?php echo $Evap_55; ?>, <?php echo $Evap_60; ?>],
		dataLabels: {
                enabled: true,
                format: '{point.y:.3f}',
				style: {
                fontSize: '10px',
                fontFamily: 'Arial, sans-serif'
            }
            }
    }]
});
</script>