<?php
use TMW\Repositories\RiderRepository\iRiderRepository as Rider;

class RiderController extends BaseController {

	protected $rider;

	public function __construct (Rider $rider) {
		$this->rider = $rider;
	}

	public function showLogin() {
		return View::make('rider/login');
	}

	public function login(){
			$inputArr = Input::get();
			$validator = $this->rider->getLoginValidator($inputArr);
			//$validator = Rider::getLoginValidator($inputArr);
			//var_dump($validator);
			if ($validator->passes()) { 
				//$credentials = $this->getLoginCredentials();
				if (Auth::attempt(Input::only('email', 'password'), true)) {
					//Session::put('rider', Auth::user()); 

					if(Request::ajax()) {
							//return Redirect::intended();
							return Response::json(array('success' => true, 'rider' => Auth::user()->getAuthIdentifier()));
					} else{
							return Redirect::intended();
					}
				}
				else {
					if(Request::ajax()) {
							return Response::json(array('success' => false, 'errors' => array('password'=> "Password is invalid")));
					} else{
							Redirect::back()->withInput()->withErrors($validator);
					}
				}
			} else {
				if(Request::ajax()) {
						return Response::json(array('success' => false, 'errors' => $validator->messages()->toArray()));
				} else{
						Redirect::back()->withInput()->withErrors($validator);
				}
			}
	}	

	public function loginFacebook(){
		// get data from input
		   $code = Input::get( 'code' );

		   // get fb service
		   $fb = OAuth::consumer( 'Facebook' );

		   // check if code is valid

		   // if code is provided get user data and sign in
		   if ( !empty( $code ) ) {

		       // This was a callback request from facebook, get the token
		       $token = $fb->requestAccessToken( $code );

		       // Send a request with it
		       $result = json_decode( $fb->request( '/me' ), true );

		       $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
		       echo $message. "<br/>";

		       //Var_dump
		       //display whole array().
		       dd($result);

		   }
		   // if not ask for permission first
		   else {
		       // get fb authorization
		       $url = $fb->getAuthorizationUri();

		       // return to facebook login url
		        return Redirect::to( (string)$url );
		   }

	}

	public function forceLogin($id){
		$this->rider->forceLogin($id);
		return View::make("rider/login");
		//return Redirect::to("/rider/login");
	}

	public function logout(){
		Auth::logout();
		Session::flush();
		return View::make("rider/login");
		//return Redirect::to("/rider/login");
	}
}