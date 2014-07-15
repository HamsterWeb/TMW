@extends('layout.default')

@section('content')

<div class="container-fluid">
      <div class="row">
      	<div class="cols-xs-12 heading">
      		<h3> {{{ $spot->name }}} </h3>
                  <h5> {{ $spot->GeoRegion->name }},  {{ $spot->GeoRegion->GeoUnit->name }}</h5>
      	</div>
      </div>

      <!-- tabs list -->
      <div class="bottommargin tabs-wrap">
            <ul class="nav nav-tabs" role="tablist" id="tabsSingleSpot">
                  <li class="active"> 
                        <a href="#general" role="tab" data-toggle="tab">
                              General information
                               <!--<span class="glyphicon glyphicon-dashboard"></span>-->
                        </a>
                  </li>
                  <li> 
                        <a href="#now" role="tab" data-toggle="tab">
                              At the moment
                               <!--<span class="glyphicon glyphicon-flag"></span>-->
                        </a>
                  </li>
                  <li> 
                        <a href="#comments" role="tab" data-toggle="tab">
                              User comments
                              <!--<span class="glyphicon glyphicon-comment"></span>-->
                        </a>
                  </li>
                  <li> 
                        <a href="#photos" role="tab" data-toggle="tab">
                              Photos
                               <!--<span class="glyphicon glyphicon-camera"></span>-->
                        </a>
                  </li>
            </ul>
      </div>

      <div class="tab-content">
            <div class="tab-pane fade in active" id="general">
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
            	      		<p field="description" type="text">{{{ $spot->description ? : 'Give some description'}}}</p>
            	      	</section>
            	      	<section>
            	      		<h4> Environment </h4>
            	      		<p field="environment" type="text">{{{ $spot->environment ? : 'Describe the environment'}}}</p>
            	      	</section>
            	      	<section>
            	      		<h4> Good points </h4>
            	      		<p field="advantages" type="text">{{{ $spot->advantages or 'Any good points?'}}}</p>
            	      	</section>
            	      	<section>
            	      		<h4> Bad points </h4>
            	      		<p field="disadvantages" type="text">{{{ $spot->disadvantages or 'Any bad points?'}}}</p>
            	      	</section>
                  	</div>
                  </div>

                  <div class="row">
                  	<div class="cols-xs-12">
            			<div class="table-responsive table-wrap" model="spot-{{ $spot->id }}">
                                    <aside class="edit-btn">
                                          <button type="button" class="btn btn-default btn-xs">
                                                <span class="glyphicon glyphicon-pencil"></span> Edit
                                          </button>
                                    </aside>
            				<table class="table table-bordered table-striped table-hover">
            					<thead>
            						<tr>
                                                      <td class="hidden">
                                                      </td>
                                                      <td>
                                                            Kitesurf
                                                      </td>
                                                      <td>
                                                            Windsurf
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
                                                      <td class="hidden">
                                                      </td>
                                                      <td>
                                                            <p field="kitesurf" type="select-yn" >
                                                                  {{ $spot->kitesurf == 1 ? "Yes" : "No" }}
                                                            </p>
                                                      </td>
                                                      <td>
                                                            <p field="windsurf" type="select-yn">
                                                                  {{ $spot->windsurf == 1 ? "Yes" : "No" }}
                                                            </p>
                                                      </td>
                                                      <td>
                                                            <p field="type_id" type="select-water">
                                                                  {{ App::make('water')[$spot->type_id] }}
                                                      </td>
            							<td>
                                                            <p field="tide" type="select-yn">
            								    {{ $spot->tide == 1 ? "Depends" : "No matter" }}
                                                            </p>
            							</td>
            							<td>
                                                            <p field="waves" type="range-10">
            								    {{ $spot->waves }} m
                                                            </p>
            							</td>
            							<td>
                                                            <p field="difficulty" type="range-10">
            								    {{ $spot->difficulty }}/10
                                                            </p>
            							</td>
            							<td>
            								<p field="windguru_reliable" type="select-wg">
                                                                  {{ App::make('wg')[$spot->windguru_reliable] }}
                                                            </p>
            							</td>
            							<td>
                                                            <p field="accessibility" type="range-10">
            								    {{ $spot->accessibility }}/10
                                                            </p>
            							</td>
            							<td>
            								8/10
            							</td>
            						</tr>
            					</tbody>
            				</table>
            		      </div><!-- table-wrap-->
            	     </div>
                  </div><!-- row-->

                  <div class="row">
                  	<div class="table-responsive table-wrap" model="spotinperiod-{{ $spot->id }}">
                              <aside class="edit-btn">
                                    <button type="button" class="btn btn-default btn-xs">
                                          <span class="glyphicon glyphicon-pencil"></span> Edit
                                    </button>
                              </aside>
                  		<table class="table table-bordered table-hover table-striped">
                  			<thead>
                  				<tr>
                  					<td>
                  					</td>
                                                @foreach($spot->periods as $period)
                  					<td class="{{ App::make('class-color')[$period->pivot->evaluation or 0] }}">
                  						{{ $period->name }}
                  					</td>
                                                @endforeach
                  				</tr>
                  			</thead>
                  			<tbody>
                  				<tr>
                  					<td>
                  						Wind strength
                  					</td>
                                                @foreach($spot->periods as $period)
                                                <td>
                                                      <p field="wind_knots" type="range-50" period="{{ $period->id }}">
                                                            {{ $period->pivot->wind_knots }} kn
                                                      </p>
                                                </td>
                                                @endforeach
                  				</tr>
                  				<tr>
                  					<td>
                  						Wind direction
                  					</td>
                                                @foreach($spot->periods as $period)
                                                <td>
                                                      <p field="wind_direction" type="select-direction" period="{{ $period->id }}">
                                                            {{ App::make('direction')[$period->pivot->wind_direction] }}
                                                      </p>
                                                </td>
                                                @endforeach
                  					
                  				</tr>
                  				<tr>
                  					<td>
                  						Wind quality
                  					</td>
                  					@foreach($spot->periods as $period)
                                                <td>
                                                      <p field="wind_quality" type="select-quality" period="{{ $period->id }}">
                                                            {{ App::make('quality')[$period->pivot->wind_quality] }}
                                                      </p>
                                                </td>
                                                @endforeach
                  				</tr>
                                          <tr>
                                                <td>
                                                      Wind percentage
                                                </td>
                                                @foreach($spot->periods as $period)
                                                <td>
                                                      <p field="wind_percentage" type="range-100" period="{{ $period->id }}">
                                                      {{ $period->pivot->wind_percentage }} %
                                                </td>
                                                @endforeach
                                          </tr>
                                          <tr>
                                                <td>
                                                      Air temperature
                                                </td>
                                                @foreach($spot->periods as $period)
                                                <td>
                                                      <p field="temp_air" type="range-50" period="{{ $period->id }}">
                                                            {{ $period->pivot->temp_air }} C
                                                      </p>
                                                </td>
                                                @endforeach
                                          </tr>
                                          <tr>
                                                <td>
                                                      Water temperature
                                                </td>
                                                @foreach($spot->periods as $period)
                                                <td>
                                                      <p field="temp_water" type="range-50" period="{{ $period->id }}">
                                                            {{ $period->pivot->temp_water }} C
                                                      </p>
                                                </td>
                                                @endforeach
                                          </tr>
                                          <tr>
                                                <td>
                                                      Weather
                                                </td>
                                                @foreach($spot->periods as $period)
                                                <td>
                                                      <p field="weather" type="select-weather" period="{{ $period->id }}">
                                                            {{ App::make('weather')[$period->pivot->weather] }}
                                                      </p>
                                                </td>
                                                @endforeach
                                          </tr>
                  			</tbody>
                  		</table>
                  	</div>
                  </div><!--/row-->
            </div><!-- /tab-pane-->

            <!-- now-->
            <div class="tab-pane fade" id="now">
            </div>

            <!-- comments-->
            <div class="tab-pane fade" id="comments">
                  <div class="row">
                       <!-- <div class="sticker col-md-offset-10">
                             
                              <a> Leave a comment </a>
                            
                        </div>-->
                  </div>
                  <div class="clearfix">
                  </div>
                  @foreach($spot->reviews as $review)
                        <div class="row">
                              <div class="col-xs-12 col-sm-2 col-md-2">
                                    <aside class="card">
                                          <h5>{{ $review->rider->nickname }}</h5>
                                          <figure>
                                                @if(empty($review->rider->avatar) || !$review->rider->avatar)
                                                <img src="{{ asset('media/rider/avatar.jpg') }}" alt="avatar" class="img-thumbnail" />
                                                @else
                                                <img src="{{ $rider->avatar }}" alt="avatar" class="img-thumbnail" />
                                                @endif
                                          </figure>
                                          <ul>
                                                @if($review->rider->kitesurfer == 1)
                                                <li>
                                                      <span class="glyphicon glyphicon-star"></span>
                                                      Kitesurfer : {{ App::make('level')[$review->rider->k_level] }} 
                                                </li>
                                                @endif

                                                @if($review->rider->windsurfer == 1)
                                                <li>
                                                      <span class="glyphicon glyphicon-star"></span>
                                                      Windsurfer : {{ App::make('level')[$review->rider->w_level] }} 
                                                </li>
                                                @endif
                                          </ul>
                                    </aside>
                              </div>
                              <div class="col-xs-12 col-sm-8 col-md-8">
                                    <section class="comment text-wrap">
                                          <h4> "{{ $review->title}}"</h4>
                                          <small> 
                                                posted on {{ date('d/m/Y H:i', strtotime($review->date_comment)) }} by <span>{{ $review->rider->nickname }}</span> 
                                          </small>
                                          <blockquote>
                                                <p>{{ $review->comment }}</p>
                                          </blockquote>
                                          <div>
                                                @if(Auth::check() && $review->rider->id == Auth::user()->id)
                                                      <button class="btn btn-default btn-xs remove-comment" id="remove-{{ $review->id }}">
                                                            <span class="glyphicon glyphicon-remove"> </span>Remove
                                                      </button>
                                                @endif
                                          </div>
                                    </section>
                              </div>
                              <div class="col-sm-2 col-md-2">
                                    <h3> {{ $review->avg_rate }}/10</h3>
                                    <div class="rating-small-wrap">
                                          @for($i = 1; $i <= $review->avg_rate; $i++)
                                                <span class="rating-star active"></span>
                                          @endfor

                                          @for($i = 1; $i <= (10 - $review->avg_rate); $i++)
                                                <span class="rating-star"></span>
                                          @endfor
                                    </div>
                                    <div>
                                          @if(!empty($review->periods))
                                                <label> stayed here in : </label>
                                                @foreach($review->periods as $num)
                                                      {{ App::make('period')[$num->id] }}
                                                @endforeach
                                          @endif
                                    </div>
                              </div>

                        </div>
                  @endforeach

                  <div class="border"> </div>
                  <!-- leave a comment -->
                  <div class="row" id="leaveacomment">
                        <div class="col-xs-12">
                              <h6>
                                    Leave a comment and evaluate this spot ! 
                              </h6>
                        </div>
                        @if(!Auth::check())
                        <div class="col-xs-12">
                              <p> <a href="{{ url('/rider/login') }}" > Log in </a> to leave a comment </p>
                        </div>
                        @else
                        <div class="col-xs-12 col-md-6">
                              <div class="form-wrap">
                              {{ Form::open(array('id'=>'addSpotCommentForm', 'class' => 'form-horizontal')) }}
                                    <input type="hidden" id="rider" value="{{ Auth::user()->id }} "/>
                                    <div class="form-group">
                                      <div class="col-sm-3">
                                        {{ Form::label('title', 'Title')}}
                                      </div>
                                      <div class="col-sm-9">
                                        {{ Form::text('title', '', array('id' => 'title', 'class'=>'form-control', 'placeholder' => 'Your title goes here')) }}
                                        <div class="error-message"> Please enter the value </div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <div class="col-sm-3">
                                        {{ Form::label('comment', 'Comment') }}
                                      </div>
                                      <div class="col-sm-9">
                                        {{ Form::textarea('comment', null, array('class'=>'form-control', 'placeholder'=>'Your comment here', 'rows'=>7)) }}
                                        <div class="error-message"> There are some disallowed characters </div>
                                      </div>
                                    </div>
                              </div>
                        </div>

                        <!---rating-->
                        <div class="col-xs-6 col-md-6">
                              <div class="form-wrap form-horizontal">
                                    <div class="col-xs-12 no-padding bottommargin">
                                          <h5>Give your overall rating for this spot</h5>
                                    </div>
                                    <div class="form-group">
                                          <div class="col-xs-12">
                                                <label> You stayed here in </label>
                                          </div>
                                          <div class="col-xs-3 col-sm-12 col-md-12">
                                                <div class="tag-wrap align-left" id="periods">
                                                      @foreach(App::make('period') as $num => $period)
                                                        <span class="tag" id="period-{{ $num }}"> {{ $period }}</span>
                                                      @endforeach
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <div class="col-xs-12">
                                                <label> Your rating </label>
                                          </div>
                                          <div class="col-xs-12">
                                                <div class="rating-wrap" id="rating">
                                                      @for($i=1; $i<=10; $i++)
                                                            <span class="rating-star"></span>
                                                      @endfor
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="col-xs-12">
                              <div class="alert alert-danger alert-dismissable no-display" id="alertAddSpotEvalFail">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
                                    <span>There was a problem processing your request, it might be due to some technical problem, please try again later</span>
                              </div>
                        </div>
                        <div class="col-xs-12">
                          <div class="form-wrap text-center">
                            <button class="btn btn-default btn-lg" id="addSpotEvaluation"> Submit </button>
                          </div>
                        </div>
                        {{ Form::close() }}
                        @endif
                  </div>

            </div>

            <!-- photos -->
            <div class="tab-pane fade" id="photos">
            </div>

      </div><!-- /tab-content-->

      <!-- modal on submit comment -->
      <div  id="modalOnCommentSubmit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header">
                              <h4 class="modal-title">
                                    Thanks
                                          @if(Auth::check())
                                                {{ Auth::user()->nickname }} !
                                          @endif
                              </h4>
                        </div>
                        <div class="modal-body">
                              Your comment has been successfully added
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-default reload">
                                    See your comment
                              </button>
                        </div>
                  </div>
            </div>
      </div>
      <!-- modal on delete comment -->
      <div  id="modalOnCommentDelete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header">
                              <h4 class="modal-title">
                                   Mmmm....
                              </h4>
                        </div>
                        <div class="modal-body">
                              Are you sure you want to delete this comment ?
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" id="confirm-remove">
                                    Yes
                              </button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">
                                    No
                              </button>
                        </div>
                  </div>
            </div>
      </div>
