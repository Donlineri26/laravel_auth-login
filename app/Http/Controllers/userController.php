<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index() {
	$users = User::all();
	return view('index', ['users' => $users]);
    }

    public function auth(UserRequest $req) {
	$user = new User();
	$user->name = $req->name;
	$user->email = $req->email;
	$user->password = Hash::make($req->password);
	$user->save();
	return redirect()->route('index_page')->with('authid', $user->id);
    }

    public function login(LoginRequest $req) {
	$user = User::all()->where('email', '=', $req->email)->first();
	if($user === null) {
	    return redirect()->route('login_page')->with('login_error', "User or password is incorrect");
	} else {
	    if(Hash::check($req->password, $user->password)) {
		/*return redirect()->route('login_page')->with('login_error', "user exist");*/
		/*return view('success', ['user' => $user]);*/
		$req->session()->put('authorize', true);
		$req->session()->put('id', $user->id);
		$req->session()->put('name', $user->name);
		return view('success', ['user' => $user->name]);
	    } else {
		return redirect()->route('login_page')->with('login_error', "User or password is incorrect");
	    }
	}
    }

    public function unlogin(Request $req) {
	$req->session()->forget(['authorize', 'id', 'name']);
	return redirect()->route('index_page', ['users' => User::all()]);
    }

    public function getProfile(Request $req) {
	if($req->session()->get('authorize')) {
	    return view('success', ['user' => $req->session()->get('name')]);
	}
    }
}
