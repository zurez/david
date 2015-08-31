<?php

class DownloadController extends \BaseController {
	public function showLogin()
	{
		return View::make('login');
	}
	public function doLogin($token="")
	{

	$rules = array('username'    => 'required','password' => 'required|alphaNum|min:3');
	$validator = Validator::make(Input::all(), $rules);
	if ($validator->fails()) {return Redirect::to('login')->withErrors($validator) ->withInput(Input::except('password'));} 
	else {$userdata = array('username'=> Input::get('username'),'password'  => Input::get('password'));}
	if (Auth::attempt($userdata)) {
				$username = Auth::user()->username;
				$admins  = DB::table('admin')->lists('username');
			if (in_array($username, $admins)){return  Redirect::action('AdminController@index');}
			else {
						return $this->download($token,$username);
					}
					} 
				else {

					echo "string";exit();
					return Redirect::to('login');}
				}

	public function doLogout()
	{
	    Auth::logout(); // log the user out of our application
	    return Redirect::to('login'); // redirect the user to the login screen
	}
	public function filter()
	{
		
	}
	public function download($token,$username)
	{
		//Logic
		//Check if logged in.. if yes down, if no return App::abort('401','unauthorised access')

		//then check if token exists .. if yes if no delete the username
		//then check counter , if its <=3 , if yes
		//Response::Download , counter++
		//Counter is in the username table.
		$script="script.zip";
		$counter=DB::table($username)->where('token',$token)->pluck('counter');
		$time= strtotime(DB::table($username)->where('token',$token)->pluck('created_at'));
		$currenttime= time();
		$dtime= $currenttime-$time;
		$timemargin=60;//One Day
		if (intval($counter)>10 or $dtime>$timemargin) {
			DB::transaction(function(){
				Schema::dropIfExists($username);
				DB::table('customers')->where('username',$username)->delete();
				DB::table('users')->where('username',$username)->delete();



			});
			return App::abort('403','unauthorised access');
		}
		else{
			//Update Counter
			$newcounter = intval($counter)+1;
			DB::table($username)
            ->where('token',$token)
            ->update(array('counter' => $newcounter));
            return Response::download(storage_path().'/files/'.$script);
		}
	}


}