</div><!-- /container fluid-->
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
        	region: '{{ $spot->GeoRegion->GeoUnit->iso_code }}',
            colorAxis : {colors: '#3D8299'}

        };

        var chart = new google.visualization.GeoChart(document.getElementById('map'));
        chart.draw(data, options);
    };

    $(function(){
      //console.log(location.hash);

      $("#addSpotEvaluation").on("click", function(e){
            e.preventDefault();
            var alert = $("#alertAddSpotEvalFail");
            var modal = $("#modalOnCommentSubmit");
            var periodsArray = [];
            $('#periods').find('span.active').each(function(){
                  periodsArray.push($(this).attr('id').replace('period-', ''));
            });
            
            var starsArray = $('#rating').find('span.active').length;

            if(periodsArray.length > 0) {
                  if(controle_regex($('#title'), text_num_reg) && controle_regex($('#comment'), text_num_reg)){
                        var title = $('#title').val();
                        var comment = $('#comment').val();
                        var spot = {{ $spot->id }};
                        var rider = $("#rider").val();

                        $.ajax({
                            type: 'post',
                            url: "/review/add",
                            dataType: 'json',
                            data: {title: title, comment: comment, spot: spot, rider: rider, periods: periodsArray, rate: starsArray },
                            success: function(data) {
                                if(data.success == false) {
                                    alert.find('span').html(arrayToString(data.errors));
                                    alert.show();
                                } else {
                                    alert.hide();
                                    modal.modal();
                                }
                              }
                        });
                  
                  }
                  else
                  {
                        alert.show();
                  }
            }else {
                  alert.find('span').html('Please select the period');
                  alert.show();
            }

      });

      /* reload button */
      $(document).on("click", ".reload", function(){
            window.location.reload(true);
       });

      $(".remove-comment").on("click", function(e){
            e.preventDefault();
            var id = $(this).attr('id').replace('remove-', '');
            var modal = $("#modalOnCommentDelete");
            modal.modal('show');

            $(document).on("click", "#confirm-remove", function(){
                  $.ajax({
                      type: 'post',
                      url: "/review/delete",
                      dataType: 'json',
                      data: { id: id },
                      success: function(data) {
                          if(data.success == false) {
                        
                          } else {
                              modal.modal('hide');
                              window.location.reload(true);
                          }
                        }
                  });
            });
            //console.log(id);
      });

      /* period selecting */
      $(document).on('click', '#periods span', function(){
          var tag = $(this);

          if(tag.hasClass('active')){
                tag.removeClass('active');
          }
          else {
                tag.addClass('active');
          }
      });

      /* ratings */
      $(document).on('click', "#rating span", function(){
            var star = $(this);
            if(star.hasClass('active')){
                  star.removeClass('active');
            }
            else {
                  star.addClass('active');
            }
      });
      

    });

    </script>
	
@stop