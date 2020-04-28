@extends('layouts.panel')

@section('content')

  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Reporte de Solicitudes de Crédito</h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <form class="" action="" method="post" id="the-form">
                <div class="row">
                  <div class="col-xs-12 col-md-5">
                    <div class="form-group">
                      <input type="text" class="form-control datepicker" id="desde" value="{{$desde}}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-5">
                    <div class="form-group">
                      <input type="text" class="form-control datepicker" id="hasta" value="{{$hasta}}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-2">
                    <button type="submit" class="btn btn-primary btn-round btn-icon" name="button">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>

              </form>
            </div>
              <div id="chartdiv"></div>
            </div>
          </div>
        </div>
      </div>

  </div>
@endsection

@section('especifico')
  <!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
$(document).ready(function(){
  var chart
  demo.initDateTimePicker();
  am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    chart = am4core.create("chartdiv", am4charts.XYChart);

    var data = [];
    var value = 50;
    for(let i = 0; i < 300; i++){
      let date = new Date();
      date.setHours(0,0,0,0);
      date.setDate(i);
      value -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
      data.push({date:date, value: value});
    }

    chart.data = [
      <?php
      foreach ($solicitudes as $pos => $row) {
        ?>

        {
          "date": "<?php echo date('Y-m-d', strtotime($row->date)) ?>",
          "value": <?php echo round($row->value) ?>
        },
        <?php
      }
      ?>
    ];

    // Create axes
    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 60;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = "value";
    series.dataFields.dateX = "date";
    series.tooltipText = "{value}"

    series.tooltip.pointerOrientation = "vertical";

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.snapToSeries = series;
    chart.cursor.xAxis = dateAxis;

    //chart.scrollbarY = new am4core.Scrollbar();
    chart.scrollbarX = new am4core.Scrollbar();


  }); // end am4core.ready()

  $('#the-form').submit(function(e){
    e.preventDefault()
    e.stopPropagation()
    var desde=$('#desde').val();
    var hasta=$('#hasta').val();
    $.ajax( {
       type: "POST",
       headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
       url: "{{ url('panel/reportes/solicitudesAjax') }}",
       data: { desde:desde, hasta:hasta},
       dataType:'json',
       success: function( data ) {
         chart.data=data;
       }
     } );
  });
});
</script>
@endsection
