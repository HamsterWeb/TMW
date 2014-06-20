@extends('layout.default')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}" />
@stop

{{-- print_r($geoarea, 1) --}}
@section('content')


 <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-12 heading">
            <h3> Add a spot </h3>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="alert alert-danger alert-dismissable hidden" id="alertOnSubmitFail">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
              <strong> Ooups!.. </strong> There was a problem processing your request, it might be due to some technical problem, please try again later
            </div>
        </div>
      </div>

      <div class="row">
        <div id="form-new-spot-wrap" >
      	{{ Form::open(array('route' => 'newSpot', 'class' => 'form-horizontal', 'id'=>'addSpotForm')) }}

          <div class="col-md-6 col-xs-12">
            <div class="form-wrap">
              	<div class="form-group">
              		<div class="col-sm-4">
              			{{ Form::label('geoarea', 'Geographical area')}}
              		</div>
              		<div class="col-sm-8">
              			{{ Form::select('geoarea', array('' => '')+$geoarea, null) }}
              		</div>
              	</div>

              	<div class="form-group">
              		<div class="col-sm-4">
              			{{ Form::label('georegion', 'Geographical region')}}
              		</div>
              		<div class="col-sm-8">
                    {{ Form::hidden('georegion', null, array('id'=>'georegion')) }}
              		</div>
              	</div>

                <div class="form-group">
                  <div class="col-sm-4">
                    {{ Form::label('spotname', 'Spot name')}}
                  </div>
                  <div class="col-sm-8">
                    {{ Form::text('spotname', '', array('id' => 'spotname', 'class'=>'form-control')) }}
                    <div class="error-message"> Please enter the value </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-4">
                    <label>You can practice </label>
                  </div>
                  <div class="col-sm-4">
                    {{ Form::hidden('windsurf', false) }}
                    {{ Form::checkbox('windsurf', true) }}
                    {{ Form::label('windsurf', 'Windsurf', array('class'=>'check-label'))}}
                  </div>
                  <div class="col-sm-4">
                    {{ Form::hidden('kitesurf', false) }}
                    {{ Form::checkbox('kitesurf', true) }}
                    {{ Form::label('kitesurf', 'Kitesurf', array('class'=>'check-label'))}}
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-4">
                    {{ Form::label('waves', 'Waves height')}}
                  </div>
                  <div class="col-sm-8">
                    <small> 1m </small> 
                    <input type="range" name="waves" id="waves" min=1 max=10 step=0.5 />
                    <small> 10m </small>
                    <output for="waves" onforminput="value = waves.valueAsNumber"> </output>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-4">
                    {{ Form::label('description', 'Description') }}
                  </div>
                  <div class="col-sm-8">
                    {{ Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'General information', 'rows'=>7)) }}
                    <div class="error-message"> There are some disallowed characters </div>
                  </div>
                </div>

                 <div class="form-group">
                    <div class="col-sm-4">
                      {{ Form::label('tide', 'Dependent on tide') }}
                    </div>
                    <div class="col-sm-4">
                      {{ Form::radio('tide', '1', true, array('id' => 'tide_yes')) }}
                      {{ Form::label('tide_yes', 'Yes', array('class'=>'check-label'))}}
                    </div>
                    <div class="col-sm-4">
                      {{ Form::radio('tide', '0', false, array('id' => 'tide_no')) }}
                      {{ Form::label('tide_no', 'No', array('class'=>'check-label'))}}
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-4">
                    {{ Form::label('difficulty', 'Difficulty', array('class' => 'nobottommargin')) }} <br/>
                    <small> 1 - easy, 10 - very difficult </small>
                  </div>
                  <div class="col-sm-8">
                    <small> 1 </small> 
                    <input type="range" name="difficulty" id="difficulty" min=1 max=10 step=0.5 />
                    <small> 10 </small>
                    <output for="difficulty" onforminput="value = difficulty.valueAsNumber"> </output>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-4">
                    {{ Form::label('water_type', 'Water type') }}
                  </div>
                  <div class="col-sm-8">
                      {{ Form::select('water_type', array(1 => 'ocean', 2 => 'sea'), null, array('class' =>'form-control', 'id' => 'water_type')) }}
                  </div>
                </div>

              </div>
          </div>
          <div class="col-md-6">
             <div class="form-wrap">

                 <div class="form-group">
                  <div class="col-sm-4">
                    {{ Form::label('environment', 'Environment') }}
                  </div>
                  <div class="col-sm-8">
                    {{ Form::textarea('environment', null, array('class'=>'form-control', 'placeholder'=>'Facilities, nature, launching/landing conditions...', 'rows'=>7)) }}
                    <div class="error-message"> There are some disallowed characters </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-4">
                    {{ Form::label('accessibility', 'Accessibility', array('class' => 'nobottommargin')) }} <br/>
                    <small> 1 - easy, 10 - very difficult </small>
                  </div>
                  <div class="col-sm-8">
                    <small> 1 </small> 
                    <input type="range" name="accessibility" id="accessibility" min=1 max=10 step=0.5 />
                    <small> 10 </small>
                    <output for="accessibility" onforminput="value = accessibility.valueAsNumber"> </output>
                  </div>
                </div>

                 <div class="form-group">
                  <div class="col-sm-4">
                    {{ Form::label('wg', 'Windguru reliable') }}
                  </div>
                  <div class="col-sm-3">
                    {{ Form::radio('wg', '0', false, array('id' => 'wg_under')) }}
                    {{ Form::label('wg_under', 'Underestimated', array('class'=>'check-label')) }}
                  </div>
                  <div class="col-sm-2">
                    {{ Form::radio('wg', '1', true, array('id' => 'wg_yes')) }}
                    {{ Form::label('wg_yes', 'Correct', array('class'=>'check-label'))}}
                  </div>
                  <div class="col-sm-3">
                    {{ Form::radio('wg', '2', false, array('id' => 'wg_over')) }}
                    {{ Form::label('wg_over', 'Overestimated', array('class'=>'check-label'))}}
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-4">
                      {{ Form::label('advantages', 'Good points') }}
                    </div>
                    <div class="col-sm-8">
                      {{ Form::textarea('advantages', null, array('class'=>'form-control', 'placeholder'=>'Nice people, security, a lot of space...', 'rows'=>5)) }}
                      <div class="error-message"> There are some disallowed characters </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-4">
                      {{ Form::label('disadvantages', 'Bad points') }}
                    </div>
                    <div class="col-sm-8">
                      {{ Form::textarea('disadvantages', null, array('class'=>'form-control', 'placeholder'=>'Crowded, dirty water, too cold ...', 'rows'=>5)) }}
                      <div class="error-message"> There are some disallowed characters </div>
                    </div>
                  </div>
                  </div><!-- form-wrap-->
                </div><!-- md-6 -->

                <div class="col-xs-12">
                  <div class="form-wrap text-center">
                    <button class="btn btn-default btn-lg" id="addSpot"> Submit </button>
                  </div>
                </div>
              </div>
          </div>
        {{ Form::close() }}
        </div>
     </div>
	 </div>


	
