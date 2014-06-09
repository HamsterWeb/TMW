<?php

class BirthdayFilter{
	public function filter($route, $request, $date){
		if(date('d/m') == $date){
			return View::make('test/birthday');
		}
	}
}

?>