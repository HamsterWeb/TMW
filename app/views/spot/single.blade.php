@extends('layout.default')

@section('content')

<div class="container-fluid">
      <div class="row">
      	<div class="cols-xs-12 heading">
      		<h3> {{ $spot->name }} </h3>
                  <h5> {{ $georegion->name }},  {{ $geounit->name }} </h5>
      	</div>
      </div>

      <div class="row">
      	<div class="cols-xs-12 col-md-4">
      		<div id="map">
      		</div>
      	</div>
      	<div class="cols-xs-12 col-md-8 text-wrap" model="spot-{{ $spot->id }}">
                  <aside class="edit-btn">
                        <button type="button" class="btn btn-default btn-xs">
                              <span class="glyphicon glyphicon-pencil"></span> Edit
                        </button>
                  </aside>
      		<section>
	      		<h4>
	      			Description
	      		</h4>
	      		<p field="description">{{ $spot->description or 'Give some description' }} </p>
	      	</section>
	      	<section>
	      		<h4> Environment </h4>
	      		<p field="environment">{{ $spot->environment or 'Describe the environment' }}</p>
	      	</section>
	      	<section>
	      		<h4> Good points </h4>
	      		<p field="advantages">{{ $spot->advantages or 'Any good points?'}}</p>
	      	</section>
	      	<section>
	      		<h4> Bad points </h4>
	      		<p field="disadvantages">{{ $spot->disadvantages or 'Any bad points?'}}</p>
	      	</section>
      	</div>
      </div>

      <div class="row">
      	<div class="cols-xs-12">
			<div class="table-responsive table-wrap">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
                                          <td>
                                          </td>
                                          <td> 
                                                Water type
                                          </td>
							<td>
								Tide
							</td>
							<td>
								Waves
							</td>
							<td>
								Difficulty
							</td>
							<td>
								Windguru reliable
							</td>
							<td>
								Accessibility
							</td>
							<td>
								Global note
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
                                          <td>
                                          </td>
                                          <td>
                                                Ocean
                                          </td>
							<td>
								Yes
							</td>
							<td>
								Yes
							</td>
							<td>
								7/10
							</td>
							<td>
								Yes
							</td>
							<td>
								5/10
							</td>
							<td>
								8/10
							</td>
						</tr>
					</tbody>
				</table>
		      </div>
      	</div>
      </div>

      <div class="row">
      	<div class="table-responsive table-wrap">
      		<table class="table table-bordered table-hover table-striped">
      			<thead>
      				<tr>
      					<td>
      					</td>
      					<td class="warning">
      						January
      					</td>
      					<td class="success">
      						February
      					</td>
      					<td class="success">
      						March
      					</td>
      					<td class="success">
      						April
      					</td>
      					<td class="success">
      						May
      					</td>
      					<td class="success">
      						June
      					</td>
      					<td class="warning">
      						July
      					</td>
      					<td class="warning">
      						August
      					</td>
      					<td class="danger">
      						September
      					</td>
      					<td class="danger">
      						October
      					</td>
      					<td class="danger">
      						November
      					</td>
      					<td class="danger">
      						December
      					</td>
      				</tr>
      			</thead>
      			<tbody>
      				<tr>
      					<td>
      						Wind strength
      					</td>
      					<td>
      						January
      					</td>
      					<td>
      						February
      					</td>
      					<td>
      						March
      					</td>
      					<td>
      						April
      					</td>
      					<td>
      						May
      					</td>
      					<td>
      						June
      					</td>
      					<td>
      						July
      					</td>
      					<td>
      						August
      					</td>
      					<td>
      						September
      					</td>
      					<td>
      						October
      					</td>
      					<td>
      						November
      					</td>
      					<td>
      						December
      					</td>
      				</tr>
      				<tr>
      					<td>
      						Wind direction
      					</td>
      					<td>
      						January
      					</td>
      					<td>
      						February
      					</td>
      					<td>
      						March
      					</td>
      					<td>
      						April
      					</td>
      					<td>
      						May
      					</td>
      					<td>
      						June
      					</td>
      					<td>
      						July
      					</td>
      					<td>
      						August
      					</td>
      					<td>
      						September
      					</td>
      					<td>
      						October
      					</td>
      					<td>
      						November
      					</td>
      					<td>
      						December
      					</td>
      				</tr>
      				<tr>
      					<td>
      						Wind quality
      					</td>
      					<td>
      						January
      					</td>
      					<td>
      						February
      					</td>
      					<td>
      						March
      					</td>
      					<td>
      						April
      					</td>
      					<td>
      						May
      					</td>
      					<td>
      						June
      					</td>
      					<td>
      						July
      					</td>
      					<td>
      						August
      					</td>
      					<td>
      						September
      					</td>
      					<td>
      						October
      					</td>
      					<td>
      						November
      					</td>
      					<td>
      						December
      					</td>
      				</tr>
      			</tbody>
      		</table>
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
          ['Spot'],
          ['{{ $spot->name }}']
        ]);

        var options = {
        	displayMode: 'text',
        	backgroundColor: {fill: "#fff", stroke: '#3D8299'} , 
        	region: '{{ $geounit->iso_code }}',
            colorAxis : {colors: '#3D8299'}

        };

        var chart = new google.visualization.GeoChart(document.getElementById('map'));
        chart.draw(data, options);
    };
    </script>
	
@stop