@stop
@section('scripts')
<!--Load the AJAX API-->
    <script type='text/javascript' src='{{ asset("assets/js/select2.min.js") }}'></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type='text/javascript'>
    $(function(){

      $("#geoarea").select2({
        placeholder: 'Choose an area',
        allowClear: true
        
      });


     var regions = [];
     setRegions(regions);

     /*   set the list of regions on area select    */
     $('#geoarea').on('change', function(e) {
          var regArr = [];
          $.ajax({
                    url: "/georegion/find",
                    type: "POST",
                    data: { unit: e.val },
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(i, v) {
                            regArr.push({ id: i, text: v });
                        });
                        setRegions(regArr);
                    }
          });
      });
    
    /*  set the list of georegions   */
      function setRegions(data) {
            $("#georegion").select2({
              width:'off',
              placeholder: 'Choose a region',
              data: data,
              results: function(data) {
                return { results: data }
              }
          });
      }

      /*  control the spotname, check if exists   */
      $(document).on("keyup focusout", "#spotname", throttle(function(e){
           if (e.keyCode !== 9 && e.keyCode !== 16) /* Différent de Tab et Shift*/ {
                if(controle_regex(this, text_reg)) {
                  var spotname = $(this).val();
                  var msg = $(this).siblings("div.error-message");
                  var region = $("#georegion").val();
                  var obj = $(this);

                  if(region.length <= 0){
                    obj.addClass("error");
                    msg.show();
                    msg.html("Please select the region first");
                  }
                  else {
                    obj.removeClass("error");
                    msg.hide();
                  }

                  $.ajax({
                      url: "/spot/checkname",
                      type: "POST",
                      dataType: "json",
                      data: {name: spotname, region: region },
                      success: function(data){
                          if(data.length > 0) {
                            var name = data["0"].name;
                            var id = data["0"].id;
                            obj.addClass("error");
                            msg.show();
                            msg.html("The spot already exists. See <a href='/spot/"+id+"'> "+name+"</a>");
                          }
                          else{
                            obj.removeClass("error");
                            msg.hide();
                          }
                      }
                  });
                }
          }
      }));
  
  /*   get latitude & longitude   */
    var getLatLong = function(name, callback){
      var geocoder =  new google.maps.Geocoder();
      geocoder.geocode( { 'address': name}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              callback({ lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng() });
            } else {
              callback({ 1: 'Unable to find' });
            }
      });
    }

  /*LatLng.getLatLong("Ilha do Guajiru", function(data) {
    console.log(data);
  });
  var latlng = [];
  getLatLong('prea', function(data) { latlng = data; console.log(data.lng)});
  console.log(latlng);*/

  /*   regex control on textareas    */
  $(document).on('keyup focusout blur', '#description, #environment, #advantages, #disadvantages',
         function(e) {
            if (e.keyCode !== 9 && e.keyCode !== 16) /* Différent de Tab et Shift*/ {
                 controle_regex_or_null(this, text_num_reg); 
                 //console.log("ok");
            }
        });

  /*   submitting     */
  $("#addSpot").on('click', function(e){
      e.preventDefault();
      var error = false;
      var form = $("#addSpotForm");
      var inputs = form.find("input");
      var alert = $("#alertOnSubmitFail");
      //console.log(form.serialize());
      inputs.each(function () {
          $(this).blur();
          if($(this).hasClass('error')) { 
              error = true;
              //return false;
          }
         });
         
      if(error == false) {
          $.ajax({
                          type: 'post',
                          cache: false,
                          url: "/spot/add",
                          dataType: 'json',
                          data: form.serialize(),
                          success: function(data) {
                              if(data.success == false)
                              {
                                  alert.show();
                              } else {
                                   if(data.id) { //insérer lat et long
                                      getLatLong('prea', function(latlng) { 
                                        $.ajax({
                                            type:"post",
                                            url:"/spot/addlatlng",
                                            dataType:"json",
                                            data: {id: data.id, lat: latlng.lat, lng:latlng.lng },
                                            success: function(response) {
                                              if(response.success == false){
                                                  alert.show();
                                              }
                                              else {
                                                  window.location.href = "/spot/"+data.id;
                                              }
                                            }
                                        });
                                      });
                                   }
                              }
                          },
                          error: function(xhr, textStatus, thrownError) {
                              alert.show();
                          }
                      });
      }
  });
      
      
});

    
</script>
  
@stop