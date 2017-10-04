<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;

class HomeController extends Controller {

    public function showLogin(Request $request) {
	// this is trial
        return view('admin.home.login');
    }

    public function doLogin(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'username' => 'required',
                        'password' => 'required'
            ]);
            $errors = $validator->errors();
            $username = $request->input('username');
            $password = $request->input('password');
            $user = DB::table('users')->where('username', $username)->first();
            if ($user) {
                if ($user->password == md5($password)) {
                    $role = DB::table('role_users')
                            ->select('roles.slug', 'roles.permissions')
                            ->join('roles', 'role_users.role_id', '=', 'roles.id')
                            ->where('role_users.user_id', $user->id)
                            ->first();
                    if ($role && $role->slug) {
                        session(['isAuthenticate' => '1', 'role' => $role->slug]);
                        return redirect()->route('homepage');
                    }
                } else {
                    if (!$errors->has('username') && !$errors->has('password')) {
                        $validator->after(function ($validator) {
                            $validator->errors()->add('password', 'Password is wrong.');
                        });
                    }
                }
            } else {
                if (!$errors->has('username') && !$errors->has('password')) {
                    $validator->after(function ($validator) {
                        $validator->errors()->add('username', 'Username not exists.');
                    });
                }
            }
            if ($validator->fails()) {
                return redirect()->route('show_login')->withErrors($validator)->withInput();
            }
        }
    }

    public function index() {
        return view('admin.home.index');
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('show_login');
    }
    public function refreshCaptcha(Request $request){
        return captcha_img('flat');
    }
}
