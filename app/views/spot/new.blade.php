@extends('layout.default')

@section('content')


 <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-12 heading">
            <h3> Add a spot </h3>
        </div>
      </div>

      <div class="row">
        <div id="form-new-spot-wrap" >
      	{{ Form::open(array('route' => 'newSpot', 'class' => 'form-horizontal')) }}

          <div class="col-md-6 col-xs-12">
            <div class="form-wrap">
              	<div class="form-group">
              		<div class="col-sm-4">
              			{{ Form::label('geoarea', 'Geographical area')}}
              		</div>
              		<div class="col-sm-8">
              			{{ Form::select('geoarea', array(
              					1 => 'Europe',
              					2 => 'Asia',
              					3 => 'Africa'
              				), null, array('class' => 'form-control') ) 
              			}}
              		</div>
              	</div>
              	<div class="form-group">
              		<div class="col-sm-4">
              			{{ Form::label('geounit', 'Geographical unit')}}
              		</div>
              		<div class="col-sm-8">
              			{{ Form::select('geounit', array(
              					1 => 'Europe',
              					2 => 'Asia',
              					3 => 'Africa'
              				), 1, array('class' => 'form-control') ) 
              			}}
              		</div>
              	</div>
              	<div class="form-group">
              		<div class="col-sm-4">
              			{{ Form::label('georegion', 'Region (optional)')}}
              		</div>
              		<div class="col-sm-8">
              			{{ Form::select('georegion', array(
              					1 => 'Europe',
              					2 => 'Asia',
              					3 => 'Africa'
              				), 1, array('class' => 'form-control') ) 
              			}}
              		</div>
              	</div>
              </div>
          </div>
          <div class="col-md-6">
	 	         
          </div>
        {{ Form::close() }}
        </div>
     </div>
	 </div>


	
@stop