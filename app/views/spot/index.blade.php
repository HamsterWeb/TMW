@extends('layout.default')
{{-- var_dump() --}}
@section('content')
  <div class="container-fluid">
      <div class="row bottommargin">
        <div class="col-xs-12 col-md-12 heading">
            <h3> Choose the best spot for you </h3>
        </div>
      </div>

      <div class="row bottommargin">
        <div class="col-md-12">
          <div id="periods" class="tag-wrap">
            @foreach(App::make('period') as $num => $period)
              <span class="tag {{ date('n') == $num ? 'active' : '' }}" id="period-{{ $num }}"> {{ $period }}</span>
            @endforeach
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-md-2 col-xs-12" id="left-bar">
          </div>
          <div class="col-md-9" id="map-wrapper">
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
     
     var spots;
     var period = 0;

     google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(load_spots);


     function load_spots(){
        var periodArr = $('#periods').find('span');
        var period = getElementId(periodArr).replace('period-', '');

        $.ajax({
                url: "spot/all",
                type: "POST",
                data: { 'period': period },
                dataType: "JSON",
                async:false,
                success: function(data) {
                  if(data.success) {
                    spots = JSON.parse(data.spots); 
                    drawMap(spots);
                  }
              }
        });
    }

    function drawMap(data){
      var data  = google.visualization.arrayToDataTable(data);

      var options = {
        displayMode: 'text',
        backgroundColor: {fill: "#fff", stroke: '#E8E8E8'} , 
        region: 'world',
        colorAxis : {minValue:6, maxValue:10, colors: ['#3D8299', '#285374']},
        sizeAxis : { minSize:10, maxSize:14 }

      };

      var chart = new google.visualization.GeoChart(document.getElementById('map'));
      chart.draw(data, options);
    }

  $(function(){
    var period = 0;
    var kitesurf = 1;
    var windsuf = 1;
    var waves = 0;
    var level = 0;

    $(document).on('click', '#periods span', function(){
        var tagsArray = $('#periods').find('span');
        var tag = $(this);
        var id = tag.attr('id').replace('period-', '');
        deselectTag(tagsArray);
        tag.addClass('active');
        load_spots();
    });
});
</script>
	
@stop