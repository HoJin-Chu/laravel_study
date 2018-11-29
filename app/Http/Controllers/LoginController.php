<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
	public function __construct() {
		return $this->middleware('guest', ['except'=>'destroy']);
	}

    public function destroy() {
    	auth()->logout();
    	
    	return redirect('bbs')->with('message', '또 방문해 주세요');
    }

    public function create() {
    	return view('sessions.create');
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6',
    	]);
    	if(!auth()->attempt($request->only('email', 'password'), $request->has('remember'))) {
 
    		return back()->withInput();
    	}
    	//Auth::logoutOtherDevices($request->password);
    	return redirect()->intended('bbs');
    }   
}
