<?php

class DownloadController extends \BaseController {
	public function showLogin()
	{
		return View::make('login');
	}
	public function doLogin($token="",$username)
	{

	$rules = array('username'    => 'required','password' => 'required|alphaNum|min:3');
	$validator = Validator::make(Input::all(), $rules);

	if ($validator->fails())
	 {
	 	return Redirect::route('login',array('token'=>$token,'username'=>$username))->withErrors($validator);
	 } 
	else {
			$userdata = array('username'=> Input::get('username'),'password'  => Input::get('password'));
		
		}
	if (Auth::attempt($userdata)) {
		//if login success
		
		$username=Auth::user()->username;
		$admins=DB::table('admin')->lists('admin');
		if (in_array($username,$admins)) {
			return Redirect::action('AdminController@index');
		}
		else{
			return $this->download($token,$username);
		}
	}
	else {
		$errormessage=array('message'=>"Login Failed");
		return Redirect::route('login',array('token'=>$token,'username'=>$username))->with($errormessage);
	}

	}//func ends

	public function doLogout()
	{
	    Auth::logout(); // log the user out of our application
	    return Redirect::route('login',array('token'=>$token,'username'=>$username)); // redirect the user to the login screen
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
		if (Schema::hasTable($username))
		{
		    //
		 if (Auth::check()) {
		 	# code...
		
		
				$counter=DB::table($username)->where('token',$token)->pluck('counter');
		$time= strtotime(DB::table('customers')->where('token',$token)->pluck('created_at'));
		$currenttime= time();
		$dtime= $currenttime-$time;
		$timemargin=160;//One Day
						if (intval($counter)>10 or $dtime>$timemargin ) {
							DB::transaction(function() use ($username){
								Schema::dropIfExists($username);
								DB::table('customers')->where('username',$username)->delete();
								DB::table('users')->where('username',$username)->delete();



							});
							return  "This download link has expired";;
						}
		else{
			//Update Counter
			$counter=DB::table($username)->where('token',$token)->pluck('counter');
			$newcounter = intval($counter)+1;
			DB::table($username)
            ->where('token',$token)
            ->update(array('counter' => $newcounter));
            
            return Response::download(storage_path().'/files/'.$script);
		}
	}
	else{
		return Redirect::route('login',array('token'=>$token,'username'=>$username));
	}
	}
	else {
		return "Unauthorised User";
	}
}


}
