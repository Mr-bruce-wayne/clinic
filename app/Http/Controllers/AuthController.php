<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
 public function show(){return view('auth.login');}
 public function login(Request $request){$credentials=$request->validate(['email'=>['required','email'],'password'=>['required']]);if(!Auth::attempt($credentials)){return back()->withErrors(['email'=>'The supplied credentials are incorrect.'])->onlyInput('email');}if(!$request->user()->active){Auth::logout();return back()->withErrors(['email'=>'This account is inactive.']);}$request->session()->regenerate();return redirect()->intended('/');}
 public function logout(Request $request){Auth::logout();$request->session()->invalidate();$request->session()->regenerateToken();return redirect('/login');}
}
