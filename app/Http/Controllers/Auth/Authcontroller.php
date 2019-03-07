<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{

	// public function __construct()
	// {
	// 	$this->middleware('guest')->except('logout');
	// 	$this->middleware('guest:admin')->except('logout');
	// }
		
    public function login_get() {
		return view('login');
	}

	public function login_post(Request $request) {


		$validator = \Validator::make($request->all() , [

			'username'	=> 'required',
			'password'	=> 'required',
			'usertype'	=> 'required|string',
			'school_id'	=> 'required|integer',

		]);

		if($validator->fails()) {

			return back()->withErrors($validator);
		}
		if($request->usertype == 'student') { // Student Page


			if($request->school_id == '1') {

				return 'welcome Student You Are Now In American School';

			} else if($request->school_id == '2') {

				return 'welcome Student You Are Now In Test1 School';

			} else if($request->school_id == '3'){

				return 'welcome Student You Are Now In Test2 School';

			} else {
				return 'Error';
			}


		} else if($request->usertype == 'teacher') { // Teacher Page


			if($request->school_id == '1') {

				return 'welcome Teacher You Are Now In American School';

			} else if($request->school_id == '2') {

				return 'welcome Teacher You Are Now In Test1 School';

			} else if($request->school_id == '3'){

				return 'welcome Teacher You Are Now In Test2 School';

			} else {
				return 'Error';
			}



			
		} else if($request->usertype == 'admin' ) { // Admin Page
			
			if(Auth::guard('admin')->attempt(['username' => $request->username , 'password' => $request->password , 'school_id' => $request->school_id ])) {
				return redirect('admin/add_student');
            }  else {
				return redirect()->back()->with(['not_found' => 'User Not Found']); 
            }
			
		} else { // If Not Admin Or Student Or Teacher
			return back();
		}
	}

	public function logout () {
		Auth::guard($this->get_guard())->logout();
		return redirect('user/login');
		// Auth::logout();
		if(Auth::check()) 
		{ 
			dd( 'authenticated');
		}else{
			dd( 'not authenticated');
		}
        return redirect('admin/add_student');
	}

	function get_guard(){
		if(Auth::guard('admin')->check())
			{return "admin";}
		elseif(Auth::guard('user')->check())
			{return "user";}
		elseif(Auth::guard('client')->check())
			{return "client";}
	}



}
