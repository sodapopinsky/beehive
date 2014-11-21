<?php

class HomeController extends Controller{

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

		public function jsonData()
	{
$arr = array('from' => 'TicketFactory', 'date' => '1400956671914', 'subject' => 'Your confirmation #W45021238038', 'id' => "3");

		return json_encode($arr);

	}






}
