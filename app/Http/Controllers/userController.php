<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ApplicationModel;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ApplicationRequest;
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
		/*dd($user->applications()->get());*/
		$req->session()->put('authorize', true);
		$req->session()->put('id', $user->id);
		$req->session()->put('name', $user->name);
		$req->session()->put('email', $user->email);
		/*return view('success', ['user' => $user->name], ['data' => $user->applications()->get()]);*/
		return redirect()->route('profile_page');
	    } else {
		return redirect()->route('login_page')->with('login_error', "User or password is incorrect");
	    }
	}
    }

    public function unlogin(Request $req) {
	$req->session()->forget(['authorize', 'id', 'name', 'email']);
	return redirect()->route('index_page', ['users' => User::all()]);
    }

    public function getProfile(Request $req) {
	if($req->session()->get('authorize')) {
	    $user = User::all()->where('id', '=', $req->session()->get('id'))->first();
	    return view('success', ['data' => $user->applications()->get()]);
	} else {
	    return view('dont_authorize');
	}
    }

    public function sendApplication(ApplicationRequest $req) {
	$msg = new ApplicationModel();
	$msg->email = $req->session()->get('email');
	$msg->message = $req->message;
	$msg->save();
	return redirect()->route('profile_page')->with('notifi', 'application was sent');
    }

    public function checkApplicationAccess($appid, $req) {
	if($req->session()->get('authorize')) {
	    $user = User::all()->where('id', '=', $req->session()->get('id'))->first();
	    $msg = $user->applications()->where('id', '=', $appid)->first();
	    if($msg === null) {
		return false;
	    } else {
		return true;
	    }
	} else {
	    return false;	
	}
    }

    public function editPage($id, Request $req) {
	if(userController::checkApplicationAccess($id, $req)) {
	    return view('edit', ['application' => ApplicationModel::all()->where('id', '=', $id)->first()]);
	} else {
	    return view('dont_access');
	}
    }

    public function deleteApplication($id, Request $req) {
	if(userController::checkApplicationAccess($id, $req)) {
	    ApplicationModel::where('id', '=', $id)->delete();
	    return redirect()->route('profile_page')->with('notifi', 'application was deleted');
	} else {
	    return view('dont_access');
	}
    }

    public function editApplication(Request $req, $id) {
	$req->validate([
	    'message_edit' => 'required'
	]);
	$msg = ApplicationModel::where('id', '=', $id)->first();
	$msg->message = $req->message_edit;
	$msg->save();
	return redirect()->route('profile_page')->with('notifi', 'application was edited');
    }
}
