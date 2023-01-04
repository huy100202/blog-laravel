<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EmailRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\ForgotPasswordService;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{

    public function index() {
        return view('back.pages.home');
    }
    public function login() {
        if (Auth::check()) {
            // nếu đăng nhập thàng công thì 
            return redirect('home');
        } else {
            return view('back.pages.auth.login');
        }
    }
    public function logout() {
        Auth::guard('web')->logout();
        return Redirect::route('author.login');
    }
    public function checkLogin(LoginRequest $request) {
        return resolve(LoginService::class)->handle($request->input());
    }
    public function forgotPassword() {
        return view('back.pages.auth.forgot');
    }
    public function Email(EmailRequest $request) {
        return resolve(ForgotPasswordService::class)->handle($request->input());
    }
}
