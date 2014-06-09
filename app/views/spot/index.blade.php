@extends('layout.default')

@section('content')
  <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-12 heading">
            <h3> Choose your spot </h3>
        </div>
      </div>

      <div class="row">
          <div class="col-md-3 col-xs-12" id="left-bar">
            <div id="form-filter-wrap" class="form-wrap">
              {{ Form::open(array('route' => 'index')) }}
              <div class="form-group">
                {{ Form::label('geoarea', 'Geographical area')}}
                {{ Form::select('geoarea', array(
                      1 => 'Europe',
                      2 => 'Asia',
                      3 => 'Africa'
                    ), null, array('class' => 'form-control') ) 
                  }}
              </div>
              <div class="form-group">
              </div>
            </div>
          </div>
          <div class="col-md-8" id="map-wrapper">
	 	         <div id="map" >
	 	         </div>
          </div>
     </div>
	 </div>
@stop

@section('scripts')
<!--Load the AJAX API-->
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
     google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Spot', ''],
          ['Essaouira', 3],
          ['Tarifa', 4],
          ['Cambucu', 7],
          ['Melville-Franceville', 8],
          ['Leucate', 8],
          ['Jericoacoara', 9]
        ]);

        var options = {
        	displayMode: 'text',
        	backgroundColor: {fill: "#fff", stroke: '#E8E8E8'} , 
        	region: 'world',
          colorAxis : {minValue:0, maxValue:10, colors: ['#149ECC', '#3D8299']}

        };

        var chart = new google.visualization.GeoChart(document.getElementById('map'));
        chart.draw(data, options);
    };
    </script>
	
@stop