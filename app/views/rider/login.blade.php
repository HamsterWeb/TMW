@extends('layout.default')
@section('content')

<div class="container-fluid">
	<div class="row bottommargin">
	  <div class="col-xs-12 col-md-12 heading">
	      <h3> Log in or create your account </h3>
	  </div>
	</div>
	<div class="row">
	  <div class="col-xs-12 col-md-12">
	      <div class="alert alert-danger alert-dismissable no-display" id="alertOnSubmitFail">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
	        <span></span> 
	      </div>
	  </div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-horizontal form-wrap">
				{{ Form::open(array('url' => 'rider/login', 'method' => 'post', 'id' => 'loginForm') ) }}
				<span class="input-wrap">
				 {{ Form::label("email", "Email") }}
				 {{ Form::email("email") }}
				</span>
				<span class='input-wrap'>
				 {{ Form::label("password", "Password") }}
				 {{ Form::password("password") }}
				</span>
				<span class='input-wrap'>
					<button type="submit" class="btn btn-default btn-sm" id="submitLoginForm">
						<i class="glyphicon glyphicon-log-in"> </i> Login
					</button>
				</span>
				
				{{ Form::close() }}
			</div>
		</div>
	</div>

	<!-- social login -->
	<div class="row">
		<div class="col-xs-12 col-md-12">
		    <div class="alert alert-danger alert-dismissable no-display" id="alertOnSocialLoginFail">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
		      <span></span> 
		    </div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="form-wrap">
				<div class="form-horizontal">
					<a href="/rider/log-in-with-facebook"> <button id="loginFacebook" class="btn btn-default">Sign in with Facebook</button></a>
				</div>
			</div>
		</div>
	</div>
</div>

@stop

@section('scripts')
 <script type='text/javascript'>
    $(function(){

    	 $("#submitLoginForm").on('click', function(e){
      		e.preventDefault();

      		var alert = $("#alertOnSubmitFail");

			$.ajax({
			    type:"post",
			    url:"/rider/login",
			    dataType:"json",
			    data: $('#loginForm').serialize(),
			    success: function(response) {
			      if(response.success == true){
			      	alert.hide();
			      	window.location.href = document.referrer+location.hash;
			      }
			      else {
			        alert.find('span').html(arrayToString(response.errors));
			        alert.show();
			      }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert.show();
			        alert.find('span').html();
			        //console.log(thrownError);
                }
            });
	});

	 /*$("#loginFacebook").on('click', function(e){
  		e.preventDefault();

  		var alert = $("#alertOnSocialLoginFail");

		$.ajax({
		    type:"get",
		    url:"/rider/log-in-with-facebook",
		    dataType:"json",
		    //data: $('#loginForm').serialize(),
		    success: function(response) {
		      if(response.success == true){
		      	alert.hide();
		      	//window.location.href = document.referrer+location.hash;
		      }
		      else {
		        alert.find('span').html(arrayToString(response.errors));
		        alert.show();
		      }
            },
            error: function(xhr, textStatus, thrownError) {
                alert.show();
		        alert.find('span').html();
		        //console.log(thrownError);
            }
        });
   	});*/
});
</script>
@stop