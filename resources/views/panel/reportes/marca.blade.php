@extends('layouts.panel')

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reporte de marcas</h4>
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
    $(document).ready(function() {
        var chart
        demo.initDateTimePicker();
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            chart = am4core.create("chartdiv", am4charts.XYChart);

            // Add data
            chart.data = [
              @foreach ($marcas as $pos => $row)
              {
                "state": "{{preg_replace( "/\r|\n/", "",$row->state)}}",
                "sales": {{round($row->sales)}}
              },
              @endforeach
            ];

            // Create axes
            var yAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            yAxis.dataFields.category = "state";
            yAxis.renderer.grid.template.location = 0;
            yAxis.renderer.labels.template.fontSize = 10;
            yAxis.renderer.minGridDistance = 10;

            var xAxis = chart.xAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = "sales";
            series.dataFields.categoryY = "state";
            series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
            series.columns.template.strokeWidth = 0;
            series.columns.template.adapter.add("fill", function(fill, target) {
                // if (target.dataItem) {
                //   switch(target.dataItem.dataContext.region) {
                //     case "Central":
                //       return chart.colors.getIndex(0);
                //       break;
                //     case "East":
                //       return chart.colors.getIndex(1);
                //       break;
                //     case "South":
                //       return chart.colors.getIndex(2);
                //       break;
                //     case "West":
                //       return chart.colors.getIndex(3);
                //       break;
                //   }
                // }
                return fill;
            });

            // Add ranges
            function addRange(label, start, end, color) {
                var range = yAxis.axisRanges.create();
                range.category = start;
                range.endCategory = end;
                range.label.text = label;
                range.label.disabled = false;
                range.label.fill = color;
                range.label.location = 0;
                range.label.dx = -130;
                range.label.dy = 12;
                range.label.fontWeight = "bold";
                range.label.fontSize = 12;
                range.label.horizontalCenter = "left"
                range.label.inside = true;

                range.grid.stroke = am4core.color("#396478");
                range.grid.strokeOpacity = 1;
                range.tick.length = 200;
                range.tick.disabled = false;
                range.tick.strokeOpacity = 0.6;
                range.tick.stroke = am4core.color("#396478");
                range.tick.location = 0;

                range.locations.category = 1;
            }
            //
            // addRange("Central", "Texas", "North Dakota", chart.colors.getIndex(0));
            // addRange("East", "New York", "West Virginia", chart.colors.getIndex(1));
            // addRange("South", "Florida", "South Carolina", chart.colors.getIndex(2));
            // addRange("West", "California", "Wyoming", chart.colors.getIndex(3));

            chart.cursor = new am4charts.XYCursor();

        }); // end am4core.ready()

        $('#the-form').submit(function(e) {
            e.preventDefault()
            e.stopPropagation()
            var desde = $('#desde').val();
            var hasta = $('#hasta').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ url('panel/reportes/marcasAjax') }}",
                data: {
                    desde: desde,
                    hasta: hasta
                },
                dataType: 'json',
                success: function(data) {
                    chart.data = data;
                }
            });
        });
    });
</script>
@endsection